@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('certifications.index') }}">Registrasi
                    Sertifikat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Anggota</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Daftar Anggota</h3>
            <p class="text-subtitle text-muted">
                Daftar anggota yang didaftarkan dalam sertifikasi.
            </p>
        </div>
    </div>
@endsection


@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <form id="certificationForm" action="{{ route('certifications.store', $certification) }}"
                        method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div class="form-group col-lg-8">
                                        <label for="certification_id">Jenis Sertifikasi</label>
                                        <select class="form-control" id="certification_id" name="certification_id" required>
                                            <option value="{{ $certification->id }}">{{ $certification->title }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="registration_date">Tanggal Registrasi</label>
                                        <input type="date" class="form-control" id="registration_date"
                                            name="registration_date" required
                                            value="{{ old('registration_date', date('Y-m-d')) }}">
                                    </div>
                                </div>

                                <div class="divider divider-left">
                                    <div class="divider-text h4">Daftar Anggota</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div>
                                        <span id="selectedCount">0</span> Anggota Dipilih |
                                        <a href="#" id="selectAllLink" class="text-primary me-2">Pilih Semua
                                            ({{ $total_members }})</a>
                                        <a href="#" id="deselectAllLink" class="nav-link text-danger d-none">Batalkan
                                            Pilihan
                                            Semua</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-1" id="bulkAction"
                                        disabled>Daftar</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="table2">
                                        <thead>
                                            <tr>
                                                <th class="col-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>No. Indentitas</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Instansi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($members as $member)
                                                <tr>
                                                    <td class="col-1">
                                                        <input type="checkbox" name="member_id[]"
                                                            value="{{ $member->id }}" class="form-check-input checkItem">
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $member->fullname }}</td>
                                                    <td>{{ $member->number_identity }}</td>
                                                    <td>{{ $member->birthplace }}</td>
                                                    <td>{{ $member->birthday->format('d F Y') }}</td>
                                                    <td>{{ $member->user->fullname }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = $("#table2").DataTable(); // Inisialisasi DataTables
            let selectedMembers = new Set(); // Menyimpan anggota yang dipilih
            let isAllSelected = false; // Status apakah semua data dipilih

            const checkAll = document.getElementById("checkAll");
            const selectedCount = document.getElementById("selectedCount");
            const bulkAction = document.getElementById("bulkAction");
            const selectAllLink = document.getElementById("selectAllLink");
            const deselectAllLink = document.getElementById("deselectAllLink");

            const totalMembers = table.rows().count(); // Total anggota dalam tabel

            function updateCount() {
                selectedCount.textContent = selectedMembers.size;
                bulkAction.disabled = selectedMembers.size === 0;

                if (selectedMembers.size === totalMembers) {
                    deselectAllLink.classList.remove("d-none");
                    selectAllLink.style.display = "none";
                } else {
                    deselectAllLink.classList.add("d-none");
                    selectAllLink.style.display = "inline";
                }

                // Periksa apakah semua checkbox di halaman ini sudah dipilih
                const visibleRows = table.rows({
                    search: "applied"
                }).nodes();
                const checkedRows = $(visibleRows).find(".checkItem:checked").length;
                checkAll.checked = checkedRows === visibleRows.length;
            }

            function syncCheckboxState() {
                const rows = table.rows({
                    search: "applied"
                }).nodes();
                $(rows).find(".checkItem").each(function() {
                    this.checked = selectedMembers.has(this.value);
                });

                const checkedRows = $(rows).find(".checkItem:checked").length;
                checkAll.checked = checkedRows === rows.length;
            }

            // Event untuk checkbox utama "Pilih Semua" di halaman saat ini
            checkAll.addEventListener("change", function() {
                const rows = table.rows({
                    search: "applied"
                }).nodes();
                $(rows).find(".checkItem").each(function() {
                    this.checked = checkAll.checked;
                    if (checkAll.checked) {
                        selectedMembers.add(this.value);
                    } else {
                        selectedMembers.delete(this.value);
                    }
                });
                updateCount();
            });

            // Event untuk setiap checkbox individu
            $("#table2 tbody").on("change", ".checkItem", function() {
                if (this.checked) {
                    selectedMembers.add(this.value);
                } else {
                    selectedMembers.delete(this.value);
                }
                updateCount();
            });

            // Event untuk "Pilih Semua (Total X)"
            selectAllLink.addEventListener("click", function(e) {
                e.preventDefault();
                if (!isAllSelected) {
                    // Pilih semua data dari database
                    selectedMembers.clear();
                    table.rows().data().each(function(row) {
                        selectedMembers.add(row[0]); // Asumsikan ID ada di kolom pertama
                    });

                    // Centang semua checkbox yang terlihat di halaman ini
                    table.rows().nodes().to$().find(".checkItem").prop("checked", true);
                    checkAll.checked = true;

                    selectAllLink.style.display = "none";
                    deselectAllLink.classList.remove("d-none");
                    isAllSelected = true;
                }
                updateCount();
            });

            // Event untuk "Batalkan Pilihan Semua"
            deselectAllLink.addEventListener("click", function(e) {
                e.preventDefault();
                selectedMembers.clear();
                isAllSelected = false;

                table.rows().nodes().to$().find(".checkItem").prop("checked", false);
                checkAll.checked = false;
                selectAllLink.style.display = "inline";
                deselectAllLink.classList.add("d-none");

                updateCount();
            });

            // Sinkronisasi saat halaman tabel berubah
            $('#table2').on('draw.dt', function() {
                syncCheckboxState();
            });

            // Saat form dikirim, tambahkan input hidden untuk menyimpan data yang dipilih
            document.getElementById("certificationForm").addEventListener("submit", function(e) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "selected_members";
                input.value = Array.from(selectedMembers).join(",");
                this.appendChild(input);
            });
        });
    </script>
@endpush
