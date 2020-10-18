{{-- {{ dd($data['reviews']) }} --}}
<div class="row">
    @foreach ($data['reviews'] as $review)
    <div class="col-xl-4 col-lg-4 col-md-6 mt-4">
        <div class="card h-100">
            <a style="color: black; text-decoration: none;" href="{{ route('guest.review', $review->slug) }}">
                <div class="view overlay">
                    <img class="card-img-top" width="300" style="height: auto;" src="{{ $review->image }}">
                </div>
                <div class="card-body">
                    <div class="main">
                        <div class="cname">
                            <div>
                                <h4 style="font-size: 24px;">{{ $review->company_name }}</h4>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $review->room_name }}</h4>
                            </div>
                            <div>
                                <h6>{{ $review->region }}, <span>{{ $review->country }}</span> </h6>
                            </div>
                        </div>
                        <div class="rating">
                            <h1>{{ $review->overall }}</h1>
                        </div>
                    </div>
                    <p class="card-text helvitica" style="font-size: 14px;">{{ $review->room_overview }}</p>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>