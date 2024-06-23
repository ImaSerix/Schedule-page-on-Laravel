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
        Schema::create('locations', function (Blueprint $table) {
            $table->unsignedInteger('StopID')->primary();
            $table->float('longitude',15,6);
            $table->float('latitude',15,6);
            $table->timestamps();

            $table->foreign('StopID')->references('StopID')->on('stops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['StopID']);
        });
        Schema::dropIfExists('locations');
    }
};
