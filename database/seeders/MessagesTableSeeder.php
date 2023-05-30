<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suppression des données de la table
        DB::table('messages')->delete();

        DB::table('messages')->insert([
            'user_id' => rand(1,3),
            'content' => "Bonjour, je suis un message",
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        for($i = 0; $i < 5; $i++){
        DB::table('messages')->insert([
            'message_id' => 1,
            'user_id' => rand(1,3),
            'content' => "Bonjour, $i\e message",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    }
}
