<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{


    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
