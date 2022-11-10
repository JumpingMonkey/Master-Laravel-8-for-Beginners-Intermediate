@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
    @include('posts.partials._form')
        <div class="d-grid gap-2">
            <input class="btn btn-primary mb-3" type="submit" value="Create">
        </div>
</form>
@endsection

