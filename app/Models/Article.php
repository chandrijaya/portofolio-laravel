<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = ['title', 'content', 'thumbnail','category_id','user_id','created_at', 'updated_at'];

    public function articlevotes() {
        return $this->hasMany(Articlevote::class, 'article_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
