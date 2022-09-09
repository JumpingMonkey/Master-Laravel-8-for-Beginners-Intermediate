@extends('layouts.app')
@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" value="{{ old('name') }}" required
               class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}">
        @if($errors->has('name'))
            <span class="invalid-feedback">
                {{ $errors->first('name') }}
            </span>
            @endif
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" value="{{ old('email') }}" required
               class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}">
        @if($errors->has('email'))
            <span class="invalid-feedback">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" required type="password"
               class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
        @if($errors->has('password'))
            <span class="invalid-feedback">
                {{ $errors->first('password') }}
            </span>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label">Retype password</label>
        <input name="password_confirmation" required type="password"
               class="form-control">
    </div>

    <div class="d-grid gap-2"><button type="submit" class="btn btn-primary">Register!</button></div>


</form>
@endsection
