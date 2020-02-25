@extends('admin.layout.auth')
@section('toplist', 'active')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> {{ "Update $title" }}
        </h3>
        <h3 class="page-title">
            <a href="{{ route("$route.show", $item->review_id) }}">
                <span class="page-title-icon bg-gradient-info text-white mr-2">
                    <i class="mdi mdi-keyboard-backspace"></i>
                </span>
            </a>
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.update", $item) }}" method="POST" class="forms-sample">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="body" class="col-sm-3 col-form-label">Body</label>
                            <div class="col-sm-9">
                                <input type="text" name="body" class="form-control" id="body" placeholder="Body"
                                    value="{{ old('body') ?? $item->body }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <a href="{{ route("$route.show", $item->id) }}">
                            <button type="button" class="btn btn-light">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection