@extends('guest.layouts.app')

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
                        <input type="search" name="keyword" value="{{ $data['params']['keyword'] }}" style="float:right; border:2px solid #000000; width: 220px;">
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
                                <option @if($country->country == $data['params']['country']) selected @endif value="{{ $country->country }}">{{ $country->country }}</option>
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
                                <option @if($region->region == $data['params']['region']) selected @endif value="{{ $region->region }}">{{ $region->region }}</option>
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
                            <div class="float-right d-flex">
                                <input class="range" type="range" min="0" max="100" value="0" step="1"
                                    onmousemove="rangevalue1.value=value" />
                                <output id="rangevalue1">0</output>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Number Player</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-flex">
                                <input class="range" type="range" min="0" max="100" value="0" step="1"
                                    onmousemove="rangevalue2.value=value" />
                                <output id="rangevalue2">0</output>
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
                            <div class="float-right d-flex">
                                <input class="range" type="range" min="0" max="100" value="0" step="1"
                                    onmousemove="rangevalue3.value=value" />
                                <output id="rangevalue3">0</output>
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
                            <input type="checkbox" name="" id="" style="float:right; border:2px solid #000000;">
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
        @foreach ($data['reviews'] as $review)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card mt-3">
                <div class="view overlay">
                    <a href="{{ route('guest.review', $review->id) }}"><img class="card-img-top" width="300"
                            height="200" src="{{ $review->image }}"></a>
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