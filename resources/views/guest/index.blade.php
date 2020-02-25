@extends('guest.layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        @foreach ($data['reviews'] as $review)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card mt-3">
                <div class="view overlay">
                    <a href="{{ route('guest.review', $review->id) }}"><img class="card-img-top" width="300" height="200" src="{{ $review->image }}"></a>
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
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
                            <h1>9.1</h1>
                        </div>
                    </div>
                    <p class="card-text mb-3">{{ $review->room_overview }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection