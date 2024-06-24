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
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            $table->boolean('is_work_day');
            $table->unsignedInteger('start_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('runs', function (Blueprint $table) {
            $table->dropForeign(['route_id']);
        });
        Schema::dropIfExists('runs');
    }
};
