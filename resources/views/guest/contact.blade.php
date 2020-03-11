@extends('guest.layouts.app')
@section('contact', 'nav-item-active')

@section('content')
<div class="container-fluid px-lg-5 px-3">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-2 font-weight-bold text-center">Contact Us</h1>
                {!! config('settings.contact_us') !!}
            </div>
        </div>
    </div>
</div>
@endsection