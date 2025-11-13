<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'content',
    ];

    // Comment thuộc về bài viết
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Comment thuộc về user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Reply của comment
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user');
    }
}
