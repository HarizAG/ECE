<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('staff')->insert([
            ['staff_id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com', 'password' => bcrypt('password'), 'branch_id' => 1],
            ['staff_id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com', 'password' => bcrypt('password'), 'branch_id' => 2],
        ]);
    }
}
