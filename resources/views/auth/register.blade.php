@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container py-5">
            <div class="mx-auto col-md-5">
                <div class="col-md-8">
                    <h3 class="mb-4 font-weight-bold">Register</h3>
                    <form method="POST" action="-">
                        @csrf

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Instansi') }}</label>

                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-muted font-weight-medium">Masukkan nama instansi Anda, Nama
                                    akan digunakan pada data
                                    sertifikat</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="text-muted font-weight-medium">Gunakan alamat email aktif Anda</small>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-muted font-weight-medium">Gunakan minimal 8 karakter dengan kombunasi
                                    huruf
                                    dan angka</small>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <button type="submit" class="btn btn-primary w-100" data-label="Daftar">
                                {{ __('Daftar') }}</button>
                        </div>
                        <div class="mt-3 text-center">
                            Sudah punya akun?
                            <a class="dcd-link font-weight-600 v3-login-cta" href="https://www.dicoding.com/login">Masuk
                                sekarang</a>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
