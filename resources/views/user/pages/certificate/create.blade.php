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
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const selectAllLink = document.getElementById('selectAllLink');
            const deselectAllLink = document.getElementById('deselectAllLink');
            const selectedCount = document.getElementById('selectedCount');
            const bulkAction = document.getElementById('bulkAction');
            const certificationForm = document.getElementById('certificationForm');

            let table = $('#table2').DataTable(); // Inisialisasi DataTable
            let allSelected = false;

            function updateSelectedCount() {
                const selectedItems = table.$('.checkItem:checked').length;
                selectedCount.textContent = selectedItems;
                bulkAction.disabled = selectedItems === 0;
            }

            // Pilih semua checkbox di halaman saat ini
            checkAll.addEventListener('change', function() {
                let rows = table.rows({
                    'page': 'current'
                }).nodes();
                $('input[type="checkbox"].checkItem', rows).prop('checked', checkAll.checked);
                updateSelectedCount();
                toggleSelectLinks();
            });

            // Pilih semua data dalam tabel, termasuk yang tidak terlihat
            selectAllLink.addEventListener('click', function(e) {
                e.preventDefault();
                allSelected = true;
                let rows = table.rows().nodes();
                $('input[type="checkbox"].checkItem', rows).prop('checked', true);
                checkAll.checked = true;
                updateSelectedCount();
                toggleSelectLinks();
            });

            // Batalkan semua pilihan
            deselectAllLink.addEventListener('click', function(e) {
                e.preventDefault();
                allSelected = false;
                let rows = table.rows().nodes();
                $('input[type="checkbox"].checkItem', rows).prop('checked', false);
                checkAll.checked = false;
                updateSelectedCount();
                toggleSelectLinks();
            });

            // Update tampilan tombol Pilih Semua / Batalkan Pilihan
            function toggleSelectLinks() {
                const selectedItems = table.$('.checkItem:checked').length;
                const totalItems = table.$('.checkItem').length;

                if (selectedItems === totalItems && totalItems > 0) {
                    selectAllLink.classList.add('d-none');
                    deselectAllLink.classList.remove('d-none');
                } else {
                    selectAllLink.classList.remove('d-none');
                    deselectAllLink.classList.add('d-none');
                }
            }

            // Tambahkan event listener pada setiap checkbox individual
            table.on('change', '.checkItem', function() {
                updateSelectedCount();
                toggleSelectLinks();
            });

            // Tambahkan event listener pada pengiriman formulir untuk mengumpulkan semua checkbox yang dipilih
            certificationForm.addEventListener('submit', function(e) {
                let rows = table.rows().nodes();
                $('input[type="checkbox"].checkItem', rows).each(function() {
                    if (this.checked) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'member_id[]',
                            value: this.value
                        }).appendTo(certificationForm);
                    }
                });
            });

            updateSelectedCount();
            toggleSelectLinks();
        });
    </script>
@endpush
