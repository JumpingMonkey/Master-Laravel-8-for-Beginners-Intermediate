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
        <div class="container">
            <div class="row">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most commented</h5>
                        <h6 class="card-subtitle m-2 text-muted">What people currently talking about.</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($mostCommented as $key => $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id])}}">
                                {{ $post->title }}
                            </a>
                        </li>
                        @empty
                            <div>No comments yet!</div>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most active users</h5>
                        <h6 class="card-subtitle m-2 text-muted">Users with most posts written</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($mostActive as $key => $user)
                            <li class="list-group-item">
                                {{ $user->name }}
                            </li>
                        @empty
                            <div>No comments yet!</div>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Most active users last month</h5>
                        <h6 class="card-subtitle m-2 text-muted">Users with most posts written last month</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($mostActiveLastMonth as $key => $user)
                            <li class="list-group-item">
                                {{ $user->name }}
                            </li>
                        @empty
                            <div>No comments yet!</div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
