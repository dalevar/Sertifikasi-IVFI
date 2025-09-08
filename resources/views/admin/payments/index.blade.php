@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col-5">
                <form action="{{ route('admin.payments.index') }}" method="GET" class="mb-3 d-flex">
                    <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary ms-2">Cari</button>
                </form>
            </div>
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
                                    @if ($payment->status === 'pending')
                                        
                                    @else
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-zoom-in"></i> Detail</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning">Tidak ada data pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mx-3">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
@endsection
