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

        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
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
                <div>Pengguna</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('dosen') ? 'active' : '' }}">
            <a href="/dosen" class="menu-link">
                <i class="menu-icon fa-solid fa-chalkboard-user"></i>
                <div>Dosen</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('programstudi') ? 'active' : '' }}">
            <a href="/programstudi" class="menu-link">
                <i class="menu-icon fa-solid fa-graduation-cap"></i>
                <div>Program Studi</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('semester') ? 'active' : '' }}">
            <a href="/semester" class="menu-link">
                <i class="menu-icon fa-solid fa-calendar-alt"></i>
                <div>Semester</div>
            </a>
        </li>
           <li class="menu-item {{ request()->is('jadwal') ? 'active' : '' }}">
            <a href="/jadwal" class="menu-link">
                <i class="menu-icon fa-solid fa-person-chalkboard"></i>
                <div>Kelas Dosen</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('kriteria') ? 'active' : '' }}">
            <a href="/kriteria" class="menu-link">
                <i class="menu-icon fa-solid fa-list-check"></i>
                <div>Kriteria</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('penilaian') ? 'active' : '' }}">
            <a href="/penilaian" class="menu-link">
                <i class="menu-icon fa-solid fa-list"></i>
                <div>Hasil Survei</div>
            </a>
        </li>

    </ul>
</aside>
