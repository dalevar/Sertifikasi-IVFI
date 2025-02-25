@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-5">
        @if ($payment->proof === "")
          <img src="{{ asset('/img/folded.png') }}" alt="" class="img-thumbnail" />
        @else
          <img src="{{ Storage::url("$payment->proof") }}" alt="{{ $payment->proof  }}" class="img-thumbnail" />
        @endif
      </div>
      <div class="col-md-7">
        <table class="mb-5">
          <tr>
            <td>Nama Pendaftar</td>
            <td>: {{ strtoupper($payment->user->fullname) }}</td>
          </tr>
          <tr>
            <td>Jumlah Member yang didaftarkan</td>
            <td>: {{ $payment->total_members }}</td>
          </tr>
          <tr>
            <td>Total Pembayaran</td>
            <td>: Rp. {{ number_format($payment->total_amount, '0', ',', '.') }}</td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($payment->date)->locale('id')->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>: 
              @if ($payment->status === "pending")
                <span class="badge text-bg-secondary">{{ $payment->status }}</span>
              @elseif ($payment->status === "pay")
                <span class="badge text-bg-warning">{{ $payment->status }}</span>
              @elseif ($payment->status === "success")
                <span class="badge text-bg-success">{{ $payment->status }}</span>
              @else
                <span class="badge text-bg-danger">{{ $payment->status }}</span>
              @endif
            </td>
          </tr>
        </table>

        @if ($payment->status === "paid")
          <form action="{{ route('admin.payments.validation', $payment->id) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="validation" class="form-label">Verifikasi Pembayaran</label>
              <select name="validation" id="validation" class="form-select">
                <option value="">Pilih</option>
                <option value="validated">Terima</option>
                <option value="rejected">Tolak</option>
              </select>
              @error('validation')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-success">Kirim</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection