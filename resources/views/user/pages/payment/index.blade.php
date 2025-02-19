@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Riwayat Pembayaran</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $fullname }}</td>
                        <td>{{ $payment->total_members }}</td>
                        <td>{{ $payment->total_amount }}</td>
                        <td
                            class="badge {{ $payment->status == 'paid' ? 'text-bg-success' : ($payment->status == 'pending' ? 'text-bg-secondary' : 'text-bg-danger') }} ">
                            {{ $payment->status }}
                        </td>
                        <td>{{ $payment->date }}</td>
                        <td>
                            <a href="{{ route('payment-histories.invoice', $payment->id) }}"
                                class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
