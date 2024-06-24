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
        Schema::create('saved_networks', function (Blueprint $table) {
            $table->foreignId('route_network_id')->constrained('route_networks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['route_network_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_networks', function (Blueprint $table) {
            $table->dropForeign(['stop_id', 'route_network_id']);
        });
        Schema::dropIfExists('saved_networks');
    }
};
