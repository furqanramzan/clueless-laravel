<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @if(request()->route()->named('admin.dashboard')) active @endif">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item @if(request()->route()->named('admin.admin.index')) active @endif">
            <a class="nav-link" href="{{ route('admin.admin.index') }}">
                <span class="menu-title">Admin</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>