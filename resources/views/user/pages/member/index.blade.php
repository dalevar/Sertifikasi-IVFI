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
                Kelola <span class="font-bold">{{ $total_members }}</span> anggota Anda dengan mudah. Tambahkan, Edit, dan
                Hapus.
            </p>
        </div>
        <div class="order-first col-12 col-md-6 order-md-2">
            <a href="{{ route('members.create') }}" class="btn btn-primary float-end"><i class="bi bi-person-fill-add"></i>
                Tambah
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
                            <div class="table-responsive">
                                <table class="table table-striped no-footer table-hover table-lg" id="table2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>No. Identitas</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($members as $member)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $member->fullname }}</td>
                                                <td>{{ $member->number_identity }}</td>
                                                <td>{{ $member->birthplace }}</td>
                                                <td>{{ $member->birthday->format('d F Y') }}</td>
                                                <td class="col-2">
                                                    <a href="{{ route('members.show', $member->id) }}"
                                                        class="my-1 btn btn-sm btn-primary">Lihat</a>
                                                    <a href="{{ route('members.edit', $member->id) }}"
                                                        class="my-1 btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $member->id }}" data-name="{{ $member->fullname }}">
                                                        Hapus
                                                    </a>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
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
                        Anda yakin ingin menghapus <span id="memberName" class="font-bold"></span> sebagai anggota?
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="toast-success">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Cek jika ada status sukses di localStorage
            if (localStorage.getItem("deleteSuccess")) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: localStorage.getItem("deleteSuccess"),
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                // Hapus status setelah alert ditampilkan
                localStorage.removeItem("deleteSuccess");
            }

            // Event klik tombol "Hapus"
            $(document).on("click", ".btn-delete", function(e) {
                e.preventDefault();
                var memberId = $(this).data("id");
                var memberName = $(this).data("name");

                // Masukkan nama anggota ke dalam modal
                $("#deleteModal #memberName").text(memberName);

                // Set action untuk tombol hapus
                $("#deleteModal .btn-danger").attr("data-id", memberId);

                // Tampilkan modal
                $("#deleteModal").modal("show");
            });

            // Event klik tombol konfirmasi hapus
            $(document).on("click", "#deleteModal .btn-danger", function() {
                var memberId = $(this).attr("data-id");

                $.ajax({
                    url: "/members/" + memberId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Simpan pesan sukses ke localStorage
                        localStorage.setItem("deleteSuccess", response.message);

                        // Reload halaman
                        location.reload();
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat menghapus anggota.",
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
