<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Approver Level 1',
            'email' => 'approver1@example.com',
            'password' => Hash::make('password'),
            'role' => 'approver_level_1',
        ]);

        User::create([
            'name' => 'Approver Level 2',
            'email' => 'approver2@example.com',
            'password' => Hash::make('password'),
            'role' => 'approver_level_2',
        ]);

        User::create([
            'name' => 'Pegawai Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::factory(10)->create(); // Buat 10 user biasa lainnya
    }
}
