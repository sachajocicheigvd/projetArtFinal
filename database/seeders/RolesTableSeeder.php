<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            'short_description' => 'user',
            'long_description' => 'users who have registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'short_description' => 'admin',
            'long_description' => 'admins have all rights to create surveys and questions',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
