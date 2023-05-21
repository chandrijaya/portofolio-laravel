<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request, string $id) {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment;
        $current = Carbon::now();
        $idUser = Auth::id();

        $comment->content = $request->content;
        $comment->user_id = $idUser;
        $comment->article_id = $id;
        $comment->created_at = $current;
        $comment->updated_at = $current;

        $comment->save();

        return redirect ('/article/'.$id);
    }

    public function destroy(string $idArticle, $idComment)
    {
        Comment::where('id', $idComment)->delete();
        return redirect('/article/'.$idArticle);
    }
}
