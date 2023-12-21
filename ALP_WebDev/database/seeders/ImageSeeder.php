<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uploadedFilePath = 'storage/app/public/triangle.png';
        $filenameWithoutExtension = pathinfo($uploadedFilePath, PATHINFO_FILENAME);
        $hashedFilename = hash('sha256', time() . '_' . $filenameWithoutExtension) . '.png';
        $storagePath = 'public/images/' . $hashedFilename;
        Storage::put($storagePath, file_get_contents($uploadedFilePath));

        DB::table('images')->insert([
            'image' => $hashedFilename,
            'product_id' => '1',
        ]);
        DB::table('images')->insert([
            'image' => $hashedFilename,
            'product_id' => '2',
        ]);
        DB::table('images')->insert([
            'image' => $hashedFilename,
            'product_id' => '3',
        ]);
    }
}
