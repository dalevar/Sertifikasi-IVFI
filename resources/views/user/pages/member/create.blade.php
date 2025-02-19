@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Anggota</li>
            </ol>
        </nav>

        <h1>Tambah Anggota</h1>
        <form action="{{ route('members.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">User</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="number_identity">Number Identity</label>
                <input type="text" class="form-control" id="number_identity" name="number_identity" required>
            </div>

            <div class="form-group">
                <label for="birthplace">Birthplace</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace">
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
