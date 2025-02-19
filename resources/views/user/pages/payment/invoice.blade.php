@extends('layouts.app')

@section('content')
    <div class="container">
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

        <form action="{{ route('payment.upload-proof', $paymentHistory->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="proof_of_payment">Upload Proof of Payment</label>
                <input type="file" class="form-control" id="proof_of_payment" name="proof_of_payment">
            </div>
            <button type="submit" class="mt-2 btn btn-primary">Upload</button>
        </form>
        @if ($paymentHistory->proof)
            <div class="mt-4">
                <h3>Proof of Payment</h3>
                <img src="{{ asset('storage/' . $paymentHistory->proof) }}" alt="Proof of Payment" class="img-fluid">
            </div>
        @endif

        <a href="{{ route('payment-histories.index') }}" class="mt-2 btn btn-secondary">Back to Payment History</a>
    </div>

    <script>
        document.getElementById('proof_of_payment').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('proof_of_payment', file);

            fetch('{{ route('payment.upload-proof', $paymentHistory->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Payment proof uploaded successfully');
                        window.location.href = '{{ route('payment-histories.index') }}';
                    } else {
                        alert('Error uploading payment proof');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading payment proof');
                });
        });
    </script>

    <script>
        document.getElementById('proof_of_payment').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('proof_of_payment', file);

            fetch('{{ route('payment.upload-proof', $paymentHistory->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Payment proof uploaded successfully');
                        window.location.href = '{{ route('payment-histories.index') }}';
                    } else {
                        alert('Error uploading payment proof');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error uploading payment proof');
                });
        });
    </script>
@endsection
