@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container py-5">
            <div class="mx-auto col-md-5">
                <div class="col-md-8">
                    <h3 class="mb-4 font-weight-bold">Masuk</h3>
                    <form method="POST" action="-">
                        @csrf

                        <div class="form-group ">
                            <div class="col-md-12">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <a href="-" class="text-sm text-gray-700 underline">Lupa Password?</a>
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
                            <div class="mb-0">
                                <div class="mt-4 col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="mt-3">
                                    <div class="">Belum punya akun? <a href="-">Daftar disini</a></div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
