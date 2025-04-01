<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sensordata', function (Blueprint $table) {
            $table->id(); // Equivale a INT PRIMARY KEY NOT NULL AUTO_INCREMENT
            $table->double('temperature');
            $table->double('humidity');
            $table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps(); // Laravel añade esto por defecto (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('sensordata');
    }
};