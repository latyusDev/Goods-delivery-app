<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Dispatcher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::insert([
            [
            'state'=>'Ogun ',
            'street'=>'Memudu',
            'Number'=>24,
            'local_government'=>'Surulere',
            'addresable_type'=>Admin::class,
            'addresable_id'=>2,
            ],

            [
                'state'=>'Lagos ',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Admin::class,
                'addresable_id'=>1,
            ],

            [
                'state'=>'Lagos ',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Admin::class,
                'addresable_id'=>3,
            ],

            [
                'state'=>'Lagos ',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Admin::class,
                'addresable_id'=>4,
            ],

            [
                'state'=>'Lagos ',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Admin::class,
                'addresable_id'=>5,
            ],
            // dispatcher address
                
               [
                'state'=>'Lagos',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Dispatcher::class,
                'addresable_id'=>1,
                ],

               [
                'state'=>'Lagos',
                'street'=>'Memudu',
                'Number'=>24,
                'local_government'=>'Surulere',
                'addresable_type'=>Dispatcher::class,
                'addresable_id'=>2,
                ],
    
                [
                    'state'=>'Lagos ',
                    'street'=>'Memudu',
                    'Number'=>24,
                    'local_government'=>'Etiosa',
                    'addresable_type'=>Dispatcher::class,
                    'addresable_id'=>3,
                ],
    
                [
                    'state'=>'Lagos ',
                    'street'=>'Memudu',
                    'Number'=>24,
                    'local_government'=>'Epe',
                    'addresable_type'=>Dispatcher::class,
                    'addresable_id'=>4,
                ],
    
                [
                    'state'=>'Lagos ',
                    'street'=>'Memudu',
                    'Number'=>24,
                    'local_government'=>'Etiosa',
                    'addresable_type'=>Dispatcher::class,
                    'addresable_id'=>5,
                ],
                // user
                    
                   [
                    'state'=>'Lagos',
                    'street'=>'Memudu',
                    'Number'=>24,
                    'local_government'=>'Surulere',
                    'addresable_type'=>User::class,
                    'addresable_id'=>1,
                    ],
    
                   [
                    'state'=>'Lagos',
                    'street'=>'Memudu',
                    'Number'=>24,
                    'local_government'=>'Surulere',
                    'addresable_type'=>User::class,
                    'addresable_id'=>2,
                    ],
        
                    [
                        'state'=>'Lagos ',
                        'street'=>'Memudu',
                        'Number'=>24,
                        'local_government'=>'Etiosa',
                        'addresable_type'=>User::class,
                        'addresable_id'=>3,
                    ],
        
                    [
                        'state'=>'Lagos ',
                        'street'=>'Memudu',
                        'Number'=>24,
                        'local_government'=>'Epe',
                        'addresable_type'=>User::class,
                        'addresable_id'=>4,
                    ],
        
                    [
                        'state'=>'Lagos ',
                        'street'=>'Memudu',
                        'Number'=>24,
                        'local_government'=>'Etiosa',
                        'addresable_type'=>User::class,
                        'addresable_id'=>5,
                    ],
        ]);

    }
}
