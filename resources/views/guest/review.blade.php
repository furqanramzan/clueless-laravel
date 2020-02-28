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
<div class="imagepage">
    <img src="{{ asset($review->image) }}" class="imagedetail" width="100%" height="400px" alt="">
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="main">
                <div class="cname" style="line-height: 10px;">
                    <a style="text-decoration: none; color: black;"
                        href="{{ route('guest.find', ['keyword'=>$review->company_name]) }}" style="color: black">
                        <h1 style="font-weight: bold">{{ $review->company_name }}</h1>
                    </a>
                    <a style="text-decoration: none; color: black;"
                        href="{{ route('guest.find', ['keyword'=>$review->room_name]) }}" style="color: black">
                        <h2 style="font-weight: bold">{{ $review->room_name }}</h2>
                    </a>
                    <h5 style="font-weight: bold">
                        <a style="text-decoration: none; color: black;"
                            href="{{ route('guest.find', ['country'=>$review->country]) }}" style="color: black">
                            {{ $review->country }}
                        </a> ,
                        <a style="text-decoration: none; color: black;"
                            href="{{ route('guest.find', ['region'=>$review->region]) }}" style="color: black">
                            {{ $review->region }}
                        </a>
                        <a style="text-decoration: none; color: black;" href="{{ $review->company_url }}"
                            target="_blank">
                            <h5 style="color:#d25540">{{ $review->company_url }}</h5>
                        </a>
                </div>
                <div class="rating">
                    <h1 class="display-1 " style="font-weight: bold;color:#944a41">{{ $review->overall }}</h1>
                </div>
            </div>
            {!! $review->body !!}
            <div class="summary mb-4" style="background-color: rgba(128, 128, 128, 0.233); ">
                <div class="row" style="margin:10px;">
                    <div class="col-sm-8 mt-3">
                        <h1>Summary</h1>
                        <label>Puzzel & Gameplay</label>
                        <div class="d-flex">
                            <div class="progress" style="height: 20px; width: 95%;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ ((float)$review->puzzles_gameplay / 10) * 100 }}%; height: 20px"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <label style="width: 10%;">
                                <span class="float-right">{{ $review->puzzles_gameplay }}</span>
                            </label>
                        </div>

                        <label class="mt-3">Design & Theming</label>
                        <div class="d-flex">
                            <div class="progress" style="height: 20px; width: 95%;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ ((float)$review->design_and_theming / 10) * 100 }}%; height: 20px"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <label style="width: 10%;">
                                <span class="float-right">{{ $review->design_and_theming }}</span>
                            </label>
                        </div>

                        <label class="mt-3">Games Mastary</label>
                        <div class="d-flex">
                            <div class="progress" style="height: 20px; width: 95%;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ ((float)$review->games_mastery / 10) * 100 }}%; height: 20px"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <label style="width: 10%;">
                                <span class="float-right">{{ $review->games_mastery }}</span>
                            </label>
                        </div>

                        <label class="mt-3">Innovation & Tech</label>
                        <div class="d-flex">
                            <div class="progress" style="height: 20px; width: 95%;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ ((float)$review->innovation_tech / 10) * 100 }}%; height: 20px"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <label style="width: 10%;">
                                <span class="float-right">{{ $review->innovation_tech }}</span>
                            </label>
                        </div>


                    </div>
                    <div class="col-sm-4 mt-3">
                        <svg viewbox="0 0 36 36" class="circular-chart" style="stroke: #ce8579;">
                            <path class="circle-bg" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path id="circle_progress"
                                stroke-dasharray="{{ ((float)$review->overall / 10) * 100 }}, 100" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="circle-rating">{{ $review->overall }}</text>
                        </svg>
                    </div>
                </div>
                <!-- difficulity section -->
                <div style="margin:20px;">
                    <h5 style="font-size: 16px;">Dificulty: <span>{{ $review->difficulty }}</span></h5>
                    <h5 style="font-size: 16px;">Our Time: <span>{{ $review->time }}</span></h5>
                    <h5 style="font-size: 16px;">Accessibility: <span
                            style="font-size: 12px;">{{ $review->accessibility }}</span></h5>
                    <h5 style="font-size: 16px;">Value: <span style="font-size: 12px;">{{ $review->value }}</span></h5>
                    <h5 style="font-size: 16px;">Ideal for: </h5><span
                        style="font-size: 12px;">{{ $review->enthusiasts }}</span>

                </div>
                <div style="display: flex; padding-bottom: 20px;">
                    @if ($review->good_for_kids)
                    <span class="btn" style=" margin-left: 20px; background-color: #d25540;border:none;">Good for
                        Kids</span>
                    @endif
                    @if ($review->good_for_enthusiasts)
                    <span class="btn" style=" margin-left: 20px; background-color: #d25540;border:none;">Good for
                        Enthusiasts</span>
                    @endif
                    @if ($review->good_for_design)
                    <span class="btn" style=" margin-left: 20px; background-color: #d25540;border:none;">Good for
                        Design</span>
                    @endif
                    @if ($review->good_for_technology)
                    <span class="btn" style=" margin-left: 20px; background-color: #d25540;border:none;">Good for
                        Technology</span>
                    @endif
                </div>
            </div>
            <section id="commentsection">
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
        <div class="col-xl-4 col-lg-4 col-md-7 col-sm-8 col-12 mt-5" id="mostread-review">
            <div style="border: 4px solid rgba(87, 84, 84, 0.603);padding: 0;">
                <h1 class="text-center">Most Read Reviews</h1>
                @foreach ($reviews as $item)
                <a href="{{ route('guest.review', $item->id) }}" style="text-decoration: none; color: black;">
                    <div class="most-read">
                        <div>
                            <img src="{{ asset($item->image) }}" width="70px" height="70px" alt=""
                                style="padding: 10px;">
                        </div>
                        <div>
                            <div class="main " style="padding: 10px;">
                                <div class="cname" style="line-height: 19px;">
                                    <span
                                        style="font-size: 20px;font-weight: bold;">{{ $item->company_name }}</span><br>
                                    <span style="font-size: 20px;font-weight: bold;">{{ $item->room_name }}</span>
                                </div>
                                <div class="rating1 " style=" color:black; font-weight:bold; float: right">
                                    <h1>{{ $review->overall }}</h1>
                                </div>
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