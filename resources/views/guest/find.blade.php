@extends('guest.layouts.app')
@section('find', 'nav-item-active')

@push('header')
<link rel="stylesheet" href="/assets/css/jquery.range.css">
<style>
    .theme-green .back-bar {
        height: 3px;
        background-color: black;
        background-image: none;
    }

    .theme-green .back-bar .selected-bar {
        background-color: black;
        background-image: none;
    }

    .theme-green .back-bar .pointer {
        border: 1px solid black;
        background-color: white;
        background-image: none;
        width: 8px;
        height: 8px;
        top: -2px;
    }

    .theme-green .back-bar .pointer-label {
        color: black;
        font-weight: bold;
        top: -14px;
        font-size: 9px;
    }
</style>
@endpush

@push('footer')
<script src="/assets/js/jquery.range.js"></script>
<script>
    $('#rating').jRange({
        from: 0,
        to: 10,
        step: 1,
        isRange : true,
        width: 200,
        showScale: false
    });
    $('#players').jRange({
        from: 0,
        to: 1000,
        step: 1,
        isRange : true,
        width: 200,
        showScale: false
    });
    $('#price').jRange({
        from: 0,
        to: 1000,
        step: 1,
        isRange : true,
        width: 200,
        showScale: false
    });
</script>
@endpush

@section('content')
<section id="findroom">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <h1 class="mt-2 ">Find your next Escape Room </h1>
            </div>
        </div>
        <form action="{{ route('guest.find') }}">
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 style="font-size:30px;font-weight:bold;">Keyword Search:</h1>
                        </div>
                        <div class="col-sm-6">
                            <input type="search" name="keyword" value="{{ $data['params']['keyword'] }}"
                                style="float:right; border:2px solid #000000; width: 220px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Country</h5>
                        </div>
                        <div class="col-sm-6">
                            <select name="country" class="float-right">
                                <option value="">All</option>
                                @foreach ($data['countries'] as $country)
                                <option @if($country->country == $data['params']['country']) selected @endif
                                    value="{{ $country->country }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Region</h5>
                        </div>
                        <div class="col-sm-6">
                            <select name="region" class="float-right">
                                <option value="">All</option>
                                @foreach ($data['regions'] as $region)
                                <option @if($region->region == $data['params']['region']) selected @endif
                                    value="{{ $region->region }}">{{ $region->region }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Rating</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-flex align-items-center h-100">
                                <input name="rating" id="rating" class="range-slider" type="hidden"
                                    value="{{ $data['params']['rating'] }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Number of Players</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-flex align-items-center h-100">
                                <input name="players" id="players" class="range-slider" type="hidden"
                                    value="{{ $data['params']['players'] }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Average Price per Person</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-flex align-items-center h-100">
                                <input name="price" id="price" class="range-slider" type="hidden"
                                    value="{{ $data['params']['price'] }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Jumps Score</h5>
                        </div>
                        <div class="col-sm-6">
                            <input type="checkbox" name="jump" value="1" {{ $data['params']['jump'] ? 'checked' : '' }}
                                style="float:right; border:2px solid #000000;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <button type="submit" class="btn float-right"
                        style="background-color: #d25540;border:none;">Search</a>
                </div>
            </div>
        </form>
        <hr style="background-color: dimgrey !important;
             color: rgba(105, 105, 105, 0.301) !important;width: 100% !important;">
    </div>
</section>

<div class="container">
    <div class="row mt-3">
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
</div>
@endsection