<?php

namespace Database\Seeders;
use App\Models\RouteNetwork;
use App\Models\User;
use App\Models\SavedNetworks;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavedNetworksSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {  
        $routeNetworks = RouteNetwork::all()->toArray();
        foreach(User::all() as $user){
            $chosenNetwork = array_rand($routeNetworks) + 1;
            //dd($chosenNetwork);
            SavedNetworks::firstOrCreate(['route_network_id' => $chosenNetwork, 'user_id' => $user->id]);
        }
    }
}
