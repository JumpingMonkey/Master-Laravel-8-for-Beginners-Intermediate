@extends('layouts.app')
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf

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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
        </div>

        <div class="d-grid gap-2"><button type="submit" class="btn btn-primary">Login</button></div>


    </form>
@endsection

