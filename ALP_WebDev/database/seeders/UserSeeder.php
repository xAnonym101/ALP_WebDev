<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Replace 'your-email@example.com' and 'your-password' with the desired values
        $email = 'admin@gmail.com';
        $password = Hash::make('adminadmin12345');

        // Check if a user with the given email already exists
        $existingUser = DB::table('users')->where('email', $email)->first();

        // If the user doesn't exist, insert the default user
        if (!$existingUser) {
            DB::table('users')->insert([
                'name' => 'Your Name',
                'email' => $email,
                'password' => $password,
            ]);

            $this->command->info('Default user created with email: ' . $email);
        } else {
            $this->command->info('User with email ' . $email . ' already exists.');
        }
    }
}
