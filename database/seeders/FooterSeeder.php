<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $footers = [
            // Info
            ['title' => 'About AP', 'link' => '/about', 'type' => 'info', 'order' => 1],
            ['title' => 'Careers', 'link' => '/careers', 'type' => 'info', 'order' => 2],
            ['title' => 'Advertise', 'link' => '/advertise', 'type' => 'info', 'order' => 3],

            // Legal
            ['title' => 'Terms of Use', 'link' => '/terms', 'type' => 'legal', 'order' => 4],
            ['title' => 'Privacy Policy', 'link' => '/privacy', 'type' => 'legal', 'order' => 5],
            ['title' => 'Copyright', 'link' => '/copyright', 'type' => 'legal', 'order' => 6],

            // Social
            ['title' => 'Facebook', 'link' => 'https://facebook.com/APNews', 'type' => 'social', 'order' => 7],
            ['title' => 'Twitter', 'link' => 'https://twitter.com/AP', 'type' => 'social', 'order' => 8],
            ['title' => 'Instagram', 'link' => 'https://instagram.com/apnews', 'type' => 'social', 'order' => 9],

            // Sections / Categories
            ['title' => 'World', 'link' => '/section/world', 'type' => 'category', 'order' => 10],
            ['title' => 'US', 'link' => '/section/us', 'type' => 'category', 'order' => 11],
            ['title' => 'Politics', 'link' => '/section/politics', 'type' => 'category', 'order' => 12],
            ['title' => 'Business', 'link' => '/section/business', 'type' => 'category', 'order' => 13],
            ['title' => 'Health', 'link' => '/section/health', 'type' => 'category', 'order' => 14],
            ['title' => 'Science', 'link' => '/section/science', 'type' => 'category', 'order' => 15],
            ['title' => 'Technology', 'link' => '/section/technology', 'type' => 'category', 'order' => 16],
            ['title' => 'Entertainment', 'link' => '/section/entertainment', 'type' => 'category', 'order' => 17],
            ['title' => 'Sports', 'link' => '/section/sports', 'type' => 'category', 'order' => 18],
        ];

        DB::table('footers')->insert($footers);
    }
}
