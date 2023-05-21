@extends('layouts.master')

@push('stylesheet')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush

@section('title')
    {{$article->title}}
@endsection

@section('link')
    @auth
        @if (Auth::id() != $article->user->id)
            <form action="/article/{{$article->id}}/vote" method="POST">
                @csrf
                <button type="submit" name="value" class="btn btn-success btn-sm" value="1"><i class="bi bi-hand-thumbs-up"></i>
                    &emsp; {{($article->articlevotes->
                    where('value', 1)->
                    where('article_id', '=', $article->id)->count())}}
                </button>
                <button type="submit" name="value" class="btn btn-danger btn-sm" value="0"><i class="bi bi-hand-thumbs-down"></i>
                    &emsp; {{($article->articlevotes->
                    where('value', 0)->
                    where('article_id', '=', $article->id)->count())}}
                </button>
            </form>
        @else
            <button type="submit" name="value" class="btn btn-success btn-sm disabled" value="1"><i class="bi bi-hand-thumbs-up"></i>
                &emsp; {{($article->articlevotes->
                where('value', 1)->
                where('article_id', '=', $article->id)->count())}}
            </button>
            <button type="submit" name="value" class="btn btn-danger btn-sm disabled" value="0"><i class="bi bi-hand-thumbs-down"></i>
                &emsp; {{($article->articlevotes->
                where('value', 0)->
                where('article_id', '=', $article->id)->count())}}
            </button>
        @endif
    @endauth
@endsection

@section('content')
    {!! nl2br($article->content) !!}

    <hr>
    <h4>List Komentar</h4>
    @forelse ($article->comments as $comment)
        <div class="media my-3 border p-3">
            @if ($comment->user->profile->profilepicture)
                <img src="/img/user/{{$comment->user->profile->profilepicture}}"class="img-circle elevation-2 mr-3" alt="User Image" style="width:80px;height:80px;">
            @else
                <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2 mr-3" alt="User Image" style="width:80px;height:80px;">
            @endif
            <div class="media-body">
                <h5 class="mt-0">{{$comment->user->nickname}}</h5>
                <p>{{$comment->content}}</p>
            </div>
            <div>
                <p>{{$comment->created_at}}</p>
                @auth
                    @if (Auth::id() == $comment->user->id)
                        <div>
                            <button type="submit" name="value" class="btn btn-success btn-sm disabled" value="1"><i class="bi bi-hand-thumbs-up"></i>
                                &emsp; {{($comment->commentvotes->
                                where('value', 1)->
                                where('comment_id', '=', $comment->id)->count())}}
                            </button>
                            <button type="submit" name="value" class="btn btn-danger btn-sm disabled" value="0"><i class="bi bi-hand-thumbs-down"></i>
                                &emsp; {{($comment->commentvotes->
                                where('value', 0)->
                                where('comment_id', '=', $comment->id)->count())}}
                            </button>
                        </div>

                        <form action="/comment/{{$article->id}}/{{$comment->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Hapus Komentar" class="btn btn-danger btn-sm">
                        </form>
                    @else
                        <form action="/comment/{{$comment->id}}/vote" method="POST">
                            @csrf
                            <button type="submit" name="value" class="btn btn-success btn-sm" value="1"><i class="bi bi-hand-thumbs-up"></i>
                                &emsp; {{($comment->commentvotes->
                                where('value', 1)->
                                where('comment_id', '=', $comment->id)->count())}}
                            </button>
                            <button type="submit" name="value" class="btn btn-danger btn-sm" value="0"><i class="bi bi-hand-thumbs-down"></i>
                                &emsp; {{($comment->commentvotes->
                                where('value', 0)->
                                where('comment_id', '=', $comment->id)->count())}}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

    @empty
        <h5>Belum ada komentar</h5>
    @endforelse
    <hr>
    @auth
        <form action="/comment/{{$article->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Tulis Komentar</label>
                <input type="text" name="content" class="form-control">
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Komentar</button>
        </form>
    @endauth
@endsection
