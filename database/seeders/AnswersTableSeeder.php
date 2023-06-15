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
            'answer' => 'Bella',
            'survey_id' => 1,
            'artist' => 'Maître Gims',
            'picture' => '',
            'created_at' => now()->addMinutes(1),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Waka Waka',
            'survey_id' => 1,
            'artist' => 'Shakira',
            'picture' => '',
            'created_at' => now()->addMinutes(1),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Bof',
            'survey_id' => 2,
            'created_at' => now()->addMinutes(2),
                'updated_at' => now(),
        ]);

        DB::table('answers')->insert([
            'answer' => 'Moui',
            'survey_id' => 2,
            'created_at' => now()->addMinutes(2),
                'updated_at' => now(),
        ]);
    }
}
