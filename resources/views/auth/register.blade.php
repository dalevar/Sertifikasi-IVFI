@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 2em;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="font-bold " style="color: #c04b29;">{{ __('Daftar Akun Instansi') }}</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="col-md-4 col-form-label">{{ __('Nama Instansi') }}</label>
                            <input id="fullname" type="text"
                                class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                value="{{ old('fullname') }}" required autocomplete="fullname" autofocus
                                placeholder="Nama Instansi">
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Alamat Email Sekolah">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password minimal 8 karakter">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label">{{ __('Konfirmasi Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Konfirmasi Password">
                        </div>
                        <div class="mb-0 ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-primary text-decoration-none fw-bold">Masuk</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
