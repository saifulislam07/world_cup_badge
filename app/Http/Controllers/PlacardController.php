<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlacardRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PlacardController extends Controller
{
    public function storeDownload(Request $request)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
            'country_id' => ['required', Rule::exists('countries', 'id')->where('status', true)],
            'world_cup_year_id' => ['required', Rule::exists('world_cup_years', 'id')->where('status', true)],
        ]);

        $ipAddress = (string) $request->ip();

        $record = PlacardRecord::firstOrCreate(
            [
                'ip_address' => $ipAddress,
                'country_id' => $validated['country_id'],
                'world_cup_year_id' => $validated['world_cup_year_id'],
            ],
            [
                'name' => $validated['name'] ?? null,
                'phone' => null,
                'download_count' => 1,
                'user_agent' => (string) $request->userAgent(),
            ],
        );

        return response()->json([
            'created' => $record->wasRecentlyCreated,
            'message' => $record->wasRecentlyCreated ? 'Download counted.' : 'Already counted for this country and year.',
            'ranking' => $this->topRanking(),
        ]);
    }

    public function ranking()
    {
        $ranking = PlacardRecord::select('country_id', DB::raw('COUNT(*) as total'))
            ->with('country')
            ->groupBy('country_id')
            ->orderByDesc('total')
            ->get();

        return view('ranking', compact('ranking'));
    }

    private function topRanking()
    {
        return PlacardRecord::select('country_id', DB::raw('COUNT(*) as total'))
            ->with('country')
            ->groupBy('country_id')
            ->orderByDesc('total')
            ->orderBy('country_id')
            ->get()
            ->map(fn ($row) => [
                'name' => $row->country?->name ?? 'Unknown',
                'flag' => $row->country?->flag,
                'total' => (int) $row->total,
            ])
            ->values();
    }
}
