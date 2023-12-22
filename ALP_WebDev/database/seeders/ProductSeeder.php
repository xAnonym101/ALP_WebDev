<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'Kemeja Putih',
                'description' => 'Untuk kegiatan formal, bisa dipakai sehari-hari',
                'best_seller' => '0',
                'price' => '400000',
                'discount_percent' => '15',
                'category_id' => '1',
                'final_price' => 400000 - (400000 * (15 / 100)),
                // 'event_id',
            ],

            [
                'product_name' => 'Jeans Hitam',
                'description' => 'Untuk kegiatan formal, bisa dipakai sehari-hari',
                'best_seller' => '0',
                'price' => '300000',
                'discount_percent' => '10',
                'category_id' => '2',
                'final_price' => 300000 - (300000 * (10 / 100))
                // 'event_id',
            ],

            [
                'product_name' => 'Tas Hitam',
                'description' => 'Stylish dan kinclong :v',
                'best_seller' => '1',
                'price' => '500000',
                'discount_percent' => '15',
                'category_id' => '3',
                'final_price' => 500000 - (500000 * (15 / 100))
                // 'event_id',
            ],
            // Add other products here...
        ];

        foreach ($products as $productData) {
            // Insert product data
            $product_id = DB::table('products')->insertGetId($productData);
        }
    }
}
