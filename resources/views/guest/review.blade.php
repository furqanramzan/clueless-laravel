@extends('guest.layouts.app')

@push('footer')
<script>
    // get the element to animate
// var element = document.getElementById('circle_progress');
// var elementHeight = element.clientHeight;

// // listen for scroll event and call animate function
// document.addEventListener('scroll', animate);

// // check if element is in view
// function inView() {
//   // get window height
//   var windowHeight = window.innerHeight;
//   // get number of pixels that the document is scrolled
//   var scrollY = window.scrollY || window.pageYOffset;
  
//   // get current scroll position (distance from the top of the page to the bottom of the current viewport)
//   var scrollPosition = scrollY + windowHeight;
//   // get element position (distance from the top of the page to the bottom of the element)
//   var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;
  
//   // is scroll position greater than element position? (is element in view?)
//   if (scrollPosition > elementPosition) {
//     return true;
//   }
  
//   return false;
// }

// // animate element when it is in view
// function animate() {
//   // is element in view?
//   if (inView()) {
//       // element is in view, add class to element
//       element.classList.add('circle');
//   }
// }




document.addEventListener('scroll', animate);
function inView(element) {
    var elementHeight = element.clientHeight;
  var windowHeight = window.innerHeight;
  var scrollY = window.scrollY || window.pageYOffset;
  var scrollPosition = scrollY + windowHeight;
  var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;
  if (scrollPosition > elementPosition) {
    return true;
  }
  return false;
}
function animate() {
    var element = document.getElementById('circle_progress');
  if (inView(element)) {
      element.classList.add('circle');
  }
  var element = document.getElementById('puzzles_gameplay');
  if (inView(element)) {
      element.classList.add('w-100');
  }
  var element = document.getElementById('design_and_theming');
  if (inView(element)) {
      element.classList.add('w-100');
  }
  var element = document.getElementById('games_mastery');
  if (inView(element)) {
      element.classList.add('w-100');
  }
  var element = document.getElementById('innovation_tech');
  if (inView(element)) {
      element.classList.add('w-100');
  }
}


