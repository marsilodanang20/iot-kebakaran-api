<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('status');         // AMAN / BAHAYA
            $table->boolean('api');           // true / false
            $table->integer('suhu')->nullable();
            $table->string('lokasi')->nullable();
            $table->dateTime('waktu');        // Waktu kejadian dari ESP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_logs');
    }
};
