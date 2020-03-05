@extends('guest.layouts.app')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        <div style="margin-top:100px; min-height: calc(100vh - 100px); width: 100%; float: left;">
            @foreach ($data['reviews'] as $chunk)
            <div class="row">
                @foreach ($chunk as $review)
                <div class="col-xl-4 col-lg-4 mt-4">
                    <div class="card mt-3 h-100">
                        <a style="color: black; text-decoration: none;" href="{{ route('guest.review', $review->id) }}">
                            <div class="view overlay">
                                <img class="card-img-top" width="300" style="height: auto;" src="{{ $review->image }}">
                            </div>
                            <div class="card-body">
                                <div class="main">
                                    <div class="cname">
                                        <div>
                                            <h4>{{ $review->company_name }}</h4>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">{{ $review->room_name }}</h4>
                                        </div>
                                        <div>
                                            <h6>{{ $review->country }}, <span>{{ $review->region }}</span> </h6>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <h1>{{ $review->overall }}</h1>
                                    </div>
                                </div>
                                <p class="card-text">{{ $review->room_overview }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection