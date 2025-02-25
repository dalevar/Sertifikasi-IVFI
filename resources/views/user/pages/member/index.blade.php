@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../dashboard-user.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelola Anggota</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Kelola Anggota</h3>
            <p class="text-subtitle text-muted">
                Kelola <b>112</b> anggota Anda dengan mudah. Tambahkan, Edit, dan Hapus.
            </p>
        </div>
        <div class="order-first col-12 col-md-6 order-md-2">
            <a href="create.html" class="btn btn-primary float-end"><i class="bi bi-person-fill-add"></i> Tambah
                Anggota</a>
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
                                <div class="divider-text h4">Daftar Anggota</div>
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
                                            <th>Nama Lengkap</th>
                                            <th>No. Identitas</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>1234567890</td>
                                            <td>Bandung</td>
                                            <td>01-01-1990</td>
                                            <td class="col-2">
                                                <a href="show.html" class="my-1 btn btn-sm btn-primary">Lihat</a>
                                                <a href="edit.html" class="my-1 btn btn-sm btn-warning">Edit</a>
                                                <button type="button" class="my-1 btn btn-sm btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    Hapus
                                                </button>

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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="text-center modal-body">
                    <!-- Trash Icon -->
                    <div class="d-flex justify-content-center">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="mb-4 bi bi-trash3-fill text-danger fs-2 me-3"></i>
                        </div>
                    </div>

                    <!-- Modal Title & Message -->
                    <h5 class="mt-3 modal-title" id="deleteModalLabel">Hapus Anggota
                    </h5>
                    <p>
                        Anda yakin ingin menghapus <b>John Doe</b> sebagai anggota?
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection
