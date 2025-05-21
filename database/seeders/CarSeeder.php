<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        //DB::table('cars')->truncate();
        DB::table('cars')->insert([
            ['car_id' => 1, 'branch_id' => 1, 'car_name' => 'Supra', 'brand' => 'Toyota', 'type' => 'sedan', 'transmission' => 'automatic'],
            ['car_id' => 2, 'branch_id' => 2, 'car_name' => 'Civic', 'brand' => 'Honda', 'type' => 'suv', 'transmission' => 'manual'],
        ]);
    }
}
