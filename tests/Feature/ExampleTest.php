<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\PlacardRecord;
use App\Models\WorldCupYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Country::create(['name' => 'Argentina', 'code' => 'ar', 'status' => true]);
        WorldCupYear::create(['year' => '2026', 'is_default' => true, 'status' => true]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_duplicate_ip_country_year_is_counted_once(): void
    {
        $country = Country::create(['name' => 'Brazil', 'code' => 'br', 'status' => true]);
        $year = WorldCupYear::create(['year' => '2026', 'is_default' => true, 'status' => true]);

        $payload = [
            'name' => 'Fan',
            'country_id' => $country->id,
            'world_cup_year_id' => $year->id,
        ];

        $this->postJson('/download-count', $payload)->assertOk()->assertJson(['created' => true]);
        $this->postJson('/download-count', $payload)->assertOk()->assertJson(['created' => false]);

        $this->assertSame(1, PlacardRecord::count());
        $this->assertSame(1, PlacardRecord::first()->download_count);
    }

    public function test_same_ip_can_count_for_different_country(): void
    {
        $brazil = Country::create(['name' => 'Brazil', 'code' => 'br', 'status' => true]);
        $argentina = Country::create(['name' => 'Argentina', 'code' => 'ar', 'status' => true]);
        $year = WorldCupYear::create(['year' => '2026', 'is_default' => true, 'status' => true]);

        $this->postJson('/download-count', [
            'country_id' => $brazil->id,
            'world_cup_year_id' => $year->id,
        ])->assertOk()->assertJson(['created' => true]);

        $this->postJson('/download-count', [
            'country_id' => $argentina->id,
            'world_cup_year_id' => $year->id,
        ])->assertOk()->assertJson(['created' => true]);

        $this->assertSame(2, PlacardRecord::count());
    }
}
