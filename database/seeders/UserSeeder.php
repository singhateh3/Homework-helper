<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'michael@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'David Brown',
                'email' => 'david@example.com',
                'password' => Hash::make('password')
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
