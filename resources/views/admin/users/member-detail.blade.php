@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="row">
        <div class="col-md-12 col-12">
          <h6>Nama Lengkap:</h6>
          <h4>{{ $member->fullname }}</h4>
        </div>
        <hr>
        <div class="col-md-6 col-12">
          <h6>Nomor Identitas</h6>
          <p>{{ $member->number_identity }}</p>
        </div>
        <div class="col-md-6 col-12">
          <h6>Tempat, Tanggal Lahir</h6>
          <p>{{ $member->birthplace }}, {{ \Carbon\Carbon::parse($member->birtday)->locale('id')->translatedFormat('d F Y') }}</p>
        </div>
        <div class="col-md-6 col-12">
          <h6>Jenis Kelamin</h6>
          <p>{{ $member->gender === 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
        </div>
        <hr>
        <div class="col-md-6 col-12">
          <h6>Alamat</h6>
          <p>{{ $member->address }}</p>
        </div>
        <div class="col-md-6 col-12">
          <h6>Telepon/HP</h6>
          <p>{{ $member->phone }}</p>
        </div>
        <div class="col-md-6 col-12">
          <h6>Email</h6>
          <p>{{ $member->email }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection