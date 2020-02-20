@extends('admin.layout.app')
@section('admin', 'active')

@section('content')
<div class="content-wrapper">
    @if (session('message'))
    <div class="row" id="proBanner">
        <div class="col-12">
            <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
                @if (session('title'))
                <strong>{{ session('title') }}</strong>
                @endif
                @if (session('message'))
                {{ session('message') }}
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> {{ $title }}
        </h3>
        <h3 class="page-title">
            <a href="{{ route("$route.create") }}">
                <span class="page-title-icon bg-gradient-success text-white mr-2">
                    <i class="mdi mdi-plus"></i>
                </span>
            </a>
        </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->created_at->format('m-d-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.admin.edit', $admin->id) }}">
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-icon action-btns">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.admin.destroy', $admin->id) }}" method="POST" class="d-inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-icon action-btns">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection