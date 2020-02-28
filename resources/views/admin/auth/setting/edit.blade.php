@extends('admin.layout.auth')
@section('contact', 'active')

@push('header')
<link href="/assets/css/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('footer')
<script src="/assets/js/file-upload.js"></script>
<script src="/assets/js/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#value').summernote({
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    });
</script>
@endpush

@section('content')
<div class="content-wrapper">
    @if (session('message'))
    <div class="row" id="proBanner">
        @include('admin.layout.notification', ['notificationType' => session('type') ?? 'success', 'notificationTitle'
        => session('title'), 'notificationMessage' => session('message')])
    </div>
    @endif
    @include('admin.layout.page_header', ['pageTitle' => "Edit $title"])
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.update", $item) }}" method="POST" class="forms-sample">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="value" class="col-sm-3 col-form-label">Value</label>
                            <div class="col-sm-9">
                                <textarea id="value" name="value">
                                    {{ old('value') ?? $item->value }}
                                </textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection