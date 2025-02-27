@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registrasi Sertifikasi</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Registrasi Sertifikasi</h3>
            <p class="text-subtitle text-muted">
                Pilih sertifikasi yang akan diikuti oleh anggota.
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
                                <div class="divider-text h4">Daftar Sertifikat</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="table2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Masa Berlaku</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($certifications as $certification)
                                            <tr>
                                                <td>{{ $certification->id }}</td>
                                                <td>{{ $certification->title }}</td>
                                                <td>{{ $certification->description }}</td>
                                                <td>Rp.{{ $certification->price }}.000</td>
                                                <td>{{ $certification->valid_period }} Tahun</td>
                                                <td>
                                                    <a href="{{ route('certifications.create', $certification) }}"
                                                        class="btn btn-primary btn-sm">Pilih
                                                        Sertifikat</a>
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
@endsection
