<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\PlacardRecord;
use App\Models\Setting;
use App\Models\WorldCupYear;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate(['password' => ['required', 'string']]);

        if ($validated['password'] !== env('ADMIN_PASSWORD', 'admin123')) {
            return back()->withErrors(['password' => 'Invalid admin password.']);
        }

        $request->session()->put('is_admin', true);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalCountries = Country::count();
        $totalUsers = PlacardRecord::count();
        $totalDownloads = PlacardRecord::count();
        $todayDownloads = PlacardRecord::whereDate('created_at', now()->toDateString())->count();
        $topCountry = $this->countryTotals()->first();
        $countryTotals = $this->countryTotals()->get();

        return view('admin.dashboard', compact('totalCountries', 'totalUsers', 'totalDownloads', 'todayDownloads', 'topCountry', 'countryTotals'));
    }

    public function countries()
    {
        return view('admin.countries', ['countries' => Country::orderBy('sort_order')->orderBy('name')->get()]);
    }

    public function storeCountry(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:8'],
            'flag' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        Country::updateOrCreate(
            ['code' => $validated['code'] ?: strtolower(substr($validated['name'], 0, 2))],
            [
                'name' => $validated['name'],
                'flag' => $validated['flag'] ?? null,
                'sort_order' => $validated['sort_order'] ?? 0,
                'status' => $request->boolean('status'),
            ],
        );

        return back()->with('status', 'Country saved.');
    }

    public function years()
    {
        return view('admin.years', ['years' => WorldCupYear::orderBy('year')->get()]);
    }

    public function storeYear(Request $request)
    {
        $validated = $request->validate([
            'year' => ['required', 'string', 'max:20'],
            'is_default' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('is_default')) {
            WorldCupYear::query()->update(['is_default' => false]);
        }

        WorldCupYear::updateOrCreate(
            ['year' => $validated['year']],
            ['is_default' => $request->boolean('is_default'), 'status' => $request->boolean('status')],
        );

        return back()->with('status', 'Year saved.');
    }

    public function settings()
    {
        return view('admin.settings', ['settings' => Setting::pluck('value', 'key')]);
    }

    public function storeSettings(Request $request)
    {
        $validated = $request->validate([
            'website_name' => ['required', 'string', 'max:150'],
            'footer_text' => ['nullable', 'string', 'max:500'],
            'copyright_text' => ['nullable', 'string', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'open_graph_image' => ['nullable', 'url', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('status', 'Settings saved.');
    }

    public function records(Request $request)
    {
        $records = PlacardRecord::with(['country', 'year'])
            ->when($request->filled('country_id'), fn ($query) => $query->where('country_id', $request->country_id))
            ->when($request->filled('world_cup_year_id'), fn ($query) => $query->where('world_cup_year_id', $request->world_cup_year_id))
            ->when($request->filled('phone'), fn ($query) => $query->where('phone', 'like', '%' . $request->phone . '%'))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('created_at', $request->date))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.records', [
            'records' => $records,
            'countries' => Country::orderBy('name')->get(),
            'years' => WorldCupYear::orderBy('year')->get(),
        ]);
    }

    private function countryTotals()
    {
        return PlacardRecord::select('country_id', DB::raw('COUNT(*) as total'))
            ->with('country')
            ->groupBy('country_id')
            ->orderByDesc('total');
    }
}
