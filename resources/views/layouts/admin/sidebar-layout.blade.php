<aside class="main-sidebar sidebar-dark-primary elevation-2">
{{-- Brand Logo Start --}}
    <a href="" class="brand-link text-decoration-none text-center">
        <img src="{{ asset('logo.png') }}" alt="Potensi Desa Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text fw-bold fs-6">Pemetaan Potensi Desa</span>
    </a>
{{-- Brand Logo End --}}

<!-- Sidebar Menu Start -->
    <div class="sidebar">
        <nav class="mt-2 mb-5 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item" id="list-admin-account">
                    <a href="#" class="nav-link" id="list-admin-account-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Administrator
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a data-bs-toggle="modal" data-bs-target="#profileAdmin" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>Profile Pribadi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="modal" data-bs-target="#passwordAdmin" class="nav-link">
                                <i class="nav-icon fas fa-unlock-alt"></i>
                                <p>Ganti Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="modal" data-bs-target="#tambahAdmin" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Tambah Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('Logout') }}" method="POST" class="nav-link p-0 m-0">
                                @csrf
                                <button class="nav-link text-danger text-start btn-block">
                                    <i class="nav-icon fas fa-power-off"></i>
                                    <p>Logout</p>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" id="admin-dashboard">
                    <a href="{{ route('Dashboard Admin') }}" id="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item" id="admin-manajemen-desa">
                    <a href="{{ route('Manajemen Desa') }}" id="manajemen-desa" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Manajemen Desa</p>
                    </a>
                </li>
                <li class="nav nav-treeview">
                    <li class="nav-item" id="list-potensi-desa">
                        <a href="#" class="nav-link" id="potensi-desa">
                            <i class="nav-icon fas fa-landmark"></i>
                            <p>
                                Potensi Desa
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="{{ route('Pasar') }}" id="pasar" class="nav-link">
                                    <i class="fas fa-shopping-basket nav-icon"></i>
                                    <p>Pasar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Puspem') }}" id="pusat-pemerintahan" class="nav-link">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Pusat Pemerintahan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Sekolah') }}" id="sekolah" class="nav-link">
                                    <i class="fas fa-school nav-icon"></i>
                                    <p>Sekolah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Tempat Ibadah') }}" id="tempat-ibadah" class="nav-link">
                                    <i class="fas fa-gopuram nav-icon"></i>
                                    <p>Tempat Ibadah</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" id="admin-report">
                    <a href="{{ route('Report') }}" id="report" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="modal" data-bs-target="#tentang" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Tentang</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
{{-- Sidebar Menu End --}}
</aside>
