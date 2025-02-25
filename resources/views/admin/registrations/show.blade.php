@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <form action="{{ route('admin.registrations.approved') }}" method="POST">
        @csrf
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Lengkap</th>
              <th>Tanggal Registrasi</th>
              <th>Sertifikasi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($registrations as $register)
              <tr>
                <td>
                  @if ($register->status === "pending")
                    <input type="checkbox" name="registers[{{ $register->id }}][id]" value="{{ $register->id }}">
                  @else
                    {{ $loop->iteration }}
                  @endif
                </td>
                <td>{{ $register->member->fullname }}</td>
                <td>{{ $register->registration_date }}</td>
                <td>{{ $register->certification->title }}</td>
                <td>
                  @if ($register->status === "pending")
                    <select name="registers[{{ $register->id }}][status]" id="registers[{{ $register->id }}][status]" class="form-select" disabled required>
                      <option value="">Pilih</option>
                      <option value="approved">Kompeten</option>
                      <option value="rejected">Tidak Kompten</option>
                    </select>
                  @else
                  <span class="badge {{ $register->status === "approved" ? 'text-bg-success' : 'text-bg-danger' }} ">{{ $register->status }}</span> 
                  @endif
                  
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @if ($countPending > 0)
          <button type="submit" class="btn btn-md btn-primary">Simpan</button>
        @endif
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type=checkbox]').forEach(checkbox => {
      checkbox.addEventListener('change', function () {
        let row = this.closest('tr');
        row.querySelectorAll('.form-select').forEach(input => {
          input.disabled = !this.checked;
        });
      });
    });
  });
</script>
@endsection