$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();
        $(':input[type="submit"]').prop('disabled', true);
        var inputs = {};
        $.each($('form').serializeArray(), function (i, field) {
            inputs[field.name] = field.value;
        });
        var data = {
            _token: inputs._token,
            name: inputs.name,
            body: inputs.body,
        };


        $.post("/comment/" + inputs.review, data,
            function (data, status) {
                if (status === 'success') {
                    var comment = '<div class="comment-wrap"><div class="comment-block"><h4 class="mb-0">'+data.name+'</h4><p class="comment-text">' + data.body + '     </p><div class="bottom-comment"><div class="comment-date float-right">' + data.date + '</div></div></div></div>';
                    $("#comments_list").prepend(comment);
                    $("#name").val("");
                    $("#body").val("");
                    $(':input[type="submit"]').prop('disabled', false);
                } else {
                    alert('An error occured. Please refresh page and try again');
                }
            });
    });
});
</script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="main-content">
            <div class="w-100 float-left">
                <img src="{{ $review->detail_image ? asset($review->detail_image) : asset($review->image) }}"
                    style="width: 100%; float: left; height: auto;">
            </div>
            <div class="w-100 float-left mt-4">
                <div class="container-fluid px-lg-5 px-3">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <div class="main review-detail">
                                <div class="cname">
                                    <h1 style="font-weight: bold; line-height: 40px; font-size: 45px;" class="mb-0">
                                        <a style="text-decoration: none; color: black; font-size: 35px;"
                                            href="{{ route('guest.find', ['keyword'=>$review->company_name]) }}">
                                            {{ $review->company_name }}
                                        </a>
                                    </h1>
                                    <h2 style="font-weight: bold; line-height: 40px; font-size: 40px;" class="mb-0">
                                        <a style="text-decoration: none; color: black;"
                                            href="{{ route('guest.find', ['keyword'=>$review->room_name]) }}">
                                            {{ $review->room_name }}
                                        </a>
                                    </h2>
                                    <h4 style="line-height: 20px;" class="mt-1 mb-2">
                                        <a class="review_detial_area"
                                            href="{{ route('guest.find', ['region'=>$review->region]) }}">{{ $review->region }}</a>,
                                        <a class="review_detial_area"
                                            href="{{ route('guest.find', ['country'=>$review->country]) }}">
                                            {{ $review->country }}
                                        </a>
                                    </h4>
                                    <h4 style="color:#DF8778; line-height: 20px;">
                                        <a style="text-decoration: none;color: #d25540;"
                                            href="\\{{ $review->company_url }}" target="_blank">
                                            {{ $review->company_url }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="rating float-left">
                                    <h1 style="font-weight: bold;color:#944a41; font-size: 105px; line-height: 90px;">
                                        {{ $review->overall }}
                                    </h1>
                                </div>
                            </div>
                            <div class="w-100 float-left helvitica" style="font-size: 14px;">
                                {!! $review->body !!}
                            </div>
                            <div class="summary mb-4 w-100 float-left"
                                style="background-color: #D7D7D7; padding: 0 20px;">
                                <div class="row">
                                    <div class="col-sm-8 px-1">
                                        <h1 style="font-weight: bold; font-size: 60px;" class="mb-3">Summary</h1>
                                        <label class="mb-0" style="font-weight: bold;">Puzzles</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div
                                                    style="height: 20px; width: {{ ((float)$review->puzzles_gameplay / 10) * 100 }}%;">
                                                    <div id="puzzles_gameplay" class="h-100 progress-bar"></div>
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
                                                <div
                                                    style="height: 20px; width: {{ ((float)$review->design_and_theming / 10) * 100 }}%;">
                                                    <div id="design_and_theming" class="h-100 progress-bar"></div>
                                                </div>
                                            </div>
                                            <label style="width: 10%;">
                                                <span class="float-right"
                                                    style="font-weight: bold;">{{ $review->design_and_theming }}</span>
                                            </label>
                                        </div>

                                        <label class="mb-0" style="font-weight: bold;">Games mastery</label>
                                        <div class="d-flex">
                                            <div class="progress" style="height: 20px; width: 95%;">
                                                <div
                                                    style="height: 20px; width: {{ ((float)$review->games_mastery / 10) * 100 }}%;">
                                                    <div id="games_mastery" class="h-100 progress-bar"></div>
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
                                                <div
                                                    style="height: 20px; width: {{ ((float)$review->innovation_tech / 10) * 100 }}%;">
                                                    <div id="innovation_tech" class="h-100 progress-bar"></div>
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
                                <div class="row">
                                    <div class="w-100 float-left mb-4" style="margin-left: 5px;">
                                        <div style="margin-top:30px;">
                                            {{-- <h5 style="font-size: 16px; font-weight: bold;">Dificulty:
                                                <span>{{ $review->difficulty }}</span></h5> --}}
                                            <h5 style="font-size: 16px;"><span style="font-size: 16px; font-weight: bold">
                                                Our Time:
                                            </span>  
                                                <span class="helvitica">{{ $review->time }}</span></h5>
                                            @if ($review->accessibility)
                                            <h5 style="font-size: 16px; font-weight: bold;">Accessibility: <span
                                                    style="font-size: 14px; font-weight: 500;" class="helvitica">{{ $review->accessibility }}</span>
                                            </h5>
                                            @endif
                                            <h5 style="font-size: 16px; font-weight: bold;">Value: <span
                                                    style="font-size: 14px; font-weight: 500;" class="helvitica">{{ $review->value }}</span>
                                            </h5>
                                            <h5 style="font-size: 16px; font-weight: bold;">Ideal for: <span
                                                    style="font-size: 14px; font-weight: 500;" class="helvitica">{{ $review->ideal_for }}</span>
                                            </h5>

                                        </div>
                                        <div class="good_for mb-3 mt-4">
                                            @if ($review->good_for_kids)
                                            <a href="{{ route('guest.find', ['good_for_kids' => 1]) }}">
                                                <span class="btn"
                                                    style=" border-radius: 0px; background-color: #d25540;border:none;">Good
                                                    for
                                                    Kids</span>
                                            </a>
                                            @endif
                                            @if ($review->good_for_enthusiasts)
                                            <a href="{{ route('guest.find', ['good_for_enthusiasts' => 1]) }}">
                                                <span class="btn"
                                                    style=" border-radius: 0px; background-color: #d25540;border:none;">Good
                                                    for
                                                    Enthusiasts</span>
                                            </a>
                                            @endif
                                            @if ($review->good_for_design)
                                            <a href="{{ route('guest.find', ['good_for_design' => 1]) }}">
                                                <span class="btn"
                                                    style=" border-radius: 0px; background-color: #d25540;border:none;">Good
                                                    for
                                                    Design</span>
                                            </a>
                                            @endif
                                            @if ($review->good_for_technology)
                                            <a href="{{ route('guest.find', ['good_for_technology' => 1]) }}">
                                                <span class="btn"
                                                    style=" border-radius: 0px; background-color: #d25540;border:none;">Good
                                                    for
                                                    Technology</span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section id="commentsection" class="mb-4 w-100 float-left">
                                <div class="comments">
                                    <div class="comment-wrap">
                                        <div class="comment-block">
                                            <form id="comment_form">
                                                @csrf
                                                <input type="hidden" name="review" value="{{ $review->id }}">
                                                <input id="name" type="text" name="name" required placeholder="Your name"
                                                    class="mb-2">
                                                <textarea name="body" cols="30" rows="3" id="body" placeholder="Add comment..."
                                                    required></textarea>
                                                <button type="submit" class="btn mt-2 "
                                                    style="background-color: #d25540;">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="comments_list">
                                        @foreach ($review->reviewComments as $comment)
                                        <div class="comment-wrap">
                                            <div class="comment-block">
                                                <h4 class="mb-0">{{ $comment->name }}
                                                </h4>
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
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12" id="mostread-review">
                            <div style="border: 4px solid #DBDBDB;padding: 0;">
                                <h1 class="text-center mt-3 font-weight-bold">Most Read Reviews</h1>
                                @foreach ($reviews as $item)
                                <a href="{{ route('guest.review', $item->slug) }}"
                                    style="text-decoration: none; color: black;">
                                    <div class="most-read">
                                        <div>
                                            <img src="{{ asset($item->image) }}" width="100px" height="50px">
                                        </div>
                                        <div class="main mostread">
                                            <div class="cname d-flex"
                                                style="line-height: 19px; flex-direction: column; justify-content: flex-end;">
                                                <span
                                                    style="font-size: 20px; margin-bottom: 5px;">{{ $item->company_name }}</span>
                                                <span style="font-size: 20px;">{{ $item->room_name }}</span>
                                            </div>
                                            <div class="rating1 d-flex"
                                                style=" color:black; font-weight:bold; align-items: flex-end; justify-content: flex-end;">
                                                <h1 style="margin-bottom: -10px; font-size: 45px; font-weight: bold;">
                                                    {{ $item->overall }}</h1>
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