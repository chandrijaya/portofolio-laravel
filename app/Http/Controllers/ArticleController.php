<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

     public function index()
    {
        $articles = Article::find();
        dd($articles);
        return view('content.article_list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('content.create_article', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        #dd($request->all());
        $article = new Article;

        $id = Auth::id();
        $current = Carbon::now();
        $content = $request->content;

        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        $i = 0;
        foreach($images as $img){
            $src=$img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src,$groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = time().'_'.substr(md5($fileNameContent),6,6);
                $filePath = ("$fileNameContentRand.$mimetype");
                $image=Image::make($src)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($mimetype, 100)
                ->save(public_path('img/article/').$filePath);
                $new_src = '/img/article/'.$filePath;
                $img->removeAttribute('src');
                $img->setAttribute('src', str($new_src));
                $img->setAttribute('class','img-responsive');
                $i++;
                if(!$article->thumbnail){
                    $article->thumbnail = $filePath;
                }
            }
         }

        $content = $dom->saveHTML();



        $article->title = $request->title;
        $article->content = $dom->saveHTML();
        $article->category_id = $request->category_id;
        $article->user_id = $id;
        $article->created_at = $current;
        $article->updated_at = $current;

        $article->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->first();
        $categories = Category::get();
        return view('content.article_detail', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::where('id', $id)->first();
        $categories = Category::get();
        return view('content.article_edit', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required'
        ]);
        $current = Carbon::now();

        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->updated_at = $current;

        $article->save();

        return redirect('/article');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::where('id', $id)->delete();
        return redirect('/article');
    }
}
