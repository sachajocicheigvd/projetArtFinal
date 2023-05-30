<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suppression des données de la table
        DB::table('genre_user')->delete();

        // 3 insertions aléatoires
        for ($i = 0; $i < 3; $i++) {
            DB::table('genre_user')->insert([
                'genre_id' => rand(1,5),
                'user_id' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
