<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class locationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Insert Locations
         DB::table('locations')->insert([
            ['name' => 'Gedung JMI'],
            ['name' => 'Gedung Kuliah Bersama'],
            ['name' => 'Agroindustri'],
            ['name' => 'Pemeliharaan Mesin']
        ]);
    }
}
