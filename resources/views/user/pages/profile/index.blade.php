@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        <p> Welcome, {{ $user->fullname }}</p>

                        <a href="{{ route('profile.show') }}">Pengaturan</a>

                        {{-- Tabs Navbar --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="kelola-anggota-tab" data-toggle="tab" href="#kelola-anggota"
                                    role="tab" aria-controls="kelola-anggota" aria-selected="true">Kelola Anggota</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sertifikasi-tab" data-toggle="tab"
                                    href="{{ route('certifications.index') }}" role="tab" aria-controls="sertifikasi"
                                    aria-selected="false">Pendaftaran
                                    Sertifikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="unduh-sertifikasi-tab" data-toggle="tab"
                                    href="{{ route('download-certificate.index') }}" role="tab"
                                    aria-controls="unduh-sertifikasi" aria-selected="false">Unduh
                                    Sertifikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="riwayat-pembayaran-tab" data-toggle="tab"
                                    href="{{ route('payment-histories.index') }}" role="tab"
                                    aria-controls="riwayat-pembayaran" aria-selected="false">Riwayat
                                    Pembayaran</a>
                            </li>
                        </ul>

                        {{-- Tabs Content --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kelola-anggota" role="tabpanel"
                                aria-labelledby="kelola-anggota-tab">
                                <h1>Kelola Anggota</h1>
                                <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Anggota</a>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fullname</th>
                                            <th>Number Identity</th>
                                            <th>Birthplace</th>
                                            <th>Birthday</th>
                                            <th>User</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $member->id }}</td>
                                                <td>{{ $member->fullname }}</td>
                                                <td>{{ $member->number_identity }}</td>
                                                <td>{{ $member->birthplace }}</td>
                                                <td>{{ $member->birthday->format('Y-m-d') }}</td>
                                                <td>{{ $member->user->fullname }}</td>
                                                <td>
                                                    <a href="{{ route('members.edit', $member) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('members.destroy', $member) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
