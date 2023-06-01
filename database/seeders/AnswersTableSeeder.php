<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suppression des données de la table
        DB::table('answers')->delete();

        // Remplissage de la table
        DB::table('answers')->insert([
            'answer' => 'Oui',
            'survey_id' => 1,
            'picture' => 'https://emphase.ch/wp/wp-content/uploads/2016/09/05-COULEUR3.jpg',
            'created_at' => now(),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Non',
            'survey_id' => 1,
            'picture' => 'http://placekitten.com/400/400',
            'created_at' => now(),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Bof',
            'survey_id' => 2,
            'picture' => 'http://placekitten.com/300/300',
            'created_at' => now(),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Moui',
            'survey_id' => 2,
            'picture' => 'http://placekitten.com/300/300',
            'created_at' => now(),
                'updated_at' => now(),
        ]);
    }
}
