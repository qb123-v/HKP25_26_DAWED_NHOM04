<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest trends and innovations in technology.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
                'description' => 'Tips and news on health and wellness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Insights into lifestyle choices and trends.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Guides and tips for travel enthusiasts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Delicious recipes and food reviews.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Resources and news on education and learning.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial tips and investment news.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Latest news in movies, music, and entertainment.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Updates and news on various sports.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Insights and news on business and entrepreneurship.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Discoveries and news in the field of science.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'description' => 'Current events and news in politics.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Environment',
                'slug' => 'environment',
                'description' => 'News and tips on environmental issues.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
