<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin Yayasan
        User::create([
            'nama' => 'Admin Yayasan',
            'email' => 'yayasan@example.com',
            'password' => Hash::make('password'),
            'role' => 'yayasan',
            'unit_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin Unit (misal unit_id = 1)
        User::create([
            'nama' => 'Admin Unit',
            'email' => 'unit@example.com',
            'password' => Hash::make('password'),
            'role' => 'unit',
            'unit_id' => 1,
        ]);
    }
}
