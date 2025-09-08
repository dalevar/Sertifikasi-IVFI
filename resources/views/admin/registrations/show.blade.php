@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Lengkap</th>
            <th>Tanggal Registrasi</th>
            <th>Sertifikasi</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($registrations as $register)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $register->member->fullname }}</td>
              <td>{{ Carbon\Carbon::parse($register->created_at)->locale('id')->translatedFormat('d F Y') }}</td>
              <td>{{ $register->certification->title }}</td>
              <td>
                @if ($register->status === "pending")
                  <a href="{{ route('admin.registrations.approved', ['user_id' => $user_id, 'id' => $register->id]) }}" class="btn btn-sm btn-primary">Terbitkan Sertifikat</a>
                @else
                  <span class="badge {{ $register->status === "approved" ? 'text-bg-success' : 'text-bg-danger' }} ">{{ $register->status }}</span> &nbsp;
                  <a href="{{ route('admin.registrations.approved', ['user_id' => $user_id, 'id' => $register->id]) }}" class="btn btn-sm btn-primary">Detail</a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection