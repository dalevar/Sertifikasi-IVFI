@extends('layouts.user')

@section('breadcrumb')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('download-certificate.index') }}">Unduh Serifikat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sertifikat {{ $certification->title }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="divider divider-left-center">
                                <div class="divider-text h4">Daftar Anggota</div>
                            </div>
                            <h3>Sertifikat {{ $certification->title }}</h3>
                            <p class="font-bold">Total Anggota yang lulus kompetensi:
                                {{ $registered->count() }}</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-footer table-hover table-lg" id="table2">
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
                                        @forelse ($registered->unique('member_id') as $registration)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $registration->member->fullname }}</td>
                                                <td><span
                                                        class="badge {{ $registration->status == 'approved' ? 'text-bg-success' : ' text-bg-danger' }}">{{ $registration->status }}</span>
                                                </td>
                                                <td>{{ $registration->member->number_identity }}</td>
                                                <td>{{ $registration->registration_date->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('download-certificate.download', ['registrationId' => $registration->id, 'certificationId' => $certification->id]) }}"
                                                        class="btn btn-primary btn-sm" target="_blank">Download</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('download-certificate.index') }}"
                                class="mt-3 btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
