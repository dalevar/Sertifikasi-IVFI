@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Kelola
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
                            <form id="addForm" class="form" action="{{ route('members.store') }}" method="POST"
                                data-parsley-validate>
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
                                                name="number_identity" data-parsley-required="true" />
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
                                        <a href="{{ route('members.index') }}"
                                            class="mb-1 btn btn-outline-secondary me-1">Kembali</a>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#addForm").on("submit", function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: "Memproses...",
                            text: "Harap tunggu sebentar.",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil! Dapat Berhasil Ditambahkan",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                position: "top-end",
                                timerProgressBar: true
                            });

                            // Reload halaman setelah sukses
                            setTimeout(() => {
                                window.location.href = "{{ route('members.index') }}";
                            }, 3000);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal!",
                                text: response.message ||
                                    "Terjadi kesalahan yang tidak diketahui.",
                                confirmButtonText: "Tutup"
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = Object.values(errors).map(error => error.join(
                                ", ")).join("\n");

                            Swal.fire({
                                icon: "error",
                                title: "Tambah Anggota Gagal!",
                                text: errorMessage,
                                confirmButtonText: "Perbaiki"
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal!",
                                text: "Terjadi kesalahan saat menambahkan anggota.",
                                confirmButtonText: "Coba Lagi"
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
