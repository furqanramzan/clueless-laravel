@extends('admin.layout.auth')
@section('toplist', 'active')

@section('content')
<div class="content-wrapper">
    @include('admin.layout.page_header', ['pageRoute' => "$route.index", 'pageIcon' => 'keyboard-backspace', 'pageTitle' => "Add $title"])
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.store") }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="introduction" class="col-sm-3 col-form-label">Introduction</label>
                            <div class="col-sm-9">
                                <input type="text" name="introduction" class="form-control" id="introduction" placeholder="Introduction" value="{{ old('introduction') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="order" class="col-sm-3 col-form-label">Order</label>
                            <div class="col-sm-9">
                                <input type="text" name="order" class="form-control" id="order" placeholder="Order" value="{{ old('order') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <a href="{{ route("$route.index") }}">
                            <button type="button" class="btn btn-light">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection