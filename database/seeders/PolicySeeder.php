<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            [
                'privacy_policy'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit',
                'terms_conditions'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit',
                'refund_policy'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit',
                'payment_policy'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit',
                'about_us'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit'
                
            ]
        ];
        Policy::insert($policies);
    }
}
