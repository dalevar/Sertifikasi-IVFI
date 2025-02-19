@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Pendaftaran Sertifikasi</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('certifications.store', $certification) }}" method="POST">
            @csrf

            <div class="my-4 form-group">
                <label for="certification_id">Jenis Sertifikasi</label>
                <select class="form-control" id="certification_id" name="certification_id" required>
                    <option value="{{ $certification->id }}">{{ $certification->title }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="registration_date">Tanggal Registrasi</label>
                <input type="date" class="form-control" id="registration_date" name="registration_date" required
                    value="{{ old('registration_date', date('Y-m-d')) }}">
            </div>

            <div class="my-4 form-group">
                <div class="card">
                    <div class="card-header">{{ __('Anggota') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" name="select-all" id="select-all">
                                        <label for="select-all"> Pilih Semua</label>
                                    </th>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nomor Identitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $member)
                                    <tr>
                                        <td class="col-1">
                                            <input type="checkbox" name="member_id[]" value="{{ $member->id }}"
                                                class="member-checkbox">
                                        </td>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $member->fullname }}</td>
                                        <td>{{ $member->number_identity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data anggota.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="col-3">Total Anggota Dipilih : <span id="total-anggota">0</span></th>
                                </tr>
                            </tfoot>
                        </table>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const selectAllCheckbox = document.getElementById('select-all');
                                const memberCheckboxes = document.querySelectorAll('.member-checkbox');
                                const totalAnggotaSpan = document.getElementById('total-anggota');

                                function updateTotalSelected() {
                                    const totalSelected = document.querySelectorAll('.member-checkbox:checked').length;
                                    totalAnggotaSpan.textContent = totalSelected;
                                }

                                selectAllCheckbox.addEventListener('change', function() {
                                    memberCheckboxes.forEach(checkbox => {
                                        checkbox.checked = selectAllCheckbox.checked;
                                    });
                                    updateTotalSelected();
                                });

                                memberCheckboxes.forEach(checkbox => {
                                    checkbox.addEventListener('change', updateTotalSelected);
                                });

                                updateTotalSelected();
                            });
                        </script>
                    </div>
                </div>
            </div>
            <button type="submit" class="my-3 btn btn-primary">Daftar</button>
        </form>
    </div>
@endsection
