<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/static/images/logo/logo_ivfi_horizontal.svg') }}" type="image/x-icon">
    <title>Sertifikasi IVFI</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styling-->
    <link rel="stylesheet" href="{{ asset('storage/landing-page/css/app.css') }}">
    <style>
        .card {
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .btn-custom {
            background-color: #ff7f3f;
            border: none;
            color: white;
        }

        .btn-custom:hover {
            background-color: #e76e2a;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <!-- resources/views/layouts/navbar.blade.php -->
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
