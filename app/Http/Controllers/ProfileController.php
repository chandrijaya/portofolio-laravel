<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index(){
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('user.index', ['profile' => $profile]);
    }

    public function update(Request $request, $id) {
        #dd($request->all());
        $request->validate([
            'nickname' => 'required',
            'profilepicture' => 'image|mimes:jpg,jpeg,png'
        ]);

        $profile = Profile::find($id);
        $user = User::find(Auth::id());

        $image = $request->profilepicture;
        if($image){
            if(File::exists(public_path('img/user/').$profile->profilepicture)){
                File::delete(public_path('img/user/').$profile->profilepicture);
            }
            $imageName = $request->nickname.'-'.time().'.'.$image->extension();
            Image::make($image)->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('img/user/').$imageName);
            $profile->profilepicture = $imageName;
        }
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $user->nickname = $request->nickname;
        $user->email = $request->email;

        $profile->save();
        $user->save();

        return redirect('/home');
    }

    public function show(string $nickname)
    {
        $id = User::select('id')->where('nickname', $nickname)->get()->first();
        $profile = Profile::where('user_id', $id->id)->first();
        return view('user.profile', ['profile' => $profile, 'nickname' => $nickname]);
    }

    public function showarticle(string $nickname)
    {
        $articles = User::where('nickname', $nickname)->firstOrFail();
        $articles = $articles->articles;
        return view('content.article_list', ['articles' => $articles]);
    }
}
