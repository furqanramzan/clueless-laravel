@extends('admin.layout.auth')
@section('toplistreview', 'active')

@section('content')
<div class="content-wrapper">
    @include('admin.layout.page_header', ['pageRoute' => "$route.index", 'pageIcon' => 'keyboard-backspace', 'pageTitle'
    => "Add $title"])
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.update", $item->id) }}" method="POST" class="forms-sample">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="top_list" class="col-sm-3 col-form-label">Top List Page</label>
                            <div class="col-sm-9">
                                <select name="top_list" class="form-control" id="top_list">
                                    <option value="">Select Top List Page</option>
                                    @foreach ($related['topList'] as $topList)
                                    <option value="{{ $topList->id }}" @if($topList->id==old('top_list') || $topList->id==$item->top_list_id) selected
                                        @endif>{{ $topList->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="review" class="col-sm-3 col-form-label">Review</label>
                            <div class="col-sm-9">
                                <select name="review" class="form-control" id="review">
                                    <option value="">Select Review</option>
                                    @foreach ($related['review'] as $review)
                                    <option value="{{ $review->id }}" @if($review->id==old('review') || $review->id==$item->review_id) selected
                                        @endif>{{ $review->room_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="overview" class="col-sm-3 col-form-label">Overview</label>
                            <div class="col-sm-9">
                                <input type="text" name="overview" class="form-control" id="overview"
                                    placeholder="Overview" value="{{ old('overview') ?? $item->overview }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="order" class="col-sm-3 col-form-label">Order</label>
                            <div class="col-sm-9">
                                <input type="text" name="order" class="form-control" id="order" placeholder="Order" value="{{ old('order') ?? $item->order }}">
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