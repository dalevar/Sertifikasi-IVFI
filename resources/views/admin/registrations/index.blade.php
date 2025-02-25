@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
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
            <span class="text-warnin">Tidak ada data</span>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection