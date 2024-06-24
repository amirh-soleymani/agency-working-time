<?php

use App\Http\Controllers\AgencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/agency/{agency}', [AgencyController::class, 'getAgencyById']);
Route::post('/agency/list', [AgencyController::class, 'getAgencies']);
