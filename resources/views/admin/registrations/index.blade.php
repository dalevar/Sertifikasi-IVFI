@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="col-5">
      <form action="{{ route('admin.registrations.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary ms-2">Cari</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Tanggal</th>
            <th>Jumlah Didaftarkan</th>
            <th>Status Pembayaran</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($payments as $payment)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ strtoupper($payment->user->fullname) }}</td>
              <td>{{ \Carbon\Carbon::parse($payment->date)->locale('id')->translatedFormat('d F Y') }}</td>
              <td>{{ $payment->total_members }}</td>
              <td>
                <span class="badge text-bg-success">{{ $payment->status }}</span>
              </td>
              <td>
                @if ($payment->status === "success")
                  <a href="{{ route('admin.registrations.show', ['user_id' => $payment->user_id]) }}" class="btn btn-sm btn-success"><i class="bi bi-zoom-in"></i> Detail</a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-warning">Tidak ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="mx-3">
      {{ $payments->links() }}
    </div>
  </div>
</div>
@endsection