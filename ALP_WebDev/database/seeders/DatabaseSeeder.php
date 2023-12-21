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
        $this->call([
            UserSeeder::class,
            PhoneSeeder::class,
            SocialSeeder::class,
            CategorySeeder::class,
            EventSeeder::class,
            ProductSeeder::class,
            VariantSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
