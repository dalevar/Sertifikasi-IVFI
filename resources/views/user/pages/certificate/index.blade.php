@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Sertifikasi</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- <a href="{{ route('certifications.create') }}" class="btn btn-primary">Tambah Sertifikasi Anggota</a> --}}
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Masa Berlaku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certifications as $certification)
                    <tr>
                        <td>{{ $certification->id }}</td>
                        <td>{{ $certification->title }}</td>
                        <td>{{ $certification->description }}</td>
                        <td>{{ $certification->price }}</td>
                        <td>{{ $certification->valid_period }} Bulan</td>
                        <td>
                            <a href="{{ route('certifications.create', $certification) }}"
                                class="btn btn-primary btn-sm">Pilih
                                Sertifikat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
