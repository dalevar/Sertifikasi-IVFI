@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.bank-accounts.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="bank_name" class="form-label">Nama Bank</label>
        <input type="text" name="bank_name" id="bank_name" class="form-control" required>
        @error('bank_name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="account_number" class="form-label">Nomor Rekening</label>
        <input type="text" name="account_number" id="account_number" class="form-control" required>
        @error('account_number')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="account_holder" class="form-label">Nama Pemilik Rekening</label>
        <input type="text" name="account_holder" id="account_holder" class="form-control" required>
        @error('account_holder')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-md btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection