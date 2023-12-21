<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phones')->insert([
            'phone_number' => '0987654321',
            'user_id' => '1',
        ]);

        DB::table('phones')->insert([
            'phone_number' => '1234567890',
            'user_id' => '1',
        ]);

        DB::table('phones')->insert([
            'phone_number' => '0594837261',
            'user_id' => '1',
        ]);
    }
}
