<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Articlevote;


class ArticlevoteController extends Controller
{
    public function store(Request $request, string $id) {
        $idUser = Auth::id();

        if (Articlevote::find($id.$idUser)) {
            $vote = Articlevote::find($id.$idUser);
            if ($vote->value==$request->value) {
                Articlevote::where('id', $id.$idUser)->delete();
                return redirect ('/article/'.$id);
            }
        } else {
            $vote = new Articlevote;
        }

        $vote->id = $id.$idUser;
        $vote->value = $request->value;
        $vote->user_id = $idUser;
        $vote->article_id = $id;
        $vote->save();

        return redirect ('/article/'.$id);
    }
}
