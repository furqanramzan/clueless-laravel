@extends('admin.layout.auth')
@section('admin', 'active')

@section('content')
<div class="content-wrapper">
    @include('admin.layout.page_header', ['pageRoute' => "$route.index", 'pageIcon' => 'keyboard-backspace', 'pageTitle' => "Update $title"])
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.update", $admin->id) }}" method="POST" class="forms-sample">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') ?? $admin->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') ?? $admin->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <a href="{{ route("$route.index") }}">
                            <button class="btn btn-light">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection