@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            @if($post->image)
            <div class="" style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color:white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
            @else
                <h1>
            @endif
    {{$post->title}}
        @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) < 30])
            New!
        @endcomponent
            @if($post->image)
                </h1>
            </div>
            @else
                </h1>
            @endif
<p>{{$post->content}}</p>
{{--<p>Added {{ $post->created_at->diffForHumans() }}</p>--}}

{{--<img src="http://cource/storage/{{ $post->image->path }}"/>--}}
{{--<img src="{{ Storage::url($post->image->path) }}"/>--}}


    @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])

    @endcomponent

    @component('components.updated', ['date' => $post->updated_at])
    Updated
    @endcomponent

    <x-tags :tags="$post->tags"></x-tags>

{{--    <p>Currently read by {{ $counter }} people</p>--}}
    <p>{{ trans_choice('messages.people.reading', $counter) }}</p>

    <h4>Comments</h4>
{{--    <h4>{{ trans_choice('messages.comments', $post->comments_count) }}</h4>--}}

    @component('components.comment-form', ['route' => route('posts.comments.store', ['post' => $post->id])])
     @endcomponent

    @component('components.comment-list', ['comments' => $post->comments])
     @endcomponent
    </div>
    <div class="col-4">
        @include('posts.partials._activity')
    </div>
@endsection
