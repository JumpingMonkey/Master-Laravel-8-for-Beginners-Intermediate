@extends('layouts.app')

@section('title', 'User edit')

@section('content')
     <div class="row">
        <div class="col-4">
            <img src="#" class="img-thumbnail">
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>
        </div>
    </div>
@endsection