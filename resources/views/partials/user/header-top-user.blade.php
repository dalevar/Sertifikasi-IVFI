<div class="container">
    <div class="logo-img">
        <a href="#"><img src="{{ asset('assets/static/images/logo/logo_ivfi_horizontal.svg') }}" alt="Logo"
                class="img-fluid" width="100px"></a>
    </div>
    <div class="header-top-right">
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
