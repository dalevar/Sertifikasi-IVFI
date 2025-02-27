<div class="container">
    <ul class="align-items-end">
        <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='menu-link'>
                <span><i class="bi bi-grid-fill"></i> Dashboard</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('members*') ? 'active' : '' }}">
            <a href="{{ route('members.index') }}" class='menu-link'>
                <span><i class="bi bi-people-fill"></i> Anggota</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('certification*') ? 'active' : '' }}">
            <a href="{{ route('certifications.index') }}" class='menu-link'>
                <span><i class="bi bi-postcard-fill"></i> Sertifikasi</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('download*') ? 'active' : '' }}">
            <a href="{{ route('download-certificate.index') }}" class='menu-link'>
                <span><i class="bi bi-cloud-download-fill"></i> Unduh Sertifikat</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('payment-histories*') ? 'active' : '' }}">
            <a href="{{ route('payment-histories.index') }}" class='menu-link'>
                <span><i class="bi bi-clock-fill"></i> Riwayat Pembayaran</span>
            </a>
        </li>

    </ul>
</div>
