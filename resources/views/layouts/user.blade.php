<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | IVFI</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" crossorigin href="{{ asset('./assets/compiled/css/extra-component-sweetalert.css') }}">

    @stack('styles') <!-- Untuk style tambahan dari child view -->

    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    @include('partials.user.header-top-user')
                </div>
                <nav class="main-navbar">
                    @include('partials.user.main-navbar-user')
                </nav>
            </header>
            <div class="container content-wrapper">
                <!-- breadcrumb -->
                @yield('breadcrumb')
                <div class="page-heading">
                    @yield('page-heading')
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
            </div>

            <footer>
                @include('partials.footer-dashboard')
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/horizontal-layout.js') }}"></script>

    {{-- <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script> --}}

    {{-- Data Tables --}}
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            var table = $("#myTable").DataTable({
                ajax: "your-data-source.json", // Ganti dengan sumber data yang sesuai
                columns: [{
                        data: "tanggal"
                    },
                    {
                        data: "sertifikasi"
                    },
                    {
                        data: "nama_anggota"
                    },
                    {
                        data: "no_identitas"
                    },
                    {
                        data: "status",
                        render: function(data) {
                            return `<span class="badge bg-success">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function() {
                            return `<button class="btn btn-primary btn-sm">Lihat</button>`;
                        }
                    }
                ],
                lengthChange: false, // Menyembunyikan dropdown default DataTables
                pagingType: "simple_numbers",
                dom: "<'row'<'col-md-6'l><'col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-md-6'i><'col-md-6 d-flex justify-content-end'p>>",
                language: {
                    search: "",
                    searchPlaceholder: "Cari...",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });

            // Custom search event
            $("#customSearch").on("keyup", function() {
                table.search(this.value).draw();
            });

            // Custom pagination styling
            $("#myTable_paginate").addClass("d-flex justify-content-end");
        });
    </script> --}}

    {{-- SweetAlert Toastify --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}" defer></script>
    <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}" defer></script>


    @stack('scripts') <!-- Untuk script tambahan dari child view -->
</body>

</html>
