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
                <i class="mdi mdi-account-key menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @yield('review')">
            <a class="nav-link" href="{{ route('admin.review.index') }}">
                <span class="menu-title">Reviews</span>
                <i class="mdi mdi-bullseye menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @yield('toplist')">
            <a class="nav-link" href="{{ route('admin.toplist.index') }}">
                <span class="menu-title">Top Lists</span>
                <i class="mdi mdi-format-vertical-align-top menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @yield('toplistreview')">
            <a class="nav-link" href="{{ route('admin.toplistreview.index') }}">
                <span class="menu-title">Top List Reviews</span>
                <i class="mdi mdi-format-vertical-align-center menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>