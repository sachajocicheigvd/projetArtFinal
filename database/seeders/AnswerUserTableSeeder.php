<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suppression des données de la table
        DB::table('answer_user')->delete();

        // 3 insertions aléatoires
        for ($i = 0; $i < 3; $i++) {
            DB::table('answer_user')->insert([
                'answer_id' => $i+1,
                'user_id' => $i+1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
