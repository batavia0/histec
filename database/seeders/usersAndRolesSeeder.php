<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class usersAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Insert Roles
         DB::table('roles')->insert([
            ['name' => 'Jaringan Internet'],
            ['name' => 'Software'],
            ['name' => 'Hardware'],
        ]);

        // Insert Users
        DB::table('users')->insert([
            [
                'name' => 'User Jaringan Internet',
                'email' => 'user1@example.com',
                'password' => Hash::make('admin'),
                'role_id' => 1, // Teknisi Jaringan Internet
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'User Software',
                'email' => 'user2@example.com',
                'password' => Hash::make('admin'),
                'role_id' => 2, // Teknisi Software
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),

            ],
            [
                'name' => 'User Hardware',
                'email' => 'user3@example.com',
                'password' => Hash::make('admin'),
                'role_id' => 3, // Teknisi Hardware
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),

            ],
        ]);
    }
}
