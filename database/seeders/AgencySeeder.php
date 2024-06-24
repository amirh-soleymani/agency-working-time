<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $agency = Agency::create([
                'title' => fake()->company(),
            ]);

            if ($agency->id % 2 == 0) {

                $agency->start_time = fake()->randomElement([null, '7:00']);
                $agency->end_time = fake()->randomElement([null, '18:00']);
                $agency->save();
            }
        }
    }
}
