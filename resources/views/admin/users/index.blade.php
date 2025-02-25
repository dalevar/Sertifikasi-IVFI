@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
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