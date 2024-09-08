<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'California'],
            ['name' => 'Texas'],
            ['name' => 'New York'],
            ['name' => 'Florida'],
            ['name' => 'Illinois'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}