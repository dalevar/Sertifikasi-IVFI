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
        <form action="{{ route('admin.registrations.reset-certification') }}" method="POST" class="d-inline">
          @csrf
          <input type="hidden" name="registration_id" value="{{ $registration->id }}">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-warning">Reset</button>
          <!-- Button trigger modal -->
        </form>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Ganti No Sertifikat
        </button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.registrations.update-certification-number', ) }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="registration_id" value="{{ $registration->id }}">
          <input type="text" class="form-control" name="certification_number" id="certification_number" value="{{ $registration->certification_number }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection