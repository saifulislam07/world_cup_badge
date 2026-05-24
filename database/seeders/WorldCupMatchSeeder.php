<?php

namespace Database\Seeders;

use App\Models\WorldCupMatch;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class WorldCupMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = <<<'FIXTURES'
1|Group Stage|A|2026-06-11|3:00 PM|Mexico|South Africa|Mexico City Stadium (Estadio Azteca)
2|Group Stage|A|2026-06-11|10:00 PM|South Korea|Czechia|Guadalajara Stadium (Estadio Akron), Zapopan
3|Group Stage|B|2026-06-12|3:00 PM|Canada|Bosnia and Herzegovina|Toronto Stadium (BMO Field)
4|Group Stage|D|2026-06-12|9:00 PM|USA|Paraguay|Los Angeles Stadium (SoFi)
5|Group Stage|B|2026-06-13|3:00 PM|Qatar|Switzerland|San Francisco Bay Area Stadium (Levi's)
6|Group Stage|C|2026-06-13|6:00 PM|Brazil|Morocco|New York New Jersey Stadium (MetLife)
7|Group Stage|C|2026-06-13|9:00 PM|Haiti|Scotland|Boston Stadium (Gillette)
8|Group Stage|D|2026-06-14|12:00 AM|Australia|Turkey|BC Place, Vancouver
9|Group Stage|E|2026-06-14|1:00 PM|Germany|Curacao|Houston Stadium (NRG)
10|Group Stage|F|2026-06-14|4:00 PM|Netherlands|Japan|Dallas Stadium (AT&T)
11|Group Stage|E|2026-06-14|7:00 PM|Ivory Coast|Ecuador|Philadelphia Stadium (Lincoln Financial)
12|Group Stage|F|2026-06-14|10:00 PM|Sweden|Tunisia|Monterrey Stadium (Estadio BBVA), Guadalupe
13|Group Stage|H|2026-06-15|12:00 PM|Spain|Cape Verde|Atlanta Stadium (Mercedes-Benz)
14|Group Stage|G|2026-06-15|3:00 PM|Belgium|Egypt|Seattle Stadium (Lumen Field)
15|Group Stage|H|2026-06-15|6:00 PM|Saudi Arabia|Uruguay|Miami Stadium (Hard Rock)
16|Group Stage|G|2026-06-15|9:00 PM|Iran|New Zealand|Los Angeles Stadium (SoFi)
17|Group Stage|I|2026-06-16|3:00 PM|France|Senegal|New York New Jersey Stadium (MetLife)
18|Group Stage|I|2026-06-16|6:00 PM|Iraq|Norway|Boston Stadium (Gillette)
19|Group Stage|J|2026-06-16|9:00 PM|Argentina|Algeria|Kansas City Stadium (Arrowhead)
20|Group Stage|J|2026-06-17|12:00 AM|Austria|Jordan|San Francisco Bay Area Stadium (Levi's)
21|Group Stage|K|2026-06-17|1:00 PM|Portugal|DR Congo|Houston Stadium (NRG)
22|Group Stage|L|2026-06-17|4:00 PM|England|Croatia|Dallas Stadium (AT&T)
23|Group Stage|L|2026-06-17|7:00 PM|Ghana|Panama|Toronto Stadium (BMO Field)
24|Group Stage|K|2026-06-17|10:00 PM|Uzbekistan|Colombia|Mexico City Stadium (Estadio Azteca)
25|Group Stage|A|2026-06-18|12:00 PM|Czechia|South Africa|Atlanta Stadium (Mercedes-Benz)
26|Group Stage|B|2026-06-18|3:00 PM|Switzerland|Bosnia and Herzegovina|Los Angeles Stadium (SoFi)
27|Group Stage|B|2026-06-18|6:00 PM|Canada|Qatar|BC Place, Vancouver
28|Group Stage|A|2026-06-18|9:00 PM|Mexico|South Korea|Guadalajara Stadium (Estadio Akron), Zapopan
29|Group Stage|D|2026-06-19|12:00 AM|Turkey|Paraguay|San Francisco Bay Area Stadium (Levi's)
30|Group Stage|D|2026-06-19|3:00 PM|USA|Australia|Seattle Stadium (Lumen Field)
31|Group Stage|C|2026-06-19|6:00 PM|Scotland|Morocco|Boston Stadium (Gillette)
32|Group Stage|C|2026-06-19|8:30 PM|Brazil|Haiti|Philadelphia Stadium (Lincoln Financial)
33|Group Stage|F|2026-06-20|1:00 PM|Netherlands|Sweden|Houston Stadium (NRG)
34|Group Stage|E|2026-06-20|4:00 PM|Germany|Ivory Coast|Toronto Stadium (BMO Field)
35|Group Stage|E|2026-06-20|8:00 PM|Ecuador|Curacao|Kansas City Stadium (Arrowhead)
36|Group Stage|F|2026-06-21|12:00 AM|Tunisia|Japan|Monterrey Stadium (Estadio BBVA), Guadalupe
37|Group Stage|H|2026-06-21|12:00 PM|Spain|Saudi Arabia|Atlanta Stadium (Mercedes-Benz)
38|Group Stage|G|2026-06-21|3:00 PM|Belgium|Iran|Los Angeles Stadium (SoFi)
39|Group Stage|H|2026-06-21|6:00 PM|Uruguay|Cape Verde|Miami Stadium (Hard Rock)
40|Group Stage|G|2026-06-21|9:00 PM|New Zealand|Egypt|BC Place, Vancouver
41|Group Stage|J|2026-06-22|1:00 PM|Argentina|Austria|Dallas Stadium (AT&T)
42|Group Stage|I|2026-06-22|5:00 PM|France|Iraq|Philadelphia Stadium (Lincoln Financial)
43|Group Stage|I|2026-06-22|8:00 PM|Norway|Senegal|New York New Jersey Stadium (MetLife)
44|Group Stage|J|2026-06-22|11:00 PM|Jordan|Algeria|San Francisco Bay Area Stadium (Levi's)
45|Group Stage|K|2026-06-23|1:00 PM|Portugal|Uzbekistan|Houston Stadium (NRG)
46|Group Stage|L|2026-06-23|4:00 PM|England|Ghana|Boston Stadium (Gillette)
47|Group Stage|L|2026-06-23|7:00 PM|Panama|Croatia|Toronto Stadium (BMO Field)
48|Group Stage|K|2026-06-23|10:00 PM|Colombia|DR Congo|Guadalajara Stadium (Estadio Akron), Zapopan
49|Group Stage|B|2026-06-24|3:00 PM|Switzerland|Canada|BC Place, Vancouver
50|Group Stage|B|2026-06-24|3:00 PM|Bosnia and Herzegovina|Qatar|Seattle Stadium (Lumen Field)
51|Group Stage|C|2026-06-24|6:00 PM|Scotland|Brazil|Miami Stadium (Hard Rock)
52|Group Stage|C|2026-06-24|6:00 PM|Morocco|Haiti|Atlanta Stadium (Mercedes-Benz)
53|Group Stage|A|2026-06-24|9:00 PM|Czechia|Mexico|Mexico City Stadium (Estadio Azteca)
54|Group Stage|A|2026-06-24|9:00 PM|South Africa|South Korea|Monterrey Stadium (Estadio BBVA), Guadalupe
55|Group Stage|E|2026-06-25|4:00 PM|Curacao|Ivory Coast|Philadelphia Stadium (Lincoln Financial)
56|Group Stage|E|2026-06-25|4:00 PM|Ecuador|Germany|New York New Jersey Stadium (MetLife)
57|Group Stage|F|2026-06-25|7:00 PM|Japan|Sweden|Dallas Stadium (AT&T)
58|Group Stage|F|2026-06-25|7:00 PM|Tunisia|Netherlands|Kansas City Stadium (Arrowhead)
59|Group Stage|D|2026-06-25|10:00 PM|Turkey|USA|Los Angeles Stadium (SoFi)
60|Group Stage|D|2026-06-25|10:00 PM|Paraguay|Australia|San Francisco Bay Area Stadium (Levi's)
61|Group Stage|I|2026-06-26|3:00 PM|Norway|France|Boston Stadium (Gillette)
62|Group Stage|I|2026-06-26|3:00 PM|Senegal|Iraq|Toronto Stadium (BMO Field)
63|Group Stage|H|2026-06-26|8:00 PM|Cape Verde|Saudi Arabia|Houston Stadium (NRG)
64|Group Stage|H|2026-06-26|8:00 PM|Uruguay|Spain|Guadalajara Stadium (Estadio Akron), Zapopan
65|Group Stage|G|2026-06-26|11:00 PM|Egypt|Iran|Seattle Stadium (Lumen Field)
66|Group Stage|G|2026-06-26|11:00 PM|New Zealand|Belgium|BC Place, Vancouver
67|Group Stage|L|2026-06-27|5:00 PM|Panama|England|New York New Jersey Stadium (MetLife)
68|Group Stage|L|2026-06-27|5:00 PM|Croatia|Ghana|Philadelphia Stadium (Lincoln Financial)
69|Group Stage|K|2026-06-27|7:30 PM|Colombia|Portugal|Miami Stadium (Hard Rock)
70|Group Stage|K|2026-06-27|7:30 PM|DR Congo|Uzbekistan|Atlanta Stadium (Mercedes-Benz)
71|Group Stage|J|2026-06-27|10:00 PM|Algeria|Austria|Kansas City Stadium (Arrowhead)
72|Group Stage|J|2026-06-27|10:00 PM|Jordan|Argentina|Dallas Stadium (AT&T)
73|Round of 32||2026-06-28|3:00 PM|2nd Group A|2nd Group B|Los Angeles Stadium (SoFi)
74|Round of 32||2026-06-29|4:30 PM|1st Group E|Best 3rd (A/B/C/D/F)|Boston Stadium (Gillette)
75|Round of 32||2026-06-29|9:00 PM|1st Group F|2nd Group C|Monterrey Stadium (Estadio BBVA), Guadalupe
76|Round of 32||2026-06-29|1:00 PM|1st Group C|2nd Group F|Houston Stadium (NRG)
77|Round of 32||2026-06-30|5:00 PM|1st Group I|Best 3rd (C/D/F/G/H)|New York New Jersey Stadium (MetLife)
78|Round of 32||2026-06-30|1:00 PM|2nd Group E|2nd Group I|Dallas Stadium (AT&T)
79|Round of 32||2026-06-30|9:00 PM|1st Group A|Best 3rd (C/E/F/H/I)|Mexico City Stadium (Estadio Azteca)
80|Round of 32||2026-07-01|12:00 PM|1st Group L|Best 3rd (E/H/I/J/K)|Atlanta Stadium (Mercedes-Benz)
81|Round of 32||2026-07-01|8:00 PM|1st Group D|Best 3rd (B/E/F/I/J)|San Francisco Bay Area Stadium (Levi's)
82|Round of 32||2026-07-01|4:00 PM|1st Group G|Best 3rd (A/E/H/I/J)|Seattle Stadium (Lumen Field)
83|Round of 32||2026-07-02|7:00 PM|2nd Group K|2nd Group L|Toronto Stadium (BMO Field)
84|Round of 32||2026-07-02|3:00 PM|1st Group H|2nd Group J|Los Angeles Stadium (SoFi)
85|Round of 32||2026-07-02|11:00 PM|1st Group B|Best 3rd (E/F/G/I/J)|BC Place, Vancouver
86|Round of 32||2026-07-03|6:00 PM|1st Group J|2nd Group H|Miami Stadium (Hard Rock)
87|Round of 32||2026-07-03|9:30 PM|1st Group K|Best 3rd (D/E/I/J/L)|Kansas City Stadium (Arrowhead)
88|Round of 32||2026-07-03|2:00 PM|2nd Group D|2nd Group G|Dallas Stadium (AT&T)
89|Round of 16||2026-07-04|5:00 PM|Winner M74|Winner M77|Philadelphia Stadium (Lincoln Financial)
90|Round of 16||2026-07-04|1:00 PM|Winner M73|Winner M75|Houston Stadium (NRG)
91|Round of 16||2026-07-05|4:00 PM|Winner M76|Winner M78|New York New Jersey Stadium (MetLife)
92|Round of 16||2026-07-05|8:00 PM|Winner M79|Winner M80|Mexico City Stadium (Estadio Azteca)
93|Round of 16||2026-07-06|3:00 PM|Winner M83|Winner M84|Dallas Stadium (AT&T)
94|Round of 16||2026-07-06|8:00 PM|Winner M81|Winner M82|Seattle Stadium (Lumen Field)
95|Round of 16||2026-07-07|12:00 PM|Winner M86|Winner M88|Atlanta Stadium (Mercedes-Benz)
96|Round of 16||2026-07-07|4:00 PM|Winner M85|Winner M87|BC Place, Vancouver
97|Quarter-finals||2026-07-09|4:00 PM|Winner M89|Winner M90|Boston Stadium (Gillette)
98|Quarter-finals||2026-07-10|3:00 PM|Winner M93|Winner M94|Los Angeles Stadium (SoFi)
99|Quarter-finals||2026-07-11|5:00 PM|Winner M91|Winner M92|Miami Stadium (Hard Rock)
100|Quarter-finals||2026-07-11|9:00 PM|Winner M95|Winner M96|Kansas City Stadium (Arrowhead)
101|Semi-finals||2026-07-14|3:00 PM|Winner M97|Winner M98|Dallas Stadium (AT&T)
102|Semi-finals||2026-07-15|3:00 PM|Winner M99|Winner M100|Atlanta Stadium (Mercedes-Benz)
103|Third-place||2026-07-18|5:00 PM|Loser M101|Loser M102|Miami Stadium (Hard Rock)
104|Final||2026-07-19|3:00 PM|Winner M101|Winner M102|New York New Jersey Stadium (MetLife), East Rutherford, NJ
FIXTURES;

        collect(explode("\n", trim($rows)))
            ->map(fn ($row) => str_getcsv($row, '|'))
            ->each(function (array $row): void {
                [$matchNumber, $stage, $group, $date, $time, $homeTeam, $awayTeam, $venue] = $row;
                $kickoffAt = CarbonImmutable::parse("{$date} {$time}", 'America/New_York')->utc();

                WorldCupMatch::updateOrCreate(
                    ['match_number' => (int) $matchNumber],
                    [
                        'stage' => $stage,
                        'group' => $group ?: null,
                        'home_team' => $homeTeam,
                        'away_team' => $awayTeam,
                        'kickoff_at' => $kickoffAt,
                        'venue' => $venue,
                        'status' => 'scheduled',
                    ],
                );
            });
    }
}
