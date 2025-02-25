@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-md-2">
        @if ($user->details->photo === "")
          <img src="{{ asset('/img/profile-user.png') }}" class="img-thumbnail" width="150" alt="user">
        @else
          
        @endif
      </div>
      <div class="col-md-7">
        <h3>{{ strtoupper($user->fullname) }}</h3>
        <p><span class="fw-bold">Email</span>: {{ $user->email }}</p>
        <p><span class="fw-bold">Alamat</span>: {{ $user->details->address }}</p>
        <p><span class="fw-bold">Telepon/HP</span>: {{ $user->details->phone }}</p>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nomor Identitas</th>
            <th>Tempat dan Tanggal Lahir</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($members as $member)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $member->fullname }}</td>
              <td>{{ $member->number_identity }}</td>
              <td>{{ $member->birthplace }}, {{ \Carbon\Carbon::parse($member->birthday)->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
          @empty
            <span class="text-warning">Tidak ada data anggota</span>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="mx-3">
      {{ $members->links() }}
    </div>
  </div>
</div>
@endsection