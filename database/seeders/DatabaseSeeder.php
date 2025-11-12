<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => '123@gmail.com',
            // 'avatar' => 'avt.jpg',
            'password' => Hash::make('password123'),
        ]);
        // $this->call(AdminSeeder::class);
        User::create([
            'name' => 'Test User',
            'email' => 'baoquang366@gmail.com',
            // 'avatar' => 'avt.jpg',
            'password' => Hash::make('password123'),
        ]);
    }
}
