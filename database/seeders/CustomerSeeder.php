<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['customer_id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'password' => bcrypt('password'), 'phone' => '1234567890'],
            ['customer_id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => bcrypt('password'), 'phone' => '0987654321'],
        ]);
    }
}
