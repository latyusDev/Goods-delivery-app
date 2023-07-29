<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Admin::insert([
            [
            'first_name'=>'Abdullateef',
            'last_name'=>'Yunus ',
            'email'=>'admin1@gmail.com ',
            'phone_number'=>8027259386,
            'password'=>bcrypt('aaa'),
            'is_manager'=>true
    
            ],
            [
                'first_name'=>' Sulaiman',
                'last_name'=>'Saheed ',
                'email'=>'admin2@gmail.com ',
                'phone_number'=>8027259386,
                'password'=>bcrypt('aaa'),
                'is_manager'=>true
        
            ],

            [
                'first_name'=>' Uthman',
                'last_name'=>'Fatai ',
                'email'=>'admin3@gmail.com ',
                'phone_number'=>8027259386,
                'password'=>bcrypt('aaa'),
                'is_manager'=>true
        
            ],

            [
                'first_name'=>'Tajudeen',
                'last_name'=>'Abdulwahaab ',
                'email'=>'admin4@gmail.com ',
                'phone_number'=>8027259386,
                'password'=>bcrypt('aaa'),
                'is_manager'=>false
        
            ],

            [
                'first_name'=>' Popoola',
                'last_name'=>'Fawas',
                'email'=>'admin5@gmail.com ',
                'phone_number'=>8027259386,
                'password'=>bcrypt('aaa'),
                'is_manager'=>false
        
            ],
            [
                'first_name'=>' Ismail',
                'last_name'=>'Ademola',
                'email'=>'admin6@gmail.com ',
                'phone_number'=>8027259386,
                'password'=>bcrypt('aaa'),
                'is_manager'=>false
        
            ],
        ]);
            


    }
}
