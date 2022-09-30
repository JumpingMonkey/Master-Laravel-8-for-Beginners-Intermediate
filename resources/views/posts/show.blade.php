@extends('layouts.app')

@section('title', $post->title)

@section('content')
<h1>
    {{$post->title}}
        @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) < 30])
            New!
        @endcomponent
</h1>
<p>{{$post->content}}</p>
<p>Added {{ $post->created_at->diffForHumans() }}</p>



    <h4>Comments</h4>

@forelse($post->comments as $comment)

    <p>
        {{ $comment->content }}
    </p>
    <p class="text-muted">
        Added {{ $comment->created_at->diffForHumans() }}
    </p>

@empty
    <a>No comments yes!</a>
@endforelse

@endsection
