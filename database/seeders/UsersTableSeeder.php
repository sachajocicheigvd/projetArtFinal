<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'last_name' => 'Marques',
            'first_name' => 'Patrick',
            'email' => 'patrickmarques@couleur3.ch',
            'username' => 'Patoch',
            'password' => Hash::make('Patoch'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'last_name' => 'Graber',
            'first_name' => 'Olivier',
            'email' => 'oliviergraber@couleur3.ch',
            'username' => 'Olive',
            'password' => Hash::make('Olive'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'last_name' => 'Dorasamy',
            'first_name' => 'Ryan',
            'email' => 'ryandorasamy@couleur3.ch',
            'username' => 'Tupidix',
            'password' => Hash::make('Tupidix'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'last_name' => 'Jocic',
            'first_name' => 'Sacha',
            'email' => 'sachajocic@couleur3.ch',
            'username' => 'Sacha',
            'password' => Hash::make('Sacha'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'last_name' => 'Heig',
            'first_name' => 'Admin',
            'email' => 'adminheig@couleur3.ch',
            'username' => 'Admin',
            'password' => Hash::make('Admin'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
