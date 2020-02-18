<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header_scripts')

<body>
    <div class="container-scroller">
        @include('admin.layout.header')
        <div class="container-fluid page-body-wrapper">
            @include('admin.layout.sidebar')
            <div class="main-panel">
                @yield('content')
                @include('admin.layout.footer')
            </div>
        </div>
    </div>
    @include('admin.layout.footer_scripts')
</body>

</html>