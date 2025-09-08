@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="col-5">
      <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary ms-2">Cari</button>
      </form>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jumlah Anggota</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->fullname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->members_count }}</td>
              <td>
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin reset password user ini ke 12345678?')">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-warning">Reset Password</button>
                </form>
              </td>
            </tr>
          @empty
            <div class="text-danger">Tidak Ada User Terdaftar</div>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mx-3">
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection