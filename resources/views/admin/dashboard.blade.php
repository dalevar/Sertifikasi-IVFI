@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-4 col-sm-12">
    <div class="card">
      <div class="card-body">
        <div class="div">
          <i class="bi bi-person-fill fs-1"></i>
        </div>
        <h6 class="text-muted font-semibold">Pengguna Terdaftar</h6>
        <h6 class="font-extrabold mb-0">{{ $users }}</h6>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-sm-12">
    <div class="card">
      <div class="card-body">
        <div class="div">
          <i class="bi bi-people-fill fs-1"></i>
        </div>
        <h6 class="text-muted font-semibold">Member Terdaftar</h6>
        <h6 class="font-extrabold mb-0">{{ $members }}</h6>
      </div>
    </div>
  </div>
</div>
@endsection