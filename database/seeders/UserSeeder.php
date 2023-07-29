<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'first_name' => 'yunus ',
                'last_name' => ' Abdullateef',
                'phone_number' => 8027259386,
                'email' => 'user1@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'sulaiman',
                'last_name' => ' saheed',
                'phone_number' => 8027259386,
                'email' => 'user2@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'uthman',
                'last_name' => ' fatai',
                'phone_number' => 8027259386,
                'email' => 'user3@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'balikis ',
                'last_name' => ' lukman',
                'phone_number' => 8027259386,
                'email' => 'user4@gmail.com',
                'password' => Hash::make('aaa')
            ],
        ]);
    }
}
