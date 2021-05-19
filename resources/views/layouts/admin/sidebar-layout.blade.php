<aside class="main-sidebar sidebar-dark-primary elevation-2">
{{-- Brand Logo Start --}}
    <a href="" class="brand-link text-decoration-none text-center">
        {{-- <img src="{{ asset('/images/sipandu-logo.png') }}" alt="Potensi Desa Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light fw-bold">Potensi Desa</span>
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
                            <a href="" id="profile-admin" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>Profile Pribadi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" id="admin-dashboard" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Tambah Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('Logout') }}" method="POST" class="nav-link p-0 m-0">
                                @csrf
                                <button class="nav-link text-danger text-start btn-block">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
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
