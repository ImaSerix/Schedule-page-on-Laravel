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
            $table->unsignedInteger('ScheduleID')->primary();
            $table->unsignedInteger('RouteID');
            $table->unsignedInteger('StopID');
            $table->boolean('IsWorkDay');
            $table->unsignedInteger('Order');
            $table->TIME('TimeDelta');
            $table->timestamps();

            $table->foreign('RouteID')->references('RouteID')->on('routes')->onDelete('cascade');
            $table->foreign('StopID')->references('StopID')->on('stops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['RouteID']);
            $table->dropForeign(['StopID']);
        });
        Schema::dropIfExists('schedules');
    }
};
