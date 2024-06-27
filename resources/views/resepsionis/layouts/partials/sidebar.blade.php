<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('resepsionis.dashboard.index') }}">
                <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo" />
                <span class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ request()->routeIs('resepsionis.dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('resepsionis.dashboard.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="dropdown {{ request()->routeIs('resepsionis.reservasi-resepsionis.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="file-text"></i><span>Reservasi</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('resepsionis.reservasi-resepsionis.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('resepsionis.reservasi-resepsionis.index') ? 'active' : '' }}"
                            href="{{ route('resepsionis.reservasi-resepsionis.index') }}">Data Reservasi</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('resepsionis.kamar-resepsionis.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="home"></i><span>Kamar</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('resepsionis.kamar-resepsionis.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('resepsionis.kamar-resepsionis.index') ? 'active' : '' }}"
                            href="{{ route('resepsionis.kamar-resepsionis.index') }}">Data Kamar</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('resepsionis.pelanggan-resepsionis.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Pelanggan</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('resepsionis.pelanggan-resepsionis.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('resepsionis.pelanggan-resepsionis.index') ? 'active' : '' }}"
                            href="{{ route('resepsionis.pelanggan-resepsionis.index') }}">Data Pelanggan</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('resepsionis.transaksi-resepsionis.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="dollar-sign"></i><span>Transaksi</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('resepsionis.transaksi-resepsionis.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('resepsionis.transaksi-resepsionis.index') ? 'active' : '' }}"
                            href="{{ route('resepsionis.transaksi-resepsionis.index') }}">Data Transaksi</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
