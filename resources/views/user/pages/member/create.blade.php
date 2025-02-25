@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Kelola
                    Anggota</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Tambah Anggota</h3>
            <p class="text-subtitle text-muted">
                Tambahkan anggota baru ke dalam sistem dengan mengisi form di bawah ini.
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
                                <div class="divider-text h4">Tambah Anggota</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ route('members.store') }}" method="POST" data-parsley-validate>
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="fullname" class="form-label">Nama
                                                Lengkap</label>
                                            <input type="text" id="fullname" class="form-control" name="fullname"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="number_identity" class="form-label">No.
                                                Indentitas</label>
                                            <input type="text" id="number_identity" class="form-control"
                                                name="lname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="birthplace" class="form-label">Tempat
                                                Lahir</label>
                                            <input type="text" id="birthplace" class="form-control" name="birthplace"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="birthday" class="form-label">Tanggal
                                                Lahir</label>
                                            <input type="date" id="birthday" class="form-control" name="birthday"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        <!-- Kembali -->
                                        <a href="#" class="mb-1 btn btn-outline-secondary me-1">Kembali</a>
                                        <button type="submit" class="mb-1 btn btn-primary me-1">
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
