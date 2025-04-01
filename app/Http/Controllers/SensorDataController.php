<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorDataController extends Controller
{
    public function index()
    {
        $data = SensorData::orderBy('datetime', 'asc')->get();
        return view('sensor-data', compact('data'));
    }
}