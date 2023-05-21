@extends('layouts.master')

@section('title')
    Update Profile
@endsection

@section('content')
    <form action="/profile/{{$profile->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            @if (is_null($profile->profilepicture))
            <div class="image">
                <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2 mx-auto d-block" alt="User Image" style="width:400px;height:400px;">
            </div>
            @else
            <div class="image">
                <img src="/img/user/{{$profile->profilepicture}}" class="img-circle elevation-2 mx-auto d-block" alt="User Image" style="width:400px;height:400px;">
            </div>
            @endif
            <label>Foto Profil</label>
            <input type="file" name="profilepicture" class="form-control">
            @error('nickname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nama Depan</label>
            <input type="text" name="firstname" class="form-control" value="{{$profile->firstname}}">
            <label>Nama Belakang</label>
            <input type="text" name="lastname" class="form-control" value="{{$profile->lastname}}">
        </div>
        <div class="form-group">
            <label>Nickname</label>
            <input type="text" name="nickname" class="form-control" value="{{$profile->user->nickname}}">
        </div>
        @error('nickname')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{$profile->user->email}}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Profile</button>
    </form>
@endsection
