<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
            'Texas' => ['Houston', 'Dallas', 'Austin'],
            'New York' => ['New York City', 'Buffalo', 'Rochester'],
            'Florida' => ['Miami', 'Orlando', 'Tampa'],
            'Illinois' => ['Chicago', 'Springfield', 'Peoria'],
        ];

        foreach ($cities as $stateName => $cityNames) {
            $state = State::where('name', $stateName)->first();
            if ($state) {
                foreach ($cityNames as $cityName) {
                    City::create(['name' => $cityName, 'state_id' => $state->id]);
                }
            }
        }
    }
}