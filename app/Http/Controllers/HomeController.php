<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PlacardRecord;
use App\Models\Setting;
use App\Models\WorldCupMatch;
use App\Models\WorldCupYear;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::where('status', true)->orderBy('sort_order')->orderBy('name')->get();
        $years = WorldCupYear::where('status', true)->orderByDesc('is_default')->orderBy('year')->get();
        $defaultYear = $years->firstWhere('is_default', true) ?? $years->first();
        $settings = Setting::pluck('value', 'key');
        $totalCountries = $countries->count();
        $totalDownloads = PlacardRecord::count();
        $countryOptions = $countries->map(fn ($country) => [
            'id' => $country->id,
            'name' => $country->name,
            'code' => $country->code,
            'flag' => $country->flag,
        ])->values();
        $ranking = PlacardRecord::select('country_id', DB::raw('COUNT(*) as total'))
            ->with('country')
            ->groupBy('country_id')
            ->orderByDesc('total')
            ->orderBy('country_id')
            ->get();

        return view('home', compact('countries', 'countryOptions', 'years', 'defaultYear', 'settings', 'ranking', 'totalCountries', 'totalDownloads'));
    }

    public function todayMatches()
    {
        $timezone = 'Asia/Dhaka';
        $today = CarbonImmutable::now($timezone)->startOfDay();
        $matches = WorldCupMatch::query()
            ->orderBy('kickoff_at')
            ->orderBy('match_number')
            ->get()
            ->map(function (WorldCupMatch $match) use ($timezone) {
                $kickoff = $match->kickoff_at->toImmutable()->setTimezone($timezone);

                return [
                    'match_number' => $match->match_number,
                    'stage' => $match->stage,
                    'group' => $match->group,
                    'group_label' => $match->group ? "Group {$match->group}" : $match->stage,
                    'home' => $match->home_team,
                    'away' => $match->away_team,
                    'venue' => $match->venue,
                    'kickoff_bdt' => $kickoff,
                    'date_key' => $kickoff->toDateString(),
                    'time_label' => $kickoff->format('h:i A'),
                ];
            });

        $todayMatches = $matches
            ->where('date_key', $today->toDateString())
            ->sortBy('kickoff_bdt')
            ->values();

        $nextMatch = $matches
            ->filter(fn ($match) => $match['kickoff_bdt']->greaterThan(CarbonImmutable::now($timezone)))
            ->sortBy('kickoff_bdt')
            ->first();
        $matchesByDate = $matches
            ->sortBy('kickoff_bdt')
            ->groupBy('date_key')
            ->map(fn ($dateMatches, $date) => [
                'date' => CarbonImmutable::parse($date, $timezone),
                'matches' => $dateMatches->values(),
            ])
            ->values();
        $fixtureTeams = $matches
            ->flatMap(fn ($match) => [$match['home'], $match['away']])
            ->unique()
            ->sort()
            ->values();
        $fixtureStages = $matches
            ->pluck('group_label')
            ->unique()
            ->sort()
            ->values();

        return view('matches.today', [
            'todayMatches' => $todayMatches,
            'nextMatch' => $nextMatch,
            'todayLabel' => $today->format('F j, Y'),
            'matchesByDate' => $matchesByDate,
            'fixtureTeams' => $fixtureTeams,
            'fixtureStages' => $fixtureStages,
        ]);
    }
}
