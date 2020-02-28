@extends('guest.layouts.app')
@section('toplist', 'nav-item-active')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Contact Us</h1>
            {!! config('settings.contact_us') !!}
        </div>
    </div>
</div>
@endsection