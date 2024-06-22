<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}"> <img alt="image" src="{{ asset('assets/img/logo.png') }}"
                    class="header-logo" />
                <span class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="dropdown {{ request()->routeIs('resepsionis.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="user"></i><span>Resepsionis</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('resepsionis.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('resepsionis.index') ? 'active' : '' }}"
                            href="{{ route('resepsionis.index') }}">Data Resepsionis</a></li>
                </ul>
            </li>
            <li
                class="dropdown {{ request()->routeIs('kamar.index') || request()->routeIs('jenis-kamar.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="home"></i><span>Kamar</span></a>
                <ul class="dropdown-menu"
                    style="{{ request()->routeIs('kamar.index') || request()->routeIs('jenis-kamar.index') ? 'display: block;' : '' }}">
                    <li><a class="nav-link {{ request()->routeIs('kamar.index') ? 'active' : '' }}"
                            href="{{ route('kamar.index') }}">Data Kamar</a></li>
                    <li><a class="nav-link {{ request()->routeIs('jenis-kamar.index') ? 'active' : '' }}"
                            href="{{ route('jenis-kamar.index') }}">Data Jenis Kamar</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
