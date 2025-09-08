@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pendaftaran Sertifikasi</h1>
        <p><strong>ID:</strong> {{ $registration->id }}</p>
        <p><strong>Anggota:</strong> {{ $registration->member->fullname }}</p>
        <p><strong>Jenis Sertifikasi:</strong> {{ $registration->certification->title }}</p>
        <p><strong>Total Pembayaran:</strong> {{ $registration->total_amount }}</p>
        <a href="{{ route('certifications.index') }}">Back to List</a>
    </div>
@endsection
