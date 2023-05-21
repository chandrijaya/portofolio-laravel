<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentvote extends Model
{
    use HasFactory;

    protected $table = 'comment_votes';

    protected $fillable = ['id', 'value', 'user_id', 'comment_id', 'created_at', 'updated_at'];

    public function comment() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
