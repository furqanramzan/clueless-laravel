<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @yield('dashboard')">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @yield('admin')">
            <a class="nav-link" href="{{ route('admin.admin.index') }}">
                <span class="menu-title">Admins</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @yield('review')">
            <a class="nav-link" href="{{ route('admin.review.index') }}">
                <span class="menu-title">Reviews</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>