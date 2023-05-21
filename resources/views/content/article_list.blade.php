@extends('layouts.master')

@push('stylesheet')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
@endpush

@section('title')
    Article
@endsection

@section('link')
    <a href="/article/create">create new article</a>
@endsection

@section('content')
    <table class="table" id="article">
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Author</th>
            <th scope="col">Judul</th>
            <th scope="col">Kategori</th>
            <th scope="col">Tanggal</th>
            @auth
                <th scope="col">Detail</th>
            @endauth

        </tr>
        </thead>
        <tbody>
        @forelse ($articles as $key => $value)
            <tr>
                <td scope="row">{{$key + 1}}</td>
                <td>
                    @if ($value->user->profile->profilepicture)
                        <img src="/img/user/{{$value->user->profile->profilepicture}}"class="img-circle elevation-2" alt="User Image" style="width:30px;height:30px;">
                    @else
                        <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2" alt="User Image" style="width:30px;height:30px;">
                    @endif

                    &emsp;{{$value->user->nickname}}
                </td>
                <td>{{$value->title}}</td>
                <td>{{$value->category->name}}</td>
                <td>{{$value->created_at}}</td>
                @auth
                    <td>
                        <form action="/article/{{$value->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="/article/{{$value->id}}" class="btn btn-info btn-sm">Detail</a>
                            @if (Auth::id()==$value->user->id)
                                <a href="/article/{{$value->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            @endif
                        </form>
                    </td>
                @endauth

            </tr>
        @empty
            <tr>
                <td>Artikel Kosong</td>
                <td></td>
                <td></td>
                <td></td>
                @auth
                    <td></td>
                @endauth
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#article').DataTable();
        } );
    </script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
@endpush
