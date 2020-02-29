@extends('guest.layouts.app')

@push('footer')
<script>
    // get the element to animate
var element = document.getElementById('circle_progress');
var elementHeight = element.clientHeight;

// listen for scroll event and call animate function
document.addEventListener('scroll', animate);

// check if element is in view
function inView() {
  // get window height
  var windowHeight = window.innerHeight;
  // get number of pixels that the document is scrolled
  var scrollY = window.scrollY || window.pageYOffset;
  
  // get current scroll position (distance from the top of the page to the bottom of the current viewport)
  var scrollPosition = scrollY + windowHeight;
  // get element position (distance from the top of the page to the bottom of the element)
  var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;
  
  // is scroll position greater than element position? (is element in view?)
  if (scrollPosition > elementPosition) {
    return true;
  }
  
  return false;
}

// animate element when it is in view
function animate() {
  // is element in view?
  if (inView()) {
      // element is in view, add class to element
      element.classList.add('circle');
  }
}

</script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div style="margin-top:91px; min-height: calc(100vh - 300px); width: 100%; float: left;">
            <div class="w-100 float-left">
                <img src="{{ asset($review->image) }}" style="width: 100%; float: left; height: 300px">
            </div>
            <div class="w-100 float-left mt-4">
                <div class="container-fluid px-5">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 mt-3">
                            <div class="main review-detail">
                                <div class="cname" style="line-height: 10px;">
                                    <h1 style="font-weight: bold; line-height: 40px; font-size: 45px;" class="mb-0">
                                        <a style="text-decoration: none; color: black;"
                                            href="{{ route('guest.find', ['keyword'=>$review->company_name]) }}"
                                            style="color: black">
                                            {{ $review->company_name }}
                                        </a>
                                    </h1>
                                    <h2 style="font-weight: bold; line-height: 40px; font-size: 40px;" class="mb-0">
                                        <a style="text-decoration: none; color: black;"
                                            href="{{ route('guest.find', ['keyword'=>$review->room_name]) }}"
                                            style="color: black">
                                            {{ $review->room_name }}
                                        </a>
                                    </h2>
                                    <h4 style="line-height: 20px;" class="mb-0">
                                        <a style="text-decoration: none; color: black;"
                                            href="{{ route('guest.find', ['country'=>$review->country]) }}"
                                            style="color: black">{{ $review->country }}</a>,
                                        <a style="text-decoration: none; color: black;"
                                            href="{{ route('guest.find', ['region'=>$review->region]) }}"
                                            style="color: black">
                                            {{ $review->region }}
                                        </a>
                                    </h4>
                                    <h4 style="color:#DF8778; line-height: 20px;">
                                        <a style="text-decoration: none;color:#DF8778;"
                                            href="{{ $review->company_url }}" target="_blank">
                                            {{ $review->company_url }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="rating pt-4">
                                    <h1 class="display-1 " style="font-weight: bold;color:#944a41; font-size: 105px;">
                                        {{ $review->overall }}
                                    </h1>
                                </div>
                            </div>
                            <div class="w-100 float-left">
                                {!! $review->body !!}
                            </div>
                            <div class="summary mb-4 w-100 float-left"
                                style="background-color: #D7D7D7; padding: 0 20px;">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h1 style="font-weight: bold; font-size: 60px;" class="mb-3">Summary</h1>
                                        <label class="mb-0" style="font-weight: bold;">Puzzel & Gameplay</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ ((float)$review->puzzles_gameplay / 10) * 100 }}%; height: 20px"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <label style="width: 10%;">
                                                <span class="float-right"
                                                    style="font-weight: bold;">{{ $review->puzzles_gameplay }}</span>
                                            </label>
                                        </div>

                                        <label class="mb-0" style="font-weight: bold;">Design & Theming</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ ((float)$review->design_and_theming / 10) * 100 }}%; height: 20px"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <label style="width: 10%;">
                                                <span class="float-right"
                                                    style="font-weight: bold;">{{ $review->design_and_theming }}</span>
                                            </label>
                                        </div>

                                        <label class="mb-0" style="font-weight: bold;">Games Mastary</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ ((float)$review->games_mastery / 10) * 100 }}%; height: 20px"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <label style="width: 10%;">
                                                <span class="float-right"
                                                    style="font-weight: bold;">{{ $review->games_mastery }}</span>
                                            </label>
                                        </div>

                                        <label class="mb-0" style="font-weight: bold;">Innovation & Tech</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ ((float)$review->innovation_tech / 10) * 100 }}%; height: 20px"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <label style="width: 10%;">
                                                <span class="float-right"
                                                    style="font-weight: bold;">{{ $review->innovation_tech }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <svg viewbox="0 0 36 36" class="circular-chart">
                                            <path class="circle-bg" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path id="circle_progress"
                                                stroke-dasharray="{{ ((float)$review->overall / 10) * 100 }}, 100" d="M18 2.0845
                                        a 15.9155 15.9155 0 0 1 0 31.831
                                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <text x="18" y="23.35" class="circle-rating"
                                                style="stroke: black;">{{ $review->overall }}</text>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-100 float-left mb-4">
                                    <div style="margin-top:30px;">
                                        <h5 style="font-size: 16px; font-weight: bold;">Dificulty:
                                            <span>{{ $review->difficulty }}</span></h5>
                                        <h5 style="font-size: 16px; font-weight: bold;">Our Time:
                                            <span>{{ $review->time }}</span></h5>
                                        <h5 style="font-size: 16px; font-weight: bold;">Accessibility: <span
                                                style="font-size: 14px; font-weight: 500;">{{ $review->accessibility }}</span>
                                        </h5>
                                        <h5 style="font-size: 16px; font-weight: bold;">Value: <span
                                                style="font-size: 14px; font-weight: 500;">{{ $review->value }}</span>
                                        </h5>
                                        <h5 style="font-size: 16px; font-weight: bold;">Ideal for: <span
                                                style="font-size: 14px; font-weight: 500;">{{ $review->ideal_for }}</span>
                                        </h5>

                                    </div>
                                    <div style="display: flex;" class="mb-3 mt-4">
                                        @if ($review->good_for_kids)
                                        <span class="btn"
                                            style=" margin-right: 20px; border-radius: 0px; background-color: #d25540;border:none;">Good
                                            for
                                            Kids</span>
                                        @endif
                                        @if ($review->good_for_enthusiasts)
                                        <span class="btn"
                                            style=" margin-right: 20px; border-radius: 0px; background-color: #d25540;border:none;">Good
                                            for
                                            Enthusiasts</span>
                                        @endif
                                        @if ($review->good_for_design)
                                        <span class="btn"
                                            style=" margin-right: 20px; border-radius: 0px; background-color: #d25540;border:none;">Good
                                            for
                                            Design</span>
                                        @endif
                                        @if ($review->good_for_technology)
                                        <span class="btn"
                                            style=" margin-right: 20px; border-radius: 0px; background-color: #d25540;border:none;">Good
                                            for
                                            Technology</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <section id="commentsection" class="mb-4 w-100 float-left">
                                <div class="comments">
                                    <div class="comment-wrap">
                                        <div class="comment-block">
                                            <form action="{{ route('guest.comment', $review->id) }}" method="POST">
                                                @csrf
                                                <textarea name="body" cols="30" rows="3" placeholder="Add comment..."
                                                    required></textarea>
                                                <button type="submit" class="btn mt-2 "
                                                    style="background-color: #d25540;">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    @foreach ($review->reviewComments as $comment)
                                    <div class="comment-wrap">
                                        <div class="comment-block">
                                            <p class="comment-text">{{ $comment->body }}
                                            </p>
                                            <div class="bottom-comment">
                                                <div class="comment-date float-right">
                                                    {{ $comment->created_at->format('M d, Y @ g:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12" id="mostread-review">
                            <div style="border: 4px solid #DBDBDB;padding: 0;">
                                <h1 class="text-center mt-3 font-weight-bold">Most Read Reviews</h1>
                                @foreach ($reviews as $item)
                                <a href="{{ route('guest.review', $item->id) }}"
                                    style="text-decoration: none; color: black;">
                                    <div class="most-read">
                                        <div>
                                            <img src="{{ asset($item->image) }}" width="100px" height="50px">
                                        </div>
                                        <div class="main mostread">
                                            <div class="cname pl-2 d-flex" style="line-height: 19px; flex-direction: column; justify-content: flex-end;">
                                                <span style="font-size: 20px; margin-bottom: 5px;">{{ $item->company_name }}</span>
                                                <span style="font-size: 20px;">{{ $item->room_name }}</span>
                                            </div>
                                            <div class="rating1 d-flex" style=" color:black; font-weight:bold; align-items: flex-end; justify-content: flex-end;">
                                                <h1 style="margin-bottom: -10px; font-size: 45px; font-weight: bold;">{{ $review->overall }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection