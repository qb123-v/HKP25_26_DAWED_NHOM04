<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Article;

class Categorie extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',

    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
