@extends('layouts.app')

@section('title', 'Blog posts')

@section('content')
{{--    @if(count($posts))--}}
{{--        @foreach($posts as $key => $post)--}}
{{--            <div>{{ $key }}.{{$post['title']}}</div>--}}
{{--        @endforeach--}}
{{--    @else--}}
{{--        <div>No posts found!</div>--}}
{{--    @endif--}}
{{--alternative--}}

{{--@each('posts.partials.post', $posts, 'post')--}}
@forelse($posts as $key => $post)
    @include('posts.partials.post', [])
@empty
    <div>No posts found!</div>
@endforelse

@endsection
