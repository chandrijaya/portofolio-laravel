@extends('layouts.master')

@push('stylesheet')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endpush

@section('title')
    Ubah Artikel
@endsection


@section('content')
    <form action="/article" method="post">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" class="form-control" id="">
                <option value="">--pilih kategori--</option>
                @forelse ($categories as $item)
                    @if ($item->id == $article->category_id)
                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                @empty
                    <option value="">No Entry</option>
                @endforelse
            </select>
        </div>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <textarea id="summernote" name="content">{{$article->content}}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 400
        });
     </script>
@endsection

