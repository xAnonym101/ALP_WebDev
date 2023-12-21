<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category_name' => 'Tops'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Bottoms'
        ]);
        DB::table('categories')->insert([
            'category_name' => 'Accessories'
        ]);
    }
}
