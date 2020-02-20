@extends('admin.layout.guest')

@section('content')
<div class="row flex-grow">
    <div class="col-lg-5 mx-auto">
        <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
                <img src="../../assets/images/logo.svg">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
            @include('admin.layout.errors')
            <form action="{{ route('admin.login') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}> Keep me signed in 
                        </label>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection