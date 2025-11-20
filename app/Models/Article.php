<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'categorie_id',
        'artist_id',
        'thumbnail',
        'title',
        'content',
        'tag'
      'views'
    ];

    // Quan hệ với nghệ sĩ
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // Quan hệ với danh mục
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Quan hệ với comment, chỉ lấy comment cha, kèm reply và user
    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id')
            ->with(['replies.user']);
    }

    // Lấy 3 bài viết liên quan cùng category, không lấy chính nó
    public function relatedArticles()
    {
        return self::where('categorie_id', $this->categorie_id)
            ->where('id', '<>', $this->id)
            ->take(3)
            ->get();
    }
}
