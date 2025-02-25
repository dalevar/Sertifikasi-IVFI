@extends('layouts.user')
@section('page-heading')
    <h3>Selamat datang, Ikatan Vokasi Farmasi Indonesia</h3>
@endsection
@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 card-body py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="mb-2 stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Total Anggota</h6>
                                        <h6 class="mb-0 font-extrabold">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 card-body py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="mb-2 stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Alumni</h6>
                                        <h6 class="mb-0 font-extrabold">183</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 card-body py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="mb-2 stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Sertifikasi</h6>
                                        <h6 class="mb-0 font-extrabold">6</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="px-4 card-body py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="mb-2 stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="font-semibold text-muted">Tersertifikasi</h6>
                                        <h6 class="mb-0 font-extrabold">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="divider divider-left">
                                    <div class="divider-text h4">Sertifikat Terbaru</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-end">
                                    <div class="search-container">
                                        <i class="bi bi-search search-icon"></i>
                                        <input type="text" class="form-control" placeholder="Cari">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Sertifikasi</th>
                                                <th>Nama Anggota</th>
                                                <th>No. Identitas</th>
                                                <th>Status</th>
                                                <th class="col-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12/12/2021</td>
                                                <td>Sertifikasi 1</td>
                                                <td>John Dale</td>
                                                <td>1234567890</td>
                                                <td><span class="badge text-bg-success">Tersertifikasi</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12/12/2021</td>
                                                <td>Sertifikasi 2</td>
                                                <td>Dale Gordon</td>
                                                <td>1234567890</td>
                                                <td><span class="badge text-bg-success">Tersertifikasi</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <label for="perPage" class="form-label">Per Page:</label>
                                            <select id="perPage" class="form-select"
                                                style="width: auto; display: inline-block;">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button class="btn btn-secondary disabled" id="prevPage">Previous</button>
                                            <button class="btn btn-secondary" id="nextPage">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
