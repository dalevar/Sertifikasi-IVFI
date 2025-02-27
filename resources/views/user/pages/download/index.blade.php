@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Unduh Sertifikat</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Unduh Sertifikat</h3>
            <p class="text-subtitle text-muted">
                Unduh sertifikat anggota yang telah tersertifikasi.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="divider divider-left">
                                <div class="divider-text h4">Daftar Anggota Tersertifikasi</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-footer table-hover table-lg" id="table2">
                                    <thead>
                                        <tr>
                                            <th class="col-1">No</th>
                                            <th scope="col">Sertifikasi</th>
                                            <th class="col-1">Jumlah Anggota</th>
                                            <th class="col-1">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($certificates as $certificate)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $certificate->title }}</td>
                                                <td class="col-2">
                                                    {{ $certificate->registrations()->where('status', 'approved')->count() }}
                                                </td>
                                                <td class="">
                                                    <a href="{{ route('download-certificate.show', $certificate->id) }}"
                                                        class="btn btn-primary">Lihat
                                                        Anggota</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="container">


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
                            {{ $certificate->registrations()->where('status', 'approved')->count() }}</td>
                        <td class="">
                            <a href="{{ route('download-certificate.show', $certificate->id) }}"
                                class="btn btn-primary">Detail
                                Anggota</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="list-group">
            @foreach ($certificates as $certificate)
                <a href="{{ route('download-certificate.show', $certificate) }}"
                    class="list-group-item list-group-item-action">
                    {{ $certificate->title }}
                    <span class="font-weight-light">-
                        {{ $certificate->registrations()->where('status', 'registered')->count() }} Anggota</span>
                </a>
            @endforeach
        </div>
    </div> --}}
@endsection
