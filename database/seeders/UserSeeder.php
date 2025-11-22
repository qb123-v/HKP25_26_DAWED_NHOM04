<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => '123@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        User::create([
            'name' => 'Test User 1',
            'email' => 'baoquang366@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
