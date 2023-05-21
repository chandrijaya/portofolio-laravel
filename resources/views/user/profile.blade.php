@extends('layouts.master')

@section('title')
    Profile {{$nickname}}
@endsection

@section('content')
<div class="image">
    @if (is_null($profile->profilepicture))
        <div class="image">
            <img src={{asset("/img/asset/default-profile-icon.jpg")}} class="img-circle elevation-2 mx-auto d-block" alt="User Image" style="width:400px;height:400px;">
        </div>
    @else
        <div class="image">
            <img src="/img/user/{{$profile->profilepicture}}" class="img-circle elevation-2 mx-auto d-block" alt="User Image" style="width:400px;height:400px;">
        </div>
    @endif
</div><br>
<p>{{$profile->firstname}} {{$profile->lastname}}</p>
@endsection
