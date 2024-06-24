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
            $table->id();
            $table->foreignId('route_network_id')->constrained('route_networks')->onDelete('cascade');
            $table->string("direction");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropForeign(['route_network_id']);
        });
        Schema::dropIfExists('routes');
    }
};
