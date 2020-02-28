<!doctype html>
<html lang="en">
@include('guest.layouts.header_scripts')

<body>
    @include('guest.layouts.header')
    <section style="margin-top:100px; min-height: calc(100vh - 300px);">
        @yield('content')
    </section>
    @include('guest.layouts.footer')
    @include('guest.layouts.footer_scripts')
</body>

</html>