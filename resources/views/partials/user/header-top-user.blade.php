<div class="container">
    <div class="logo-img">
        <a href="#"><img src="{{ asset('assets/static/images/logo/logo_ivfi_horizontal.svg') }}" alt="Logo"
                class="img-fluid" width="100px"></a>
    </div>
    <div class="header-top-right">
        <ul class="my-auto ms-auto mb-lg-0" style="list-style-type: none;">
            <li class="nav-item dropdown me-3">
                <a class="text-gray-600 nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                    data-bs-display="static" aria-expanded="false">
                    <i class='bi bi-bell bi-sub fs-4'></i>
                    <span class="badge badge-notification bg-danger">7</span>
                </a>
                <ul class="dropdown-menu dropdown-center navbar-top dropdown-menu-sm-end notification-dropdown"
                    aria-labelledby="dropdownMenuButton">
                    <li class="dropdown-header">
                        <h6>Pemberitahuan</h6>
                    </li>
                    <li class="dropdown-item notification-item">
                        <a class="d-flex align-items-center" href="#">
                            <div class="notification-icon bg-success">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                            <div class="notification-text ms-4">
                                <p class="font-bold notification-title">Sertifikasi Telah Diterima
                                </p>
                                <p class="text-sm font-thin notification-subtitle">Jenis Sertifikasi
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <p class="py-2 mb-0 text-center"><a href="#">Lihat Semua Pemberitahuan</a>
                        </p>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="dropdown">
            <a href="#" id="topbarUserDropdown"
                class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class="avatar avatar-md2">
                    <img src="../../assets/compiled/jpg/1.jpg" alt="Avatar">
                </div>
                <div class="text">
                    <h6 class="user-dropdown-name">{{ $user->fullname }}</h6>
                    <p class="text-sm user-dropdown-status text-muted">{{ $user->role == 'user' ? 'Pengguna' : '' }}</p>
                </div>
            </a>
            <ul class="shadow-lg dropdown-menu dropdown-menu-end" aria-labelledby="topbarUserDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.index') }}"> <span>
                            <i class="bi bi-person-vcard-fill"></i>
                            Profil Instansi
                        </span></a></li>
                <li><a class="dropdown-item" href="{{ route('profile.settings') }}">
                        <span>
                            <i class="bi bi-gear-fill"></i>
                            Pengaturan
                        </span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <span class="text-danger">
                            <i class="bi bi-box-arrow-right"></i>
                            {{ __('Keluar') }}
                        </span>

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Burger button responsive -->
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </div>
</div>
