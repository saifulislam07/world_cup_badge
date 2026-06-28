<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $matches = [
            73 => ['home' => 'South Africa',   'away' => 'Canada'],
            74 => ['home' => 'Germany',         'away' => 'Paraguay'],
            75 => ['home' => 'Netherlands',     'away' => 'Morocco'],
            76 => ['home' => 'Brazil',          'away' => 'Japan'],
            77 => ['home' => 'France',          'away' => 'Sweden'],
            78 => ['home' => 'Ivory Coast',     'away' => 'Norway'],
            79 => ['home' => 'Mexico',          'away' => 'Ecuador'],
            80 => ['home' => 'England',         'away' => 'DR Congo'],
            81 => ['home' => 'United States',   'away' => 'Bosnia and Herzegovina'],
            82 => ['home' => 'Belgium',         'away' => 'Senegal'],
            83 => ['home' => 'Portugal',        'away' => 'Croatia'],
            84 => ['home' => 'Spain',           'away' => 'Austria'],
            85 => ['home' => 'Switzerland',     'away' => 'Algeria'],
            86 => ['home' => 'Argentina',       'away' => 'Cape Verde'],
            87 => ['home' => 'Colombia',        'away' => 'Ghana'],
            88 => ['home' => 'Australia',       'away' => 'Egypt'],
        ];

        foreach ($matches as $matchNumber => $teams) {
            DB::table('world_cup_matches')
                ->where('match_number', $matchNumber)
                ->update([
                    'home_team' => $teams['home'],
                    'away_team' => $teams['away'],
                ]);
        }
    }

    public function down(): void
    {
        $placeholders = [
            73 => ['home' => '2nd Group A',  'away' => '2nd Group B'],
            74 => ['home' => '1st Group E',  'away' => 'Best 3rd (A/B/C/D/F)'],
            75 => ['home' => '1st Group F',  'away' => '2nd Group C'],
            76 => ['home' => '1st Group C',  'away' => '2nd Group F'],
            77 => ['home' => '1st Group I',  'away' => 'Best 3rd (C/D/F/G/H)'],
            78 => ['home' => '2nd Group E',  'away' => '2nd Group I'],
            79 => ['home' => '1st Group A',  'away' => 'Best 3rd (C/E/F/H/I)'],
            80 => ['home' => '1st Group L',  'away' => 'Best 3rd (E/H/I/J/K)'],
            81 => ['home' => '1st Group D',  'away' => 'Best 3rd (B/E/F/I/J)'],
            82 => ['home' => '1st Group G',  'away' => 'Best 3rd (A/E/H/I/J)'],
            83 => ['home' => '2nd Group K',  'away' => '2nd Group L'],
            84 => ['home' => '1st Group H',  'away' => '2nd Group J'],
            85 => ['home' => '1st Group B',  'away' => 'Best 3rd (E/F/G/I/J)'],
            86 => ['home' => '1st Group J',  'away' => '2nd Group H'],
            87 => ['home' => '1st Group K',  'away' => 'Best 3rd (D/E/I/J/L)'],
            88 => ['home' => '2nd Group D',  'away' => '2nd Group G'],
        ];

        foreach ($placeholders as $matchNumber => $teams) {
            DB::table('world_cup_matches')
                ->where('match_number', $matchNumber)
                ->update([
                    'home_team' => $teams['home'],
                    'away_team' => $teams['away'],
                ]);
        }
    }
};
