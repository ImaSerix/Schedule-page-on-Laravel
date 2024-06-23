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
        Schema::create('schedules', function (Blueprint $table) {
            $table->integer('ScheduleID')->primary();
            $table->foreign('RouteID')->references('RouteID')->on('routes')->onDelete('cascade');
            $table->foreign('StopID')->references('StopID')->on('stops')->onDelete('cascade');
            $table->boolean('IsWorkDay');
            $table->integer('Order');
            $table->TIME('TimeDelta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
