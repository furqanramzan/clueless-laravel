@extends('admin.layout.auth')
@section('toplistreview', 'active')

@section('content')
<div class="content-wrapper">
    @if (session('message'))
    <div class="row" id="proBanner">
        @include('admin.layout.notification', ['notificationType' => session('type') ?? 'success', 'notificationTitle'
        => session('title'), 'notificationMessage' => session('message')])
    </div>
    @endif
    @include('admin.layout.page_header', ['pageRoute' => "$route.create", 'pageIcon' => 'plus', 'pageTitle' => $title])
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Introduction</th>
                                <th>Order</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->topList->name }}</td>
                                <td>{{ $item->review->room_name }}</td>
                                <td>{{ $string->limit($item->overview, 30) }}</td>
                                <td>{{ $item->order }}</td>
                                <td>{{ $item->created_at->format('m-d-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route("$route.edit", $item->id) }}">
                                        <button type="button" class="btn btn-outline-warning btn-sm action-btns">
                                            Edit
                                        </button>
                                    </a>
                                    <form action="{{ route("$route.destroy", $item->id) }}" method="POST"
                                        class="d-inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm action-btns">
                                            Delete
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