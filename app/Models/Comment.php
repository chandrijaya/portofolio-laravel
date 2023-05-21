<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['content', 'user_id', 'article_id', 'created_at', 'updated_at'];

    public function commentvotes() {
        return $this->hasMany(Commentvote::class, 'comment_id');
    }

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
