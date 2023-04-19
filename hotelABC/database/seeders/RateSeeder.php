<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rate::factory()->create(
            ['suite_type'=>'0','stay_type'=>'BB','cost'=>'15000'],
        );
        Rate::factory()->create(
            ['suite_type'=>'0','stay_type'=>'FB','cost'=>'25000'],
        );
        Rate::factory()->create(
            ['suite_type'=>'1','stay_type'=>'BB','cost'=>'25000'],
        );
        Rate::factory()->create(
            ['suite_type'=>'1','stay_type'=>'FB','cost'=>'40000'],
        );

    }
}
