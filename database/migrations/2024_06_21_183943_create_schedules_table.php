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
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            $table->foreignId('stop_id')->constrained('stops')->onDelete('cascade');
            $table->boolean('is_work_day');
            $table->unsignedInteger('order');
            $table->unsignedInteger('time_delta');
            $table->timestamps();

            $table->primary(['route_id', 'stop_id', 'is_work_day', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['route_id']);
            $table->dropForeign(['stop_id']);
        });
        Schema::dropIfExists('schedules');
    }
};
