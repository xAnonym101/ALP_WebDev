<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            'event_name' => 'Halloween',
            'status' => '0',
        ]);
        DB::table('events')->insert([
            'event_name' => 'Christmas',
            'status' => '0',
        ]);
    }
}
