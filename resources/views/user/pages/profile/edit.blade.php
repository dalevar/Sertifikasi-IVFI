@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="photo">Foto Diri</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="fullname"
                    value="{{ old('fullname', $user->fullname) }}" required placeholder="{{ $user->fullname }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $user->location) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
