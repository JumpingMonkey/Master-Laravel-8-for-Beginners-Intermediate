@extends('layouts.app')

@section('title', 'Blog posts')

@section('content')
<div class="row">
    <div class="col-8">
@forelse($posts as $key => $post)
    @include('posts.partials.post', [])
@empty
    <div>No posts found!</div>
@endforelse
    </div>
    <div class="col-4">
        @include('posts.partials._activity')
    </div>
</div>
@endsection
