@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Kelola
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
                Informasi detail anggota Anda.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Detail Anggota</h3>
            <p class="text-subtitle text-muted">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam, nemo.
            </p>
        </div>
    </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-start flex-column">
                            <h5 class="mt-2">Terhubung Dengan Instansi :</h5>
                            <p class="text-small">Ikatan Vokasi Farmasi Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Nama:</h6>
                                <p>John Doe</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Email:</h6>
                                <p>johndoe@example.com</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Nomor Telepon:</h6>
                                <p>+62 812 3456 7890</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Alamat:</h6>
                                <p>Jl. Example No. 123, Jakarta, Indonesia</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Tanggal Bergabung:</h6>
                                <p>1 Januari 2023</p>
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
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jenis Sertifikasi</th>
                                        <th scope="col">Tanggal Terbit</th>
                                        <th scope="col">Tanggal Berakhir</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Sertifikasi Farmasi</td>
                                        <td>1 Januari 2023</td>
                                        <td>1 Januari 2025</td>
                                        <td><span class="badge text-bg-success">Aktif</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="../anggota/index.html" class="btn btn-outline-primary">Kembali</a>
                        <a href="edit.html" class="btn btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
