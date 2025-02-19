@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payment-histories.index') }}">Riwayat Pembayaran</a></li>
                <li class="breadcrumb-item" aria-current="page">Invoice Detail</li>
            </ol>
        </nav>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Invoice</h1>

        <p><strong>Invoice ID:</strong> {{ $paymentHistory->id }}</p>
        <p><strong>Fullname:</strong> {{ $fullname }}</p>
        <p><strong>Amount:</strong> {{ $paymentHistory->total_amount }}</p>
        <p><strong>Payment Date:</strong> {{ $paymentHistory->date }}</p>
        <p><strong>Status:</strong> {{ $paymentHistory->status }}</p>
        @if ($paymentHistory->proof == null)
            <p><strong>Proof of Payment:</strong> Not Uploaded</p>
            <form action="{{ route('payment.upload-proof', $paymentHistory->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="proof_of_payment">Upload Proof of Payment</label>
                    <input type="file" class="form-control" id="proof_of_payment" name="proof_of_payment">
                </div>
                <button type="submit" class="mt-2 btn btn-primary">Upload</button>
            </form>
        @endif


        <a href="{{ route('payment-histories.index') }}" class="mt-2 btn btn-secondary">Back to Payment History</a>
    </div>
@endsection
