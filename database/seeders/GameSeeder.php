<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [

            [
                'name' => 'Free Fire',
                'slug' => 'free-fire',
                'description' => 'Akun Free Fire',
                'is_active' => true,
            ],

            [
                'name' => 'Mobile Legends',
                'slug' => 'mobile-legends',
                'description' => 'Akun Mobile Legends',
                'is_active' => true,
            ],

            [
                'name' => 'PUBG Mobile',
                'slug' => 'pubg-mobile',
                'description' => 'Akun PUBG Mobile',
                'is_active' => true,
            ],

            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'description' => 'Akun Valorant',
                'is_active' => true,
            ],

            [
                'name' => 'Genshin Impact',
                'slug' => 'genshin-impact',
                'description' => 'Akun Genshin Impact',
                'is_active' => true,
            ],

            [
                'name' => 'Roblox',
                'slug' => 'roblox',
                'description' => 'Akun Roblox',
                'is_active' => true,
            ],

        ];

        foreach ($games as $game) {

            Game::create($game);

        }
    }
}