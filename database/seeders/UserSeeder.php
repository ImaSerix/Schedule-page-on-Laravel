<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::factory()->create([
            'name' => 'Imants Zvīdris',
            'email' => 'imants@zvidris.lv',
            'role' => 'admin',
            'password' => Hash::make('kasIko123'),]);
        foreach (User::all() as $user){
            $user->settings()->create([
                'user_id' => $user->id,
                'settings' => json_encode(array('tab_order' => array('All', 'bus', 'tram', 'saved'))),
            ]);
        }
    }
}
