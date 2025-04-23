@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 2em;">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <img src="{{ asset('assets/static/images/logo/logo_ivfi_horizontal.svg') }}" alt="Logo" class="img-fluid mb-3" width="100px">
                    <h3 class="font-bold" style="color: #c04b29;">{{ __('Login - Sertifikasi IVFI') }}</h3>
                    <p>Silahkan login menggunakan akun anda</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Instansi') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="password" class="col-md-4 col-form-label ">{{ __('Password') }}</label>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Forgot Password Link -->
                        <div class="mb-3 text-end">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Masuk') }}
                                </button>

                            </div>
                        </div>
                    </form>
                    <p class="text-center mt-3">
                        Belum punya akun ? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
