@extends('guest.layouts.app')
@section('contact', 'nav-item-active')

@section('content')
<div style="margin-top:100px; min-height: calc(100vh - 250px); width: 100%; float: left;">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-2 font-weight-bold text-center">Contact Us</h1>
                {!! config('settings.contact_us') !!}
            </div>
        </div>
    </div>
</div>
@endsection