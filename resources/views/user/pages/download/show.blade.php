@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Anggota untuk {{ $certification->title }}</h1>
        <p><strong>Total Anggota dengan status registered:</strong>
            {{ $certification->registrations()->where('status', 'registered')->count() }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Status</th>
                    <th scope="col">Nomor Identitas</th>
                    <th scope="col">Tanggal Registrasi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registered as $registration)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $registration->member->fullname }}</td>
                        <td><span
                                class="badge {{ $registration->status == 'registered' ? 'text-bg-success' : ' text-bg-danger' }}">{{ $registration->status }}</span>
                        </td>
                        <td>{{ $registration->member->number_identity }}</td>
                        <td>{{ $registration->registration_date->format('d-m-Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="6">
                    <a href="#" class="btn btn-success">Download Semua Sertifikat Anggota</a>
                </td>
            </tfoot>
        </table>
        {{-- <a href="{{ route('download-certificate.download', ['certification' => $certification, 'download' => 'true']) }}"
            class="btn btn-primary">Unduh Daftar Anggota</a> --}}
    </div>
@endsection
