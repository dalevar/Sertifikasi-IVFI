@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.certificates.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Judul Jenis Setifikasi</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" />
        @error('title')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ old('description') }}</textarea>
        @error('description')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Harga Setifikasi</label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" />
        @error('price')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-md btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection