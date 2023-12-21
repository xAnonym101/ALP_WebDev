<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialSeeder extends Seeder
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

        DB::table('socials')->insert([
            'socialmedia_icon' => $hashedFilename,
            'socialmedia_name' => 'Instagam',
            'socialmedia_link' => 'instagramjentcollections',
            'user_id' => '1',
        ]);
        DB::table('socials')->insert([
            'socialmedia_icon' => $hashedFilename,
            'socialmedia_name' => 'TikTok',
            'socialmedia_link' => 'tiktokjentcollections',
            'user_id' => '1',
        ]);
        DB::table('socials')->insert([
            'socialmedia_icon' => $hashedFilename,
            'socialmedia_name' => 'Twitter',
            'socialmedia_link' => 'twitterjentcollections',
            'user_id' => '1',
        ]);
    }
}
