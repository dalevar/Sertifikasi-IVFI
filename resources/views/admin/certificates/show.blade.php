@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 col-12">
        <h6>Nama Sertifikasi:</h6>
        <p>{{ $certification->title }}</p>
      </div>
      <div class="col-md-12 col-12">
        <h6>Nama Sertifikasi dalam inggris:</h6>
        <p class="fst-italic">{{ $certification->title_en }}</p>
      </div>
      <div class="col-md-12 col-12">
        <h6>Deskripsi:</h6>
        <p>{{ $certification->description }}</p>
      </div>
      <div class="col-md-12 col-12">
        <h6>Harga:</h6>
        <p>Rp. {{ number_format($certification->price, '0', ',', '.') }}</p>
      </div>
    </div>
    <hr>
    <div class="table-responsive">
      <h4>Unit Kompetensi</h4>
      <a href="{{ route('admin.certifications.create-units', $certification->id) }}" class="btn btn-sm btn-primary mb-3">Tambah Unit Kompetensi</a>
      <table class="table striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Unit</th>
            <th>Unit Kompetensi</th>
            <th>Unit Kompetensi Inggris</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($units as $show)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $show->unit_code }}</td>
              <td>{{ $show->unit_name }}</td>
              <td>{{ $show->unit_name_en }}</td>
              <td>
                <form action="{{ route('admin.certifications.delete_units', ['id' => $certification->id, 'unit_id' => $show->id]) }}" method="POST" class="d-inline">
                  @csrf
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection