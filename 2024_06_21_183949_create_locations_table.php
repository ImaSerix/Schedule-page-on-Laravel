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
            $table->foreignId('stop_id')->constrained('stops')->onDelete('cascade');
            $table->float('latitude',15,6);
            $table->float('longitude',15,6);
            $table->timestamps();
            $table->primary('stop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['stop_id']);
        });
        Schema::dropIfExists('locations');
    }
};
