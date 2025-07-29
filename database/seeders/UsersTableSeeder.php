<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123@'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('client123@'),
            'role' => 'client',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Freelancer User',
            'email' => 'freelancer@example.com',
            'password' => Hash::make('freelancer123@'),
            'role' => 'freelancer',
            'is_active' => true,
        ]);
    }
}
