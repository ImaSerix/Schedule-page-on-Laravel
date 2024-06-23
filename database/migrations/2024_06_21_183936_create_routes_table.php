<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $fillable = ['RouteNetworkID', 'Name'];
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->unsignedInteger('RouteID')->primary();
            $table->unsignedInteger('RouteNetworkID');
            $table->string("Direction");
            $table->timestamps();

            $table->foreign('RouteNetworkID')->references('RouteNetworkID')->on('route_networks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropForeign(['RouteNetworkID']);
        });
        Schema::dropIfExists('routes');
    }
};
