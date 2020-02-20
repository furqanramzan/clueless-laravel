<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header_scripts')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layout.footer_scripts')
</body>

</html>