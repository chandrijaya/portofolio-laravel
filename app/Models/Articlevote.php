<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articlevote extends Model
{
    use HasFactory;

    protected $table = 'article_votes';

    protected $fillable = ['id', 'value', 'user_id', 'article_id'];

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
