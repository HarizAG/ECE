<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        //DB::table('bookings')->truncate();
        DB::table('bookings')->insert([
            ['booking_id' => 1, 'customer_id' => 1, 'start_date' => '2025-05-20', 'end_date' => '2025-05-25', 'status' => 'confirmed'],
            ['booking_id' => 2, 'customer_id' => 2, 'start_date' => '2025-06-01', 'end_date' => '2025-06-05', 'status' => 'pending'],
        ]);
    }
}
