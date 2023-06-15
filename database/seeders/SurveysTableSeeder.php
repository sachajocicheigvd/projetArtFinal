<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suppression des données de la table
        DB::table('surveys')->delete();

        // Remplissage de la table
        // duration en secondes
        DB::table('surveys')->insert([
            'user_id' => 1,
            'title' => 'Quelle musique voulez-vous écouter ensuite ?',
            'duration' => now()->addMinutes(2000),
            'type' => 'music',
            'created_at' => now()->addMinutes(1),
                'updated_at' => now(),
        ]);

        DB::table('surveys')->insert([
            'user_id' => 2,
            'title' => 'Aimez-vous Couleur 3 ?',
            'duration' => now()->addMinutes(2000),
            'type' => 'text',
            'created_at' => now()->addMinutes(2),
                'updated_at' => now(),
        ]);
    }
}
