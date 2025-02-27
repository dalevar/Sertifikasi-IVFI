@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../dashboard-user.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Riwayat Pembayaran</h3>
            <p class="text-subtitle text-muted">
                Daftar pembayaran yang telah dilakukan oleh instansi.
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
                                <div class="divider-text h4">Daftar Pembayaran</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped no-footer table-lg" id="table2">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th>Nama Instansi</th>
                                            <th>Jenis Sertifikasi</th>
                                            <th>Total Anggota</th>
                                            <th>Total Harga</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Status Pembayaran</th>
                                            <th class="col-1">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->user->fullname }}</td>
                                                {{-- Ambil jenis sertifikasi pertama jika ada --}}
                                                <td>
                                                    @if ($payment->members->isNotEmpty())
                                                        {{ $payment->members->first()->registrations->first()->certification->title ?? 'Tidak Ada' }}
                                                    @else
                                                        Tidak Ada
                                                    @endif
                                                </td>

                                                <td>{{ $payment->total_members }}</td>
                                                <td>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</td>
                                                <td>{{ $payment->date->format('d-m-Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $payment->status == 'paid' || $payment->status == 'success' ? 'bg-light-success' : ($payment->status == 'pending' ? 'bg-light-warning' : 'bg-light-danger') }}">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($payment->status == 'pending')
                                                        <a href="{{ route('payment-histories.invoice', $payment->id) }}"
                                                            class="btn btn-warning btn-sm">Invoice</a>
                                                    @else
                                                        <button type="button"
                                                            class="block btn btn-outline-primary btn-sm btn-detail"
                                                            data-bs-toggle="modal" data-bs-target="#detail"
                                                            data-id="{{ $payment->id }}">
                                                            Detail
                                                        </button>
                                                    @endif
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


    <div class="text-left modal fade modal-borderless" id="detail" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Informasi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Nomor Invoice</th>
                                    <td id="invoice-number">-</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pelunasan</th>
                                    <td id="payment-date">-</td>
                                </tr>
                                <tr>
                                    <th>Jenis Sertifikat</th>
                                    <td id="certification-type">-</td>
                                </tr>
                                <tr>
                                    <th>Harga Sertifikasi</th>
                                    <td id="certification-price">-</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Anggota Terdaftar</th>
                                    <td id="total-members">-</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td id="total-price">-</td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td id="payment-status">-</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-detail').on('click', function() {
                var paymentId = $(this).data('id'); // Ambil ID pembayaran

                // Kosongkan data saat modal pertama kali dibuka
                $('#invoice-number').text('-');
                $('#payment-date').text('-');
                $('#certification-type').text('-');
                $('#certification-price').text('-');
                $('#total-members').text('-');
                $('#total-price').text('-');
                $('#payment-status').text('-');

                // AJAX untuk ambil data pembayaran
                $.ajax({
                    url: '/payment-histories/' + paymentId, // Endpoint API atau route Laravel
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#invoice-number').text(response.invoice_number || '-');
                        $('#payment-date').text(response.payment_date || '-');
                        $('#certification-type').text(response.certification_type || '-');
                        $('#certification-price').text('Rp. ' + new Intl.NumberFormat().format(
                            response.certification_price));
                        $('#total-members').text(response.total_members);
                        $('#total-price').text('Rp. ' + new Intl.NumberFormat().format(response
                            .total_price));

                        // Status pembayaran dengan warna
                        let statusClass = 'bg-light-secondary';
                        if (response.payment_status == 'paid') statusClass = 'bg-light-success';
                        if (response.payment_status == 'pending') statusClass =
                            'bg-light-warning';
                        if (response.payment_status == 'failed') statusClass =
                            'bg-light-danger';

                        $('#payment-status').html('<span class="badge ' + statusClass + '">' +
                            response.payment_status + '</span>');
                    },
                    error: function() {
                        alert('Gagal mengambil data, silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endpush
