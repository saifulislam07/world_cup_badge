<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Setting;
use App\Models\WorldCupYear;
use Illuminate\Database\Seeder;

class WorldCupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['Argentina', 'ar', 1],
            ['Brazil', 'br', 2],
            ['France', 'fr', 3],
            ['Germany', 'de', 4],
            ['Spain', 'es', 5],
            ['Portugal', 'pt', 6],
            ['England', 'gb-eng', 7],
            ['Netherlands', 'nl', 8],
            ['Mexico', 'mx', 9],
            ['United States', 'us', 10],
            ['Canada', 'ca', 11],
            ['Uruguay', 'uy', 12],
            ['Colombia', 'co', 13],
            ['Japan', 'jp', 14],
            ['South Korea', 'kr', 15],
            ['Morocco', 'ma', 16],
            ['Belgium', 'be', 17],
            ['Croatia', 'hr', 18],
            ['Australia', 'au', 19],
            ['Switzerland', 'ch', 20],
            ['Saudi Arabia', 'sa', 21],
            ['Senegal', 'sn', 22],
            ['Qatar', 'qa', 23],
            ['Paraguay', 'py', 24],
            ['Ecuador', 'ec', 25],
            ['Ivory Coast', 'ci', 26],
            ['Ghana', 'gh', 27],
            ['Algeria', 'dz', 28],
            ['Egypt', 'eg', 29],
            ['Tunisia', 'tn', 30],
            ['South Africa', 'za', 31],
            ['Austria', 'at', 32],
            ['Norway', 'no', 33],
            ['Sweden', 'se', 34],
            ['Turkey', 'tr', 35],
            ['Czech Republic', 'cz', 36],
            ['Scotland', 'gb-sct', 37],
            ['Iran', 'ir', 38],
            ['Iraq', 'iq', 39],
            ['Jordan', 'jo', 40],
            ['Uzbekistan', 'uz', 41],
            ['New Zealand', 'nz', 42],
            ['Panama', 'pa', 43],
            ['Haiti', 'ht', 44],
            ['Curacao', 'cw', 45],
            ['Cape Verde', 'cv', 46],
            ['Bosnia and Herzegovina', 'ba', 47],
            ['DR Congo', 'cd', 48],
        ];

        Country::query()->update(['status' => false]);

        foreach ($countries as [$name, $code, $order]) {
            Country::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'flag' => "https://flagcdn.com/w160/{$code}.png",
                    'status' => true,
                    'sort_order' => $order,
                ],
            );
        }

        WorldCupYear::updateOrCreate(['year' => '2026'], ['is_default' => true, 'status' => true]);
        WorldCupYear::updateOrCreate(['year' => '2030'], ['is_default' => false, 'status' => true]);

        $settings = [
            'website_name' => 'World Cup 2026 Badge Maker',
            'footer_text' => 'Privacy friendly: your uploaded photo is only used in your browser.',
            'copyright_text' => 'World Cup supporter badge generator',
            'meta_title' => 'World Cup 2026 Supporter Badge Generator',
            'meta_description' => 'Create a custom football supporter placard with your country, name, photo, and badge color.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
