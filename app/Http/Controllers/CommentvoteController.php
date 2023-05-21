<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentvote;
use App\Models\Comment;

class CommentvoteController extends Controller
{
    public function store(Request $request, string $id) {
        $idUser = Auth::id();
        $article_id = Comment::find($id)->article->id;

        if (Commentvote::find($id.$idUser)) {
            $vote = Commentvote::find($id.$idUser);
            if ($vote->value==$request->value) {
                Commentvote::where('id', $id.$idUser)->delete();
                return redirect ('/article/'.$article_id);
            }
        } else {
            $vote = new Commentvote;
        }

        $vote->id = $id.$idUser;
        $vote->value = $request->value;
        $vote->user_id = $idUser;
        $vote->comment_id = $id;
        $vote->save();

        return redirect ('/article/'.$article_id);
    }
}
