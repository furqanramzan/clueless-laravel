@extends('guest.layouts.app')
@section('toplist', 'nav-item-active')

@section('content')
<div class="container">
    <h1 class="text-center">{{ $toplist->title }}</h1>
    <div class="row">
        <div class="col-sm-12">
            {{ $toplist->introduction }}
        </div>
    </div>
</div>

<div class="container mt-4">
    @foreach ($toplist->toplistreview as $toplistreview)
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-2">
            <a style="color: black; text-decoration: none;"
                href="{{ route('guest.review', $toplistreview->review->id) }}">
                <img src="{{ asset($toplistreview->review->image) }}" width="300" height="200" class="reviewimage">
            </a>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
            <div class="card-body">
                <div class="main">
                    <a style="color: black; text-decoration: none;"
                        href="{{ route('guest.review', $toplistreview->review->id) }}">
                        <div class="cname">
                            <div>
                                <h3>{{ $toplistreview->review->company_name }}</h3>
                            </div>
                            <div>
                                <h4>{{ $toplistreview->review->room_name }}</h4>
                            </div>
                            <div>
                                <h5>{{ $toplistreview->review->country }},<span>{{ $toplistreview->review->region }}</span>
                                </h5>

                            </div>
                        </div>
                    </a>
                    <div class="rating">
                        <h1>{{ $toplistreview->review->overall }}</h1>
                    </div>
                </div>
                <p class="card-text" style="line-height: 18px;">{{ $toplistreview->overview }}
                </p>
            </div>
        </div>
    </div>
</div>
<hr style="background-color: #00000069;">
@endforeach
</div>
@endsection