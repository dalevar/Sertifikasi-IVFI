@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('admin.certificates.create') }}" class="btn btn-md btn-primary">Tambah Data</a>
    @if (session()->has('success'))
      <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div class="table-responsive mt-3">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Jenis Sertifikat</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($certications as $show)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $show->title }}</td>
              <td>{{ $show->description }}</td>
              <td>Rp. {{ number_format($show->price, 0) }}</td>
              <td>
                <a href="{{ route('admin.certificates.edit', $show->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                <form action="{{ route('admin.certificates.destroy', $show->id) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event)">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
          <div class="text-warning mt-3">Tidak ada data jenis sertifikat</div>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mx-3">
      {{ $certications->links() }}
    </div>
  </div>
</div>
@endsection