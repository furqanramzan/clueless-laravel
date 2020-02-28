@extends('guest.layouts.app')

@section('content')
<div class="container">
    @foreach ($data['reviews'] as $chunk)
    <div class="row">
        @foreach ($chunk as $review)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card mt-3 h-100">
                <a style="color: black; text-decoration: none;" href="{{ route('guest.review', $review->id) }}">
                    <div class="view overlay">
                        <img class="card-img-top" width="300" height="200" src="{{ $review->image }}">
                    </div>
                    <div class="card-body">
                        <div class="main">
                            <div class="cname">
                                <div>
                                    <h3>{{ $review->company_name }}</h3>
                                </div>
                                <div>
                                    <h4>{{ $review->room_name }}</h4>
                                </div>
                                <div>
                                    <h5>{{ $review->country }},<span>{{ $review->region }}</span> </h5>
                                </div>
                            </div>
                            <div class="rating">
                                <h1>{{ $review->overall }}</h1>
                            </div>
                        </div>
                        <p class="card-text mb-3">{{ $review->room_overview }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection