<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now()->subMinutes(100);
        
        for ($i = 0; $i < 100; $i++) {
            DB::table('sensordata')->insert([
                'temperature' => rand(15, 35) + (rand(0, 10) / 10),
                'humidity' => rand(30, 90) + (rand(0, 10) / 10),
                'datetime' => $now->addMinutes(1)->format('Y-m-d H:i:s')
            ]);
        }
    }
}