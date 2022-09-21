@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>Contact Page</h1>
    <p>Contact page content!</p>

    @can('home.secret')
        <a href="{{ route('secret') }}">Special secret link</a>
    @endcan

@endsection
