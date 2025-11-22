<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug', 'categorie_id', 'artist_id', 'thumbnail', 'title', 'content', 'tag'
    ];

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')
                    ->with('replies.user');
    }

    public function relatedArticles() {
        return self::where('categorie_id', $this->categorie_id)
                    ->where('id', '<>', $this->id)
                    ->take(3)
                    ->get();
    }
}
