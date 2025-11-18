<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'slug' => 'breaking-news-world',
                'categorie_id' => 1,
                'artist_id' => null,
                'thumbnail' => 'thumb1.jpg',
                'title' => 'Breaking News in the World',
                'content' => 'Content of the breaking news in the world...',
                'tag' => 'world,news',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'tech-innovations-2025',
                'categorie_id' => 7,
                'artist_id' => null,
                'thumbnail' => 'thumb2.jpg',
                'title' => 'Tech Innovations 2025',
                'content' => 'Content about the tech innovations in 2025...',
                'tag' => 'technology,innovation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'politics-today',
                'categorie_id' => 3,
                'artist_id' => 2, // Jane Smith
                'thumbnail' => 'thumb3.jpg',
                'title' => 'Politics Today',
                'content' => 'Content about current political events...',
                'tag' => 'politics,government',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $relatedArticles = [
            // Category 1 (World)
            [
                'slug' => 'world-economy-update',
                'categorie_id' => 1,
                'artist_id' => 1, // John Doe
                'thumbnail' => 'thumb4.jpg',
                'title' => 'World Economy Update',
                'content' => 'Content about global economy updates...',
                'tag' => 'world,economy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'global-conflict-news',
                'categorie_id' => 1,
                'artist_id' => null,
                'thumbnail' => 'thumb5.jpg',
                'title' => 'Global Conflict News',
                'content' => 'Content about international conflicts...',
                'tag' => 'world,conflict',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category 7 (Technology)
            [
                'slug' => 'ai-innovation-2025',
                'categorie_id' => 7,
                'artist_id' => null,
                'thumbnail' => 'thumb6.jpg',
                'title' => 'AI Innovation 2025',
                'content' => 'Content about AI and technology trends in 2025...',
                'tag' => 'ai,technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'future-gadgets',
                'categorie_id' => 7,
                'artist_id' => null,
                'thumbnail' => 'thumb7.jpg',
                'title' => 'Future Gadgets',
                'content' => 'Content about futuristic gadgets and devices...',
                'tag' => 'gadgets,technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category 3 (Politics) related
            [
                'slug' => 'political-analysis',
                'categorie_id' => 3,
                'artist_id' => 3, // Mike Lee
                'thumbnail' => 'thumb8.jpg',
                'title' => 'Political Analysis',
                'content' => 'In-depth political analysis...',
                'tag' => 'politics,analysis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'election-updates',
                'categorie_id' => 3,
                'artist_id' => 1, // John Doe
                'thumbnail' => 'thumb9.jpg',
                'title' => 'Election Updates',
                'content' => 'Latest updates on elections...',
                'tag' => 'politics,election',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach (array_merge($articles, $relatedArticles) as $article) {
            DB::table('articles')->updateOrInsert(
                ['slug' => $article['slug']],
                $article
            );
        }
    }
}
