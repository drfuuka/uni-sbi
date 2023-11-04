<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box d-flex">
                <a href="/" class="logo logo-light m-auto">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo/logo-1.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/images/logo/logo-1.png') }}" alt="" height="22">
                            <h4 class="ms-3 text-white fw-bold">SBI</h4>
                        </div>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            @auth()
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">Hi, {{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                key="t-logout">Logout</span></a>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @guest
                    <li>
                        <a href="{{ route('peminjam.index') }}" class="nav-link {{ request()->is('/') ? 'mm-active' : '' }}"
                            href="{{ route('peminjam.index') }}">
                            <i class='bx bx-home'></i>
                            <span>Peminjaman / Pengembalian</span>
                        </a>
                    </li>
                @endguest

                @auth()
                    @if (Auth::user()->role === 'Admin')
                        <li>
                            <a href="{{ route('admin.index') }}"
                                class="nav-link {{ request()->is('admin') ? 'mm-active' : '' }}"
                                href="{{ route('admin.index') }}">
                                <i class='bx bx-home'></i>
                                <span>Beranda Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.barang.index') }}"
                                class="nav-link {{ request()->is('admin/barang*') ? 'mm-active' : '' }}"
                                href="{{ route('admin.barang.index') }}">
                                <i class='bx bx-box'></i>
                                <span>List Alat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.list-alat-dipinjam') }}"
                                class="nav-link {{ request()->is('admin/list-alat-dipinjam*') ? 'mm-active' : '' }}"
                                href="{{ route('admin.list-alat-dipinjam') }}">
                                <i class='bx bx-package'></i>
                                <span>Alat Dipinjam / Dikembalikan</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role === 'Inspektor')
                        <li>
                            <a href="{{ route('admin.index') }}"
                                class="nav-link {{ request()->is('inspektor') ? 'mm-active' : '' }}"
                                href="{{ route('admin.index') }}">
                                <i class='bx bx-home'></i>
                                <span>Beranda Inspektor</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('inspektor.inspeksi.index') }}"
                                class="nav-link {{ request()->is('inspektor/inspeksi*') ? 'mm-active' : '' }}"
                                href="{{ route('inspektor.inspeksi.index') }}">
                                <i class='bx bx-box'></i>
                                <span>Inspeksi</span>
                            </a>
                        </li>
                    @endif
                @endauth

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
