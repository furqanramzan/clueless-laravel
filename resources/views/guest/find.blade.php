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
        showScale: false,
        ondragend: submitForm,
        onbarclicked: submitForm
    });
    $('#players').jRange({
        from: {{ $data['players']['min'] }},
        to: {{ $data['players']['max'] }},
        step: 1,
        isRange : true,
        width: 145,
        showScale: false,
        ondragend: submitForm,
        onbarclicked: submitForm
    });
    $('#price').jRange({
        from: {{ $data['price']['min'] }},
        to: {{ $data['price']['max'] }},
        step: 1,
        isRange : true,
        width: 145,
        showScale: false,
        ondragend: submitForm,
        onbarclicked: submitForm
    });
    window.regions = @json($data['regions']);
    function countryChanged() {
        let country = $("#countries option:selected").text();
        $('#regions').empty().append($('<option>', { 
            value: "",
            text : "Select Region"
        }));
        if(regions[country]) {
            $.each(regions[country], function (i, item) {
                $('#regions').append($('<option>', { 
                    value: item.region,
                    text : item.region
                }));
            });
        }
        $("form").submit();
    }

    function submitForm() {
        $("form").submit();
    }

    $("#jump").click(function() {
        submitForm();
    });

    var typingTimer;                //timer identifier
    var doneTypingInterval = 2000;  //time in ms, 5 second for example
    var $input = $('#keyword');

    //on keyup, start the countdown
    $input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(submitForm, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
    clearTimeout(typingTimer);
    });

    $("form").submit(function (event) {
        event.preventDefault();
        $(':input[type="submit"]').prop('disabled', true);
        var inputs = {};
        $.each($('form').serializeArray(), function (i, field) {
            inputs[field.name] = field.value;
        });
        inputs['ajax'] = true;


        $.get("/find", inputs,
            function (data, status) {
                if (status === 'success') {
                    $("#find_list").html(data);
                    $(':input[type="submit"]').prop('disabled', false);
                } else {
                    alert('An error occured. Please refresh page and try again');
                }
            });
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
                            <input type="text" name="keyword" id="keyword" value="{{ $data['params']['keyword'] }}"
                                style="border:2px solid #000000; width: 220px; height: 30px;">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Country</h5>
                            <select name="country" style="width: 145px;" onchange="countryChanged()" id="countries">
                                <option value="">Select Country</option>
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
                            <select name="region" style="width: 145px;" id="regions" onchange="submitForm()">
                                <option value="">Select Region</option>
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
                                    <input type="checkbox" name="jump" id="jump" value="1"
                                        {{ $data['params']['jump'] ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1 mt-2">
                        <div class="col-md-4 col-sm-12 px-0 d-flex justify-content-end">
                            <div style="width: 145px;">
                                <button type="submit" class="btn"
                                    style="background-color: #d25540;border:none;">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <hr style="background-color: #A1A1A1; height: 1px; width: 100% !important;">
            <div id="find_list">
                @include('guest.layouts.find_list')
            </div>
        </div>
    </div>
</div>
@endsection