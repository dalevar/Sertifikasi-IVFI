@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>{{ $registration->member->fullname }}</h3>
    <div>
      <h6>Asal Instansi</h6>
      <p>{{ $user->fullname }}</p>
    </div>
    <div>
      <h6>Tanggal Pendaftaran</h6>
      <p>{{ Carbon\Carbon::parse($registration->registration_date)->locale('id')->translatedFormat('d F Y') }}</p>
    </div>
    <div>
      <h6>Pilih Sertifikasi</h6>
      <p>{{ $registration->certification->title }}</p>
    </div>
    <div>
      @if ($registration->status == 'approved')
        <h6>Status</h6>
        <p>Nomor Sertifikat: {{ $registration->certification_number }}</p>
        <p><strong class="text-success">Sertifikat Telah Diterbitkan</strong></p>
        <form action="{{ route('admin.registrations.reset-certification') }}" method="POST">
          @csrf
          <input type="hidden" name="registration_id" value="{{ $registration->id }}">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-warning">Reset</button>
        </form>
      @else
      <form action="{{ route('admin.registrations.approved-certification') }}" method="POST">
        @csrf
        <input type="hidden" name="registration_id" value="{{ $registration->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="mb-3 col-6">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select">
            <option value="">Pilih</option>
            <option value="approved">Kompeten</option>
            <option value="rejected">Tidak Kompten</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Approve</button>
      @endif
    </div>
    </form>

    <div class="mt-3">
      <a href="{{ route('admin.registrations.show', ['user_id' => $user->id]) }}" class="btn btn-danger">Kembali</a>
    </div>
  </div>
</div>
@endsection