@extends('layouts.app')

@section('title', 'User edit')

@section('content')
    <form method="POST" enctype="multipart/form-data"
    action="{{ route('users.update', ['user' => $user->id]) }}"
    class="m-3">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" class="img-thumbnail avatar">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload different photo</h6>
                        <input class="form-control" type="file" name="avatar" />
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="">
                    <label>{{__('Name:')}}</label>
                    <input class="form-control" value="" type="text" name="name" />
                </div>

                <div class="">
                    <label>{{__('Language:')}}</label>
                    <select class="form-select" name="locale">
                        @foreach(\App\Models\User::LOCALES as $locale => $label)
                            <option value="{{$locale}}" {{ $user->locale !== $locale ?: 'selected' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @component('components.errors')
                @endcomponent
                <div class="mt-3">
                    <input type="submit" class="btn btn-primary" value="Save changes">
                </div>
            </div>
        </div>

    </form>
@endsection
