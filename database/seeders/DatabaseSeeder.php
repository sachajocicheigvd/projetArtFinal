<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(SurveysTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(GenreUserTableSeeder::class);
        $this->call(AnswerUserTableSeeder::class);
    }
}
