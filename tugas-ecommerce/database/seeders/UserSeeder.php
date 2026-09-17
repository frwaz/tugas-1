<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin TokoKita', 'email' => 'admin@tokokita.test', 'role' => 'admin'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.test', 'role' => 'user'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.test', 'role' => 'user'],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name'     => $user['name'],
                    'role'     => $user['role'],
                    // Password dummy untuk kebutuhan testing: "password"
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
