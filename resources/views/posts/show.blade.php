@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
<h1>
    {{$post->title}}
        @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) < 30])
            New!
        @endcomponent
</h1>
<p>{{$post->content}}</p>
{{--<p>Added {{ $post->created_at->diffForHumans() }}</p>--}}

@component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])

@endcomponent

@component('components.updated', ['date' => $post->updated_at])
Updated
@endcomponent

<x-tags :tags="$post->tags"></x-tags>

<p>Currently read by {{ $counter }} people</p>

    <h4>Comments</h4>

    @include('comments._form')

@forelse($post->comments as $comment)
    <p>
        {{ $comment->content }}
    </p>

    @component('components.updated', ['date' => $comment->created_at, 'name' => $comment->user->name])

    @endcomponent
@empty
    <a>No comments yes!</a>
@endforelse
    </div>
    <div class="col-4">
        @include('posts.partials._activity')
    </div>
@endsection
