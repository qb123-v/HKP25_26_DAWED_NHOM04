<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'World', 'slug' => 'world', 'order' => 1],
            ['name' => 'US', 'slug' => 'us', 'order' => 2],
            ['name' => 'Politics', 'slug' => 'politics', 'order' => 3],
            ['name' => 'Business', 'slug' => 'business', 'order' => 4],
            ['name' => 'Health', 'slug' => 'health', 'order' => 5],
            ['name' => 'Science', 'slug' => 'science', 'order' => 6],
            ['name' => 'Technology', 'slug' => 'technology', 'order' => 7],
            ['name' => 'Entertainment', 'slug' => 'entertainment', 'order' => 8],
            ['name' => 'Sports', 'slug' => 'sports', 'order' => 9],
        ];

        DB::table('categories')->insert($categories);
    }
}
