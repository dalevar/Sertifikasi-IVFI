@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Riwayat Pembayaran</li>

            </ol>
        </nav>
        <h1>Riwayat Pembayaran</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Instansi</th>
                    <th>Jumlah Anggota</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>RWYPB{{ $payment->id }}</td>
                        <td>{{ $fullname }}</td>
                        <td>{{ $payment->total_members }}</td>
                        <td>{{ $payment->total_amount }}</td>
                        <td
                            class="badge {{ $payment->status == 'paid' ? 'text-bg-success' : ($payment->status == 'pending' ? 'text-bg-secondary' : 'text-bg-danger') }} ">
                            {{ $payment->status }}
                        </td>
                        <td>{{ $payment->date }}</td>
                        <td>
                            @if ($payment->status == 'pending')
                                <a href="{{ route('payment-histories.invoice', $payment->id) }}"
                                    class="btn btn-warning">Invoice</a>
                            @else
                                <a href="{{ route('payment-histories.show', $payment->id) }}"
                                    class="btn btn-primary">Detail</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
