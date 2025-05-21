<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarBookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('car_booking')->truncate();
        DB::table('car_booking')->insert([
            ['car_id' => 1, 'booking_id' => 1],
            ['car_id' => 2, 'booking_id' => 2],
        ]);
    }
}
