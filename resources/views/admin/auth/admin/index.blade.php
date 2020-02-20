@extends('admin.layout.auth')
@section('admin', 'active')

@section('content')
<div class="content-wrapper">
    @if (session('message'))
    <div class="row" id="proBanner">
        @include('admin.layout.notification', ['notificationType' => session('type') ?? 'success', 'notificationTitle' => session('title'), 'notificationMessage' => session('message')])
    </div>
    @endif
    @include('admin.layout.page_header', ['pageRoute' => "$route.create", 'pageIcon' => 'plus', 'pageTitle' => $title])
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