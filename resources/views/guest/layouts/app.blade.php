<!doctype html>
<html lang="en">
@include('guest.layouts.header_scripts')

<body>
    @include('guest.layouts.header')
    <section id="review">
        @yield('content')
    </section>
    @include('guest.layouts.footer')
    @include('guest.layouts.footer_scripts')
</body>

</html>