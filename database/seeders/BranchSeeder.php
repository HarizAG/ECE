<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::table('branches')->truncate();
        Branch::insert([
            ['name' => 'Bangi', 'phone' => '0173115772', 'address' => 'No.40, Seksyen 9, Bandar Baru Bangi'],
            ['name' => 'Gombak', 'phone' => '01112159442', 'address' => 'Lot 36, Taman Harum, Gombak'],
            ['name' => 'Shah Alam', 'phone' => '0109035711', 'address' => 'Jalan Gemilang, Seksyen 4, Shah Alam'],
        ]);
    }
}
