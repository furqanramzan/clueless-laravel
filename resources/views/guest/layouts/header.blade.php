<header id="header" class="fixed-top">
    <div style="width:100%; height:10px; background-color:#ce8579;"></div>
    <div class="container-fluid nav-container">
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="{{ route('guest.index') }}" style="font-size:30px;"><img
                    src="/assets/images/logo.png" class="logo-img"></a>
            <button class="navbar-toggler justify-content-center" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "><i class="fa fa-bars mt-1" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @yield('find')">
                        <a class="nav-link" href="{{ route('guest.find') }}"><span style="letter-spacing: 2px;">FIND</span> A ROOM</a>
                    </li>
                    <li class="nav-item dropdown @yield('toplist')">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            TOP LISTS <i class="fa fa-angle-down" style="line-height: 11px;"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach ($toplists as $toplist)
                            <a class="dropdown-item" href="{{ route('guest.toplist', $toplist->id) }}">{{ $toplist->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item @yield('contact')">
                        <a class="nav-link" href="{{ route('guest.contact') }}">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>