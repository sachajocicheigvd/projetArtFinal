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
            'title' => 'Aimez-vous les chatons ?',
            'duration' => 600,
            'type' => 'text',
            'picture' => 'http://placekitten.com/200/300',

            'created_at' => now(),
                'updated_at' => now(),
        ]);

        DB::table('surveys')->insert([
            'user_id' => 2,
            'title' => 'Aimez-vous Couleur 3 ?',
            'duration' => 600,
            'type' => 'text',
            'picture' => 'https://emphase.ch/wp/wp-content/uploads/2016/09/05-COULEUR3.jpg',
            'created_at' => now(),
                'updated_at' => now(),
        ]);
    }
}
