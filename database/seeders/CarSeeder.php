<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cars')->insert([
            ['car_id' => 1, 'branch_id' => 1, 'brand' => 'Toyota', 'type' => 'sedan', 'transmission' => 'automatic'],
            ['car_id' => 2, 'branch_id' => 2, 'brand' => 'Honda', 'type' => 'suv', 'transmission' => 'manual'],
        ]);
    }
}
