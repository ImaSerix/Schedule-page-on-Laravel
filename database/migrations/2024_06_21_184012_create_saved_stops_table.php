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
        Schema::create('saved_stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('StopID');
            $table->unsignedInteger('UserID');
            $table->timestamps();

            $table->foreign('StopID')->references('StopID')->on('stops')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_stops', function (Blueprint $table) {
            $table->dropForeign(['StopID']);
        });
        Schema::dropIfExists('saved_stops');
    }
};
