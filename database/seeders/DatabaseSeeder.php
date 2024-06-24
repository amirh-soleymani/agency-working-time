<?php

namespace Database\Seeders;

use App\Models\Agency;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DefaultAgencyWorkingTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AgencySeeder::class,
            DefaultAgencyWorkingTimeSeeder::class
        ]);
    }
}
