<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;

Route::get('/', [SensorDataController::class, 'index']);