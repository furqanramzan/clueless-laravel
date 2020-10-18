@extends('guest.layouts.app')
@section('toplist', 'nav-item-active')

@section('content')
<div class="container-fluid px-lg-5 px-3">
    <div class="w-100 float-left">
        <div class="main-content">
            <div class="container">
                <h1 class="mt-2 font-weight-bold text-center">{{ $toplist->title }}</h1>
                <div class="row">
                    <div class="col-sm-12">
                        <h5>
                            {{ $toplist->introduction }}
                        </h5>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4">
                @foreach ($toplist->toplistreview as $toplistreview)
                <a style="color: black; text-decoration: none; width: 100%; float: left;"
            href=" {{ route('guest.review', $toplistreview->review->slug) }}">
                    <div style="border-bottom: 2px solid #A1A1A1;" class="row mb-5 pb-4">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 p-0">
                            <img src="{{ asset($toplistreview->review->image) }}" style="width: 100%; height: auto;">
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 p-0 pl-lg-5 pl-0 mt-lg-0 mt-3">
                            <div class="card-body py-1 toplist">
                                <div class="main">
                                    <div class="cname">
                                        <h4>{{ $toplistreview->review->company_name }}</h4>
                                        <h4>{{ $toplistreview->review->room_name }}</h4>
                                        <h6>{{ $toplistreview->review->region }},<span>{{ $toplistreview->review->country }}</span>
                                        </h6>
                                    </div>
                                    <div class="rating">
                                        <h1>{{ $toplistreview->review->overall }}</h1>
                                    </div>
                                </div>
                                <p class="card-text helvitica" style="font-size: 14px; line-height: 18px;">{{ $toplistreview->overview }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection