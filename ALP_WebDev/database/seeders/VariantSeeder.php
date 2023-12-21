<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('variants')->insert([
            'product_id' => '1',
            'variant_name' => 'A',
            'color' => 'Pink',
            'description' => 'Warna dasar pakaian + sedikit pink'
        ]);

        DB::table('variants')->insert([
            'product_id' => '1',
            'variant_name' => 'B',
            'color' => 'Orange',
            'description' => 'Warna dasar pakaian + sedikit jingga'
        ]);

        DB::table('variants')->insert([
            'product_id' => '1',
            'variant_name' => 'C',
            'color' => 'Merah',
            'description' => 'Warna dasar pakaian + sedikit Merah'
        ]);

        DB::table('variants')->insert([
            'product_id' => '2',
            'variant_name' => 'A',
            'color' => 'Pink',
            'description' => 'Warna dasar pakaian + sedikit pink'
        ]);

        DB::table('variants')->insert([
            'product_id' => '2',
            'variant_name' => 'B',
            'color' => 'Orange',
            'description' => 'Warna dasar pakaian + sedikit jingga'
        ]);

        DB::table('variants')->insert([
            'product_id' => '2',
            'variant_name' => 'C',
            'color' => 'Merah',
            'description' => 'Warna dasar pakaian + sedikit Merah'
        ]);

        DB::table('variants')->insert([
            'product_id' => '3',
            'variant_name' => 'A',
            'color' => 'Pink',
            'description' => 'Warna dasar pakaian + sedikit pink'
        ]);

        DB::table('variants')->insert([
            'product_id' => '3',
            'variant_name' => 'B',
            'color' => 'Orange',
            'description' => 'Warna dasar pakaian + sedikit jingga'
        ]);

        DB::table('variants')->insert([
            'product_id' => '3',
            'variant_name' => 'C',
            'color' => 'Merah',
            'description' => 'Warna dasar pakaian + sedikit Merah'
        ]);
    }
}
