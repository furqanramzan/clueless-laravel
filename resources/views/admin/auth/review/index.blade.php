@extends('admin.layout.auth')
@section('review', 'active')

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
                                <th>Company</th>
                                <th>Room</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Visits</th>
                                <th>Published</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->room_name }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->region }}</td>
                                <td>{{ $item->visits }}</td>
                                <td>
                                    <i class="mdi {{ $item->published ? 'text-success mdi-check' : 'text-danger mdi-close' }}"></i>
                                </td>
                                <td>{{ $item->created_at->format('m-d-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route("$route.show", $item->id) }}" target="_blank">
                                        <button type="button" class="btn btn-outline-info btn-sm btn-icon action-btns">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route("$route.publish", $item->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm btn-icon action-btns">
                                            <i class="mdi mdi-book-open-page-variant"></i>
                                        </button>
                                    </form>
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