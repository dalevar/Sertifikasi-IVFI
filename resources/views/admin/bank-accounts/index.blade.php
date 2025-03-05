@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-md btn-primary">Tambah Data</a>
    @if (session()->has('success'))
      <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Bank</th>
            <th>No. Rekening</th>
            <th>Nama Pemilik Rekening</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($banks as $bank)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $bank->bank_name }}</td>
              <td>{{ $bank->account_number }}</td>
              <td>{{ $bank->account_holder }}</td>
              <td>
                <a href="{{ route('admin.bank-accounts.edit', $bank->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                <form action="{{ route('admin.bank-accounts.destroy', $bank->id) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event)">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <div class="text-warning">Tidak ada data</div>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection