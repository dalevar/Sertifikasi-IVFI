@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Anggota</li>
            </ol>
        </nav>
        <h1>Edit Anggota</h1>
        <form action="{{ route('members.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">User</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $member->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="{{ old('fullname', $member->fullname) }}" required>
            </div>

            <div class="form-group">
                <label for="number_identity">Number Identity</label>
                <input type="text" class="form-control" id="number_identity" name="number_identity"
                    value="{{ old('number_identity', $member->number_identity) }}" required>
            </div>

            <div class="form-group">
                <label for="birthplace">Birthplace</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace"
                    value="{{ old('birthplace', $member->birthplace) }}">
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday"
                    value="{{ old('birthday', $member->birthday->format('Y-m-d')) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
