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
        width: 9px;
        height: 9px;
        top: -3px;
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
        width: 145,
        showScale: false
    });
    $('#players').jRange({
        from: 0,
        to: 1000,
        step: 1,
        isRange : true,
        width: 145,
        showScale: false
    });
    $('#price').jRange({
        from: 0,
        to: 1000,
        step: 1,
        isRange : true,
        width: 145,
        showScale: false
    });
</script>
@endpush

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        <div style="margin-top:100px; min-height: calc(100vh - 300px); width: 100%; float: left;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 px-0">
                    <h1 class="mt-2 font-weight-bold text-center">Find your next Escape Room </h1>
                </div>
            <form action="{{ route('guest.find') }}" class="w-100">
                <div class="col-sm-12">
                    <div class="row mb-3">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h4 class="font-weight-bold mb-0">Keyword Search:</h4>
                            <input type="search" name="keyword" value="{{ $data['params']['keyword'] }}"
                                style="border:2px solid #000000; width: 220px; height: 30px;">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Country</h5>
                            <select name="country" style="width: 145px;">
                                <option value="">All</option>
                                @foreach ($data['countries'] as $country)
                                <option @if($country->country == $data['params']['country']) selected @endif
                                    value="{{ $country->country }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Region</h5>
                            <select name="region" style="width: 145px;">
                                <option value="">All</option>
                                @foreach ($data['regions'] as $region)
                                <option @if($region->region == $data['params']['region']) selected @endif
                                    value="{{ $region->region }}">{{ $region->region }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Rating</h5>
                            <input name="rating" id="rating" class="range-slider" type="hidden"
                                value="{{ $data['params']['rating'] }}" />
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Number of Players</h5>
                            <input name="players" id="players" class="range-slider" type="hidden"
                                value="{{ $data['params']['players'] }}" />
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Average Price per Person</h5>
                            <input name="price" id="price" class="range-slider" type="hidden"
                                value="{{ $data['params']['price'] }}" />
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Jump Scares</h5>
                            <div style="width: 145px;">
                                <label class="checkboxcontainer">
                                    <input type="checkbox" name="jump" value="1"
                                        {{ $data['params']['jump'] ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1 mt-2">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-end">
                            <div style="width: 145px;">
                                <button type="submit" class="btn" style="background-color: #d25540;border:none;">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <hr style="background-color: #A1A1A1; height: 1px; width: 100% !important;">
            @foreach ($data['reviews'] as $chunk)
            <div class="row">
                @foreach ($chunk as $review)
                <div class="col-xl-4 col-lg-4 col-md-4 mt-4">
                    <div class="card h-100">
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