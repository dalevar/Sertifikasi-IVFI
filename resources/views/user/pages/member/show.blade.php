@extends('layouts.user')

@section('breadcrumb')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Kelola
                    Anggota</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Anggota</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Detail Anggota</h3>
            <p class="text-subtitle text-muted">
                Informasi Detail Anggota {{ $member->fullname }} Anda.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        {{-- Tombol Kembali dan Edit --}}
                        <a href="{{ route('members.index') }}" class="mb-3 btn btn-outline-secondary btn-sm me-2">
                            Kembali
                        </a>

                        <a href="{{ route('members.edit', $member->id) }}" class="mb-3 btn btn-warning btn-sm">
                            Edit
                        </a>
                    </div>

                    <div class="d-flex justify-content-start align-items-start flex-column">
                        <h5 class="mt-2">Terhubung Dengan Instansi :</h5>
                        <p class="text-small">{{ $user->fullname }}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Nama Lengkap:</h6>
                            <p>{{ $member->fullname }}</p>
                        </div>

                        <div class="col-md-6">
                            <h6>No. Identitas:</h6>
                            <p>{{ $member->number_identity }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Tempat Lahir:</h6>
                            <p>{{ $member->birthplace }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Tanggal Lahir:</h6>
                            <p>{{ $member->birthday->format('d F Y') }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sertifikasi</h5>
                    <div class="table-responsive table-active table-borderless">
                        <table class="table table-hover table-borderless" id="table2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Sertifikasi</th>
                                    <th scope="col">Tanggal Terbit</th>
                                    <th scope="col">Masa Berlaku</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members_certificated as $member_certificated)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $member_certificated->certification->title }}</td>
                                        <td>{{ $member_certificated->registration_date->format('d F Y') }}</td>
                                        <td>{{ $member_certificated->certification->valid_period }} Tahun</td>
                                        <td><span class="badge text-bg-success">{{ $member_certificated->status }}</span>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
