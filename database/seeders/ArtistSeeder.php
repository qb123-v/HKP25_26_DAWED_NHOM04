<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        $artists = [
            [
                'slug' => 'artist-john-doe',
                'name' => 'John Doe',
                'bio' => 'A popular artist in the world.',
                'avatar' => 'images/artists/john.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'artist-jane-smith',
                'name' => 'Jane Smith',
                'bio' => 'Famous for modern art.',
                'avatar' => 'images/artists/jane.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'artist-mike-lee',
                'name' => 'Mike Lee',
                'bio' => 'Known for classical paintings.',
                'avatar' => 'images/artists/mike.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($artists as $artist) {
            DB::table('artists')->updateOrInsert(
                ['slug' => $artist['slug']],
                $artist
            );
        }
    }
}
