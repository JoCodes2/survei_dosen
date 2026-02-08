<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/assets/stmik.png') }}" alt="Logo" class="img-fluid" width="50"
                    height="50">
            </span>
            <span class="text-start app-brand-text fw-bold ms-2">
                <small>Survei Dosen</small><br>
                <small>STMIK</small><br>
                <small>Adhi Guna</small>
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Cek apakah user yang login memiliki role admin atau super-admin --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Utama</span>
        </li>

        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon fa-solid fa-house"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>

        <li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon fa-solid fa-user-gear"></i>
                <div>Prodi</div>
            </a>
        </li>

    </ul>
</aside>
