<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Suppression des données de la table
        DB::table('genres')->delete();

        // Insertion de 5 genres dans la table
        // tableau de genres de musique

        $genres = [
            'Rock',
            'Pop',
            'Rap',
            'Jazz',
            'Techno',
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
    }
}
