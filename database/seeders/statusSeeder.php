<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Insert Locations
         DB::table('ticket_status')->insert([
            ['name' => 'Open'],
            ['name' => 'Closed'],
            ['name' => 'Proses'],
            ['name' => 'Updated']
        ]);
    }
}
