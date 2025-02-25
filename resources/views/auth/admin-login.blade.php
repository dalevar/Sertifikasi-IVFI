<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Admin Dashboard | IVFI</title>
    
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
  <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
  <div id="auth">
        
    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
          </div>
          <h1 class="auth-title">Log in.</h1>

          <form action="{{ route('admin.login') }}" method="POST">
            @if (session()->has('error'))
              <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
            @endif

            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="email" name="email" id="email" class="form-control form-control-xl" placeholder="Email">
              <div class="form-control-icon">
                  <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" name="password" id="password" class="form-control form-control-xl" placeholder="Password">
              <div class="form-control-icon">
                  <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
          </form>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
          <div id="auth-right">

          </div>
      </div>
    </div>

  </div>
</body>

</html>