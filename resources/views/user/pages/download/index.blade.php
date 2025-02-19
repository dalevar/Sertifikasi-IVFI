@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Sertifikat</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sertifikasi</th>
                    <th scope="col">Jumlah Anggota</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $certificate)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $certificate->title }}</td>
                        <td class="col-2">
                            {{ $certificate->registrations()->where('status', 'registered')->count() }}</td>
                        <td class="">
                            <a href="{{ route('download-certificate.show', $certificate->id) }}"
                                class="btn btn-primary">Detail
                                Anggota</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="list-group">
            @foreach ($certificates as $certificate)
                <a href="{{ route('download-certificate.show', $certificate) }}"
                    class="list-group-item list-group-item-action">
                    {{ $certificate->title }}
                    <span class="font-weight-light">-
                        {{ $certificate->registrations()->where('status', 'registered')->count() }} Anggota</span>
                </a>
            @endforeach
        </div> --}}
    </div>
@endsection
