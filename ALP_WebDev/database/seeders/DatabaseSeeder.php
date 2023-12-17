<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_name' => 'Tops',
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Bottoms',
        ]);
    }
}
