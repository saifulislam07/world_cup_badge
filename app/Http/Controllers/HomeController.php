<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PlacardRecord;
use App\Models\Setting;
use App\Models\WorldCupYear;
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
}
