<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAgencyListRequest;
use App\Models\Agency;
use App\Models\DefaultAgencyWorkingTime;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function getAgencyById (Agency $agency)
    {
        $now = Carbon::now();

        if (is_null($agency->start_time) || is_null($agency->end_time)) {

            $defaultAgencyWorkingTime = DefaultAgencyWorkingTime::where('date', $now->toDateString())
                ->first();

            $startTime = $agency->start_time ? $agency->start_time : $defaultAgencyWorkingTime->start_time;
            $endTime = $agency->end_time ? $agency->end_time : $defaultAgencyWorkingTime->end_time;

            if ($now->lessThan(Carbon::parse($endTime))) {
                if ($now->greaterThan(Carbon::parse($startTime))) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Agency is Open',
                        'data' => []
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Agency is Closed',
                'data' => []
            ]);
        }
    }

    public function getAgencies(GetAgencyListRequest $getAgencyListRequest)
    {
        $daysCount = $getAgencyListRequest->count;
        $startDate = Carbon::now();
        $endDate = Carbon::now()->add((int)$daysCount, 'day');

        $defaultDates = DefaultAgencyWorkingTime::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->get();

        $agencies = Agency::all();
        $resultData = [];

        foreach ($defaultDates as $date) {
            $dateData = [];
            foreach ($agencies as $agency) {
                $singleAgencyData = [
                    'agencyTitle' => $agency->title,
                    'startTime' => $agency->start_time ? $agency->start_time : $date->start_time,
                    'endTime' => $agency->end_time ? $agency->end_time : $date->end_time,
                ];
                array_push($dateData, $singleAgencyData);
            }

            array_push($resultData, [$date->date => $dateData]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Done',
            'data' => $resultData
        ]);
    }
}
