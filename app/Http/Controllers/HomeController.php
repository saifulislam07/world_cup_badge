<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PlacardRecord;
use App\Models\Setting;
use App\Models\WorldCupMatch;
use App\Models\WorldCupYear;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
            'id'   => $country->id,
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

        return view('home', compact(
            'countries', 'countryOptions', 'years', 'defaultYear',
            'settings', 'ranking', 'totalCountries', 'totalDownloads'
        ));
    }

    public function todayMatches()
    {
        $timezone = 'Asia/Dhaka';
        $now      = CarbonImmutable::now($timezone);
        $today    = $now->startOfDay();

        $matches = $this->mappedMatches($timezone, $now);

        $todayMatches = $matches
            ->where('date_key', $today->toDateString())
            ->sortBy(fn ($m) => match ($m['status']) {
                'live'     => 0,
                'upcoming' => 1,
                default    => 2,
            })
            ->values();

        $nextMatch = $matches
            ->filter(fn ($m) => $m['kickoff_bdt']->greaterThan($now))
            ->sortBy('kickoff_bdt')
            ->first();

        return view('matches.today', [
            'todayMatches' => $todayMatches,
            'nextMatch'    => $nextMatch,
            'todayLabel'   => $today->format('F j, Y'),
        ]);
    }

    public function fixtures()
    {
        $timezone = 'Asia/Dhaka';
        $now      = CarbonImmutable::now($timezone);

        $matches = $this->mappedMatches($timezone, $now);

        $matchesByDate = $matches
            ->sortBy('kickoff_bdt')
            ->groupBy('date_key')
            ->map(fn ($dateMatches, $date) => [
                'date'    => CarbonImmutable::parse($date, $timezone),
                'matches' => $dateMatches->values(),
            ])
            ->values();

        $fixtureTeams  = $matches->flatMap(fn ($m) => [$m['home'], $m['away']])->unique()->sort()->values();
        $fixtureStages = $matches->pluck('group_label')->unique()->sort()->values();

        return view('matches.fixtures', compact('matchesByDate', 'fixtureTeams', 'fixtureStages'));
    }

    public function standings()
    {
        return view('matches.standings');
    }

    public function wcResults()
    {
        $apiKey = env('FOOTBALL_API_KEY');
        if (!$apiKey) {
            return response()->json(['configured' => false]);
        }

        $timezone = 'Asia/Dhaka';
        $now      = CarbonImmutable::now($timezone);
        $fromUtc  = $now->startOfDay()->setTimezone('UTC')->format('Y-m-d');
        $toUtc    = $now->endOfDay()->setTimezone('UTC')->format('Y-m-d');

        $data = Cache::remember("wc2026_results_v2_{$fromUtc}", 120, function () use ($apiKey, $fromUtc, $toUtc) {
            $response = Http::withHeaders(['X-Auth-Token' => $apiKey])
                ->timeout(8)
                ->get('https://api.football-data.org/v4/competitions/WC/matches', [
                    'dateFrom' => $fromUtc,
                    'dateTo'   => $toUtc,
                ]);

            if (!$response->successful()) return null;

            $data    = $response->json();
            $matches = $data['matches'] ?? [];

            // Individual match endpoints include goals; fetch them concurrently
            $withGoals = ['FINISHED', 'IN_PLAY', 'PAUSED', 'HALFTIME'];
            $active    = array_values(array_filter($matches, fn ($m) => in_array($m['status'] ?? '', $withGoals)));

            if (!empty($active)) {
                $responses = Http::pool(function ($pool) use ($apiKey, $active) {
                    return array_map(
                        fn ($m) => $pool->as('m' . $m['id'])
                            ->withHeaders(['X-Auth-Token' => $apiKey])
                            ->timeout(10)
                            ->get("https://api.football-data.org/v4/matches/{$m['id']}"),
                        $active
                    );
                });

                $data['matches'] = array_map(function ($match) use ($responses, $withGoals) {
                    if (!in_array($match['status'] ?? '', $withGoals)) return $match;
                    $resp = $responses['m' . $match['id']] ?? null;
                    if ($resp && !($resp instanceof \Throwable) && $resp->successful()) {
                        $match['goals'] = $resp->json('goals') ?? [];
                    } else {
                        $match['goals'] = [];
                    }
                    return $match;
                }, $matches);
            }

            return $data;
        });

        if (!$data) {
            return response()->json(['error' => 'API fetch failed'], 502);
        }

        return response()->json(['configured' => true, 'data' => $data]);
    }

    public function wcStandings()
    {
        $apiKey = env('FOOTBALL_API_KEY');
        if (!$apiKey) {
            return response()->json(['configured' => false]);
        }

        $data = Cache::remember('wc2026_standings', 300, function () use ($apiKey) {
            $response = Http::withHeaders(['X-Auth-Token' => $apiKey])
                ->timeout(8)
                ->get('https://api.football-data.org/v4/competitions/WC/standings');
            return $response->successful() ? $response->json() : null;
        });

        if (!$data) {
            return response()->json(['error' => 'API fetch failed'], 502);
        }

        return response()->json(['configured' => true, 'data' => $data]);
    }

    private function mappedMatches(string $timezone, CarbonImmutable $now): Collection
    {
        return WorldCupMatch::query()
            ->orderBy('kickoff_at')
            ->orderBy('match_number')
            ->get()
            ->map(function (WorldCupMatch $match) use ($timezone, $now) {
                $kickoff = $match->kickoff_at->toImmutable()->setTimezone($timezone);

                $status = match (true) {
                    $kickoff->greaterThan($now)                        => 'upcoming',
                    $kickoff->addMinutes(110)->greaterThan($now)       => 'live',
                    default                                            => 'finished',
                };

                return [
                    'match_number' => $match->match_number,
                    'stage'        => $match->stage,
                    'group'        => $match->group,
                    'group_label'  => $match->group ? "Group {$match->group}" : $match->stage,
                    'home'         => $match->home_team,
                    'away'         => $match->away_team,
                    'venue'        => $match->venue,
                    'kickoff_bdt'  => $kickoff,
                    'date_key'     => $kickoff->toDateString(),
                    'time_label'   => $kickoff->format('h:i A'),
                    'status'       => $status,
                ];
            });
    }
}
