<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        \App\Models\User::create([
            'name' => 'Admin Stylo',
            'email' => 'admin@stylo.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'avatar' => null,
        ]);

        // Create Customer
        \App\Models\User::create([
            'name' => 'Customer Stylo',
            'email' => 'customer@stylo.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'avatar' => null,
        ]);
    }
}
