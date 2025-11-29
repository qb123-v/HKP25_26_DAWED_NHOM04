<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'dob',
        'address',
        'intro',
        'avatar',
    ];

    // Một nghệ sĩ có nhiều bài viết
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
