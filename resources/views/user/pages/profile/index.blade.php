@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil Instansi</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Profil Instansi</h3>
            <p class="text-subtitle text-muted">Informasi tentang instansi Anda.</p>
        </div>
    </div>
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            {{-- Gambar Profil --}}
                            @if ($user->details->photo === NULL)
                                <img src="{{ asset('/images/user.png') }}" class="img-thumbnail" width="150" alt="user">
                            @else
                                <img src="{{ asset('storage/' . $user->details->photo) }}" alt="Foto Profil"
                                class="img-thumbnail w-25">
                            @endif
                            <div class="ms-4">
                                {{-- Nama Instansi --}}
                                <h3 class="card-title text-primary">
                                    {{ $user->fullname ?? 'Nama Instansi Tidak Tersedia' }}</h3>
                                <p class="mb-1"><i class="bi bi-clock-fill me-2"></i>
                                    Bergabung sejak {{ $user->created_at->format('Y') ?? '-' }}
                                </p>
                                {{-- Lokasi --}}
                                <p class="mb-1"><i class="bi bi-pin-map-fill me-2"></i>
                                    {{ $user->details->address ?? 'Lokasi Tidak Diketahui' }}, {{ $province ?? '' }}
                                </p>

                                {{-- Nomor HP --}}
                                <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>
                                    {{ $user->details->phone ?? 'Nomor Tidak Tersedia' }}
                                </p>
                                
                                {{-- Kepala Sekolah --}}
                                <p class="mb-1"><i class="bi bi-person-check-fill me-2"></i>
                                    {{ $user->details->headmaster ?? 'Nomor Tidak Tersedia' }}
                                </p>

                                {{-- Email --}}
                                <div class="mt-3 form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email ?? 'Tidak Tersedia' }}" disabled>
                                    <small class="text-muted">
                                        Anda dapat mengubah alamat email melalui menu
                                        <a href="{{ route('profile.settings') }}#account-content">Akun</a>
                                    </small>
                                </div>

                                {{-- Tombol Pengaturan --}}
                                <div class="mt-3">
                                    <a href="{{ route('profile.settings') }}" class="btn btn-outline-primary">Pengaturan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
