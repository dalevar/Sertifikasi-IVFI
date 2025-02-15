<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title }} | IVFI</title>

	<link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">

	<link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
</head>

<body>
  <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
	<div id="app">
		<div id="sidebar">
			@include('partials.sidebar')
		</div>
		<div id="main">
			<header class="mb-3">
				<a href="#" class="burger-btn d-block d-xl-none">
					<i class="bi bi-justify fs-3"></i>
				</a>
			</header>

			<div class="page-heading">
				<div class="page-title">
					<div class="row">
						<div class="order-last col-12 col-md-6 order-md-1">
							<h3>{{ $title }}</h3>
						</div>
					</div>
				</div>
				<section class="section">
					@yield('content')
				</section>
			</div>

			<footer>
				<div class="clearfix mb-0 footer text-muted">
					<div class="float-start">
						<p>2023 &copy; Mazer</p>
					</div>
					<div class="float-end">
						<p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
							by <a href="https://saugi.me">Saugi</a></p>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
	<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
	<script>
		function confirmDelete(event) {
      if (!confirm("Apakah Anda yakin ingin menghapus ini?")) {
        event.preventDefault(); // Prevent the form from submitting
      }
    }
	</script>
</body>

</html>
