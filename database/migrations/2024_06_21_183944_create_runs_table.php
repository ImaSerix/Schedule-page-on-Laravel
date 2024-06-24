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
            $table->id('RunID');
            $table->unsignedInteger('RouteID');
            $table->boolean('IsWorkDay');
            $table->unsignedInteger('StartTime');
            $table->timestamps();

            $table->foreign('RouteID')->references('RouteID')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('runs', function (Blueprint $table) {
            $table->dropForeign(['RouteID']);
        });
        Schema::dropIfExists('runs');
    }
};
