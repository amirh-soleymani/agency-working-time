<?php

namespace Database\Seeders;

use App\Models\DefaultAgencyWorkingTime;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultAgencyWorkingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resultData = [];
        $date = Carbon::now();

        for ($i = 0; $i < 30; $i++) {

            $singleData = [
                'date' => fake()->date($date),
                'start_time' => '8:00',
                'end_time' => '17:00',
            ];

            $date->addDay();
            array_push($resultData, $singleData);
        }

        DB::table('default_agency_working_time')->insert($resultData);
    }
}
