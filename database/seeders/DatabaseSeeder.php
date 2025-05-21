<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //DB::table('users')->truncate();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            BranchSeeder::class,
            //CustomerSeeder::class,
            //CarSeeder::class,
            //BookingSeeder::class,
            //CarBookingSeeder::class,
            //StaffSeeder::class,
        ]);
    }
}
