@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pendaftar</th>
                            <th>Jumlah yang didaftarkan</th>
                            <th>Total Bayar</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strtoupper($payment->user->fullname) }}</td>
                                <td>{{ $payment->total_members }}</td>
                                <td>Rp.{{ number_format($payment->total_amount, '0', ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    @if ($payment->status === 'pending')
                                        <span class="badge text-bg-secondary">{{ strtoupper($payment->status) }}</span>
                                    @elseif ($payment->status === 'pay')
                                        <span class="badge text-bg-warning">{{ strtoupper($payment->status) }}</span>
                                    @elseif ($payment->status === 'success')
                                        <span class="badge text-bg-success">{{ strtoupper($payment->status) }}</span>
                                    @else
                                        <span class="badge text-bg-danger">{{ strtoupper($payment->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-zoom-in"></i> Detail</a>
                                </td>
                            </tr>
                        @empty
                            <span class="text-warning">Tidak ada data pembayaran</span>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
