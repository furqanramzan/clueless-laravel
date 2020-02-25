@extends('admin.layout.auth')
@section('review', 'active')

@section('content')
<div class="content-wrapper">
    @if (session('message'))
    <div class="row" id="proBanner">
        @include('admin.layout.notification', ['notificationType' => session('type') ?? 'success', 'notificationTitle' => session('title'), 'notificationMessage' => session('message')])
    </div>
    @endif
    @include('admin.layout.page_header', ['pageTitle' => $title])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Body</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $string->limit($item->body, 30) }}</td>
                                <td>{{ $item->created_at->format('m-d-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route("$route.edit", $item->id) }}">
                                        <button type="button" class="btn btn-outline-warning btn-sm btn-icon action-btns">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route("$route.destroy", $item->id) }}" method="POST" class="d-inline-block">
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