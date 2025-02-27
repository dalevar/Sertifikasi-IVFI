@extends('layouts.user')
@section('page-heading')
    <h3>Selamat datang, {{ $user->fullname }}</h3>
    <p class="text-subtitle text-muted">
        Dashboard profil organisasi Anda. Kelola data anggota, sertifikasi, dan lainnya.
    </p>
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
                                        <h6 class="mb-0 font-extrabold">{{ $total_members }}</h6>
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
                                        <h6 class="font-semibold text-muted">Sertifikasi Anggota</h6>
                                        <h6 class="mb-0 font-extrabold">{{ $approved_registrations }}</h6>
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
                                        <h6 class="font-semibold text-muted">Sertifikat</h6>
                                        <h6 class="mb-0 font-extrabold">{{ $certificate }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="divider divider-left">
                                    <div class="divider-text h4">Sertifikat Terbaru</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table2">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Sertifikasi</th>
                                                <th>Nama Anggota</th>
                                                <th>No. Identitas</th>
                                                <th>Status</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($member_certificated as $certificated)
                                                <tr>
                                                    <td>{{ $certificated->registration_date->format('d/m/Y') }}</td>
                                                    <td>{{ $certificated->certification->title }}</td>
                                                    <td>{{ $certificated->member->fullname }}</td>
                                                    <td>{{ $certificated->member->number_identity }}</td>
                                                    <td>
                                                        <span
                                                            class="badge text-bg-success">{{ $certificated->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary btn-view"
                                                            data-id="{{ $certificated->id }}">Lihat</a>
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
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberModalLabel">Detail Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Tanggal</th>
                            <td id="date"></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td id="memberName"></td>
                        </tr>
                        <tr>
                            <th>No. Identitas</th>
                            <td id="memberIdentity"></td>
                        </tr>
                        <tr>
                            <th>Sertifikasi</th>
                            <td id="certification"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span id="status" class="badge text-bg-success"></span>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".btn-view", function(e) {
                e.preventDefault();
                var memberId = $(this).data("id");

                $.ajax({
                    url: "/dashboard/" + memberId,
                    type: "GET",
                    success: function(response) {
                        $("#date").text(response.registration_date);
                        $("#memberName").text(response.fullname);
                        $("#memberIdentity").text(response.identity_number);
                        $("#certification").text(response.title);
                        $("#status").text(response.status);


                        $("#memberModal").modal("show"); // Tampilkan modal
                    },
                    error: function() {
                        alert("Gagal mengambil data anggota!");
                    }
                });
            });
        });
    </script>
@endpush
