@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}">
@endpush
@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Pengaturan Profil</h3>
            <p class="text-subtitle text-muted">
                Kelola informasi akun Anda di sini.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <!-- Sidebar Navigasi -->
            <div class="col-12 col-md-3">
                <h4 class="card-title">Pengaturan</h4>
                <div class="nav flex-column nav-pills settings-nav" id="settings-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active" id="profile-tab" data-bs-toggle="pill" href="#profile-content" role="tab"
                        aria-controls="profile-content" aria-selected="true">
                        Profil
                    </a>
                    <a class="nav-link" id="account-tab" data-bs-toggle="pill" href="#account-content" role="tab"
                        aria-controls="account-content" aria-selected="false">
                        Akun
                    </a>
                </div>
            </div>

            <!-- Content Profil dan Akun -->
            <div class="col-12 col-lg-9">
                <div class="tab-content" id="settings-content">
                    <!-- Tab Profil -->
                    <div class="tab-pane fade show active" id="profile-content" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profil</h4>
                                <form id="updateAccountForm" action="{{ route('profile.update.profil') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' . $user->details->photo) }}" alt="Foto Profil"
                                            class="img-thumbnail w-25">
                                        <div class="w-full col-6 ms-3">
                                            <div class="filepond--root image-preview-filepond filepond--hopper"
                                                data-style-button-remove-item-position="left"
                                                data-style-button-process-item-position="right"
                                                data-style-load-indicator-position="right"
                                                data-style-progress-indicator-position="right"
                                                data-style-button-remove-item-align="false" style="height: 76px;"><input
                                                    class="filepond--browser" type="file"
                                                    id="filepond--browser-956xbvmtz" name="photo"
                                                    aria-controls="filepond--assistant-956xbvmtz"
                                                    aria-labelledby="filepond--drop-label-956xbvmtz"
                                                    accept="image/png,image/jpg,image/jpeg">
                                                <div class="filepond--drop-label"
                                                    style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label
                                                        for="filepond--browser-956xbvmtz"
                                                        id="filepond--drop-label-956xbvmtz" aria-hidden="true">Seret &amp;
                                                        Lepaskan file Anda atau <span class="filepond--label-action"
                                                            tabindex="0">Pilih</span></label></div>
                                                <div class="filepond--list-scroller"
                                                    style="transform: translate3d(0px, 0px, 0px);">
                                                    <ul class="filepond--list" role="list"></ul>
                                                </div>
                                                <div class="filepond--panel filepond--panel-root" data-scalable="true">
                                                    <div class="filepond--panel-top filepond--panel-root"></div>
                                                    <div class="filepond--panel-center filepond--panel-root"
                                                        style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);">
                                                    </div>
                                                    <div class="filepond--panel-bottom filepond--panel-root"
                                                        style="transform: translate3d(0px, 68px, 0px);"></div>
                                                </div><span class="filepond--assistant" id="filepond--assistant-956xbvmtz"
                                                    role="status" aria-live="polite" aria-relevant="additions"></span>
                                                <fieldset class="filepond--data"></fieldset>
                                                <div class="filepond--drip"></div>
                                            </div>
                                            <small class="text-muted">Ukuran maksimal 2MB, rasio 1:1.</small>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label for="fullname">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            value="{{ $user->fullname }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat *</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $user->details->address }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon *</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $user->details->phone }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Akun -->
                    <div class="tab-pane fade" id="account-content" role="tabpanel" aria-labelledby="account-tab">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ubah Email</h4>
                                <form id="updatePasswordForm" action="{{ route('profile.update.akun') }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Email</button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-3 card">
                            <div class="card-body">
                                <h4 class="card-title">Ubah Password</h4>
                                <form action="{{ route('profile.update.akun') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="password">Password Baru *</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan password baru">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password *</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Konfirmasi password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                </form>
                            </div>
                        </div>
                    </div> <!-- End Tab Akun -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script
        src="{{ asset('assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script
        src="{{ asset('assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash) {
                let activeTab = document.querySelector(`.settings-nav .nav-link[href="${window.location.hash}"]`);
                if (activeTab) {
                    activeTab.click();
                }
            }
        });
    </script>

    <script>
        function handleFormSubmit(formId) {
            $(document).on("submit", formId, function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        Swal.fire({
                            title: "Memproses...",
                            text: "Harap tunggu sebentar.",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading(),
                        });
                    },
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            if (response.logout) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "Akun diperbarui. Anda akan keluar dalam 3 detik...",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    toast: true,
                                    position: "top-end",
                                    timerProgressBar: true
                                });

                                setTimeout(() => {
                                    window.location.href = "{{ route('logout') }}";
                                }, 3000);
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    toast: true,
                                    position: "top-end",
                                    timerProgressBar: true
                                });

                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            }
                        } else if (response.type === "warning") {
                            Swal.fire({
                                icon: "warning",
                                title: "Tidak Ada Perubahan!",
                                text: response.message,
                                confirmButtonText: "Tutup"
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = Object.values(errors)
                                .map(error => error.join(", "))
                                .join("\n");

                            Swal.fire({
                                icon: "error",
                                title: "Gagal!",
                                text: errorMessage,
                                confirmButtonText: "Perbaiki"
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal!",
                                text: "Terjadi kesalahan, coba lagi nanti.",
                                confirmButtonText: "Coba Lagi"
                            });
                        }
                    }
                });
            });
        }

        handleFormSubmit("#updateProfileForm");
        handleFormSubmit("#updateAccountForm");
        handleFormSubmit("#updatePasswordForm");
    </script>
@endpush
