<?php

namespace Database\Seeders;

use App\Models\Dispatcher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DispatcherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dispatcher::insert([
            [
                'first_name' => 'yunus ',
                'last_name' => ' Abdullateef',
                'phone_number' => 8027259386,
                'email' => 'dispatcher1@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'sulaiman',
                'last_name' => ' saheed',
                'phone_number' => 8027259386,
                'email' => 'dispatcher2@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'uthman',
                'last_name' => ' fatai',
                'phone_number' => 8027259386,
                'email' => 'dispatcher3@gmail.com',
                'password' => Hash::make('aaa')
            ],

            [
                'first_name' => 'balikis ',
                'last_name' => ' lukman',
                'phone_number' => 8027259386,
                'email' => 'dispatcher4@gmail.com',
                'password' => Hash::make('aaa')
            ],
        ]);
    }
}
