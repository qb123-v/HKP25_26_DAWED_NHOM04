<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'bio',
        'avatar', // dùng asset để hiển thị ảnh
    ];

    // Một nghệ sĩ có nhiều bài viết
    public function articles() {
        return $this->hasMany(Article::class);
    }
}
