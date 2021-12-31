@extends('layouts.supervisor-dashboard')

@section('user_name')
   {{ $user->name }} &nbsp;<i class="fa fa-caret-down"></i>
@endsection

@section('profile-pic-sm')
    {{ $user->photo ? $user->photo->path : 'vendor/assets/images/users/avatar-1.jpg' }}
@endsection

@section('profile-pic-lg')
    {{ $user->photo !== null ? $user->photo->path : 'vendor/assets/images/users/avatar-1.jpg' }}
@endsection

@section('page_name')
    See Location Map
@endsection

@section('alerts')

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                <strong>{{$error}}</strong>
            </li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

@section('table_name')
    <em> View {{$location->location}} Map</em>
@endsection

@section('table_content')

<div class="mapouter m-l-10 w-50">
    <div class="gmap_canvas">
        <iframe width="662" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $location->latitude }}, {{ $location->longitude }}&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        <a href="https://www.whatismyip-address.com"></a>
        <br>
        <style>
            .mapouter{position:relative;text-align:right;height:500px;width:662px;}
        </style>
        <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
        <style>
            .gmap_canvas {overflow:hidden;background:none!important;height:500px;width:inherit;}
        </style>
    </div>
</div>

@endsection
