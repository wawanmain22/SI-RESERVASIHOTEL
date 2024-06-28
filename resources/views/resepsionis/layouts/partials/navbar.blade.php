<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/user-pp.png') }}" class="user-img-radious-style">
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">
                    Hello,
                    @if (Auth::user()->role == 'admin')
                        {{ Auth::user()->admin->nama }}
                    @elseif (Auth::user()->role == 'resepsionis')
                        {{ Auth::user()->resepsionis->nama }}
                    @endif
                </div>
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                @elseif (Auth::user()->role == 'resepsionis')
                    <a href="{{ route('resepsionis.profile.index') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
