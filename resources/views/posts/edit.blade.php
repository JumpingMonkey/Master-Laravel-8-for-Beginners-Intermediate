@extends('layouts.app')

@section('title', 'Edit the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('posts.partials._form')
        <div class="d-grid gap-2"><input class="btn btn-primary mb-3" type="submit" value="Update"></div>
    </form>
@endsection
