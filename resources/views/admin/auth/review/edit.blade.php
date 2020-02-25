@extends('admin.layout.auth')
@section('review', 'active')

@push('header')
<link href="/assets/css/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('footer')
<script src="/assets/js/summernote-bs4.min.js"></script>
<script src="/assets/js/file-upload.js"></script>
<script>
    $(document).ready(function() {
        $('#body').summernote({
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    });
</script>
@endpush

@section('content')
<div class="content-wrapper">
    @include('admin.layout.page_header', ['pageRoute' => "$route.index", 'pageIcon' => 'keyboard-backspace', 'pageTitle'
    => "Update $title"])
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('admin.layout.errors')
                    <form action="{{ route("$route.update", $item->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-3 col-form-label">Company Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="company_name" class="form-control" id="company_name"
                                    placeholder="Company Name" value="{{ old('company_name') ?? $item->company_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_url" class="col-sm-3 col-form-label">Company Url</label>
                            <div class="col-sm-9">
                                <input type="text" name="company_url" class="form-control" id="company_url"
                                    placeholder="Company Url" value="{{ old('company_url') ?? $item->company_url }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_name" class="col-sm-3 col-form-label">Room Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="room_name" class="form-control" id="room_name"
                                    placeholder="Room Name" value="{{ old('room_name') ?? $item->room_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_overview" class="col-sm-3 col-form-label">Room Overview</label>
                            <div class="col-sm-9">
                                <input type="text" name="room_overview" class="form-control" id="room_overview"
                                    placeholder="Room Overview" value="{{ old('room_overview') ?? $item->room_overview }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-sm-3 col-form-label">Body</label>
                            <div class="col-sm-9">
                                <textarea id="body" name="body">
                                    {{ old('body') ?? $item->body }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                                <input type="text" name="country" class="form-control" id="country"
                                    placeholder="Country" value="{{ old('country') ?? $item->country }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="region" class="col-sm-3 col-form-label">Region</label>
                            <div class="col-sm-9">
                                <input type="text" name="region" class="form-control" id="region" placeholder="Region"
                                    value="{{ old('region') ?? $item->region }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="puzzles_gameplay" class="col-sm-3 col-form-label">Puzzles and Gameplay
                                Score</label>
                            <div class="col-sm-9">
                                <select name="puzzles_gameplay" class="form-control" id="puzzles_gameplay">
                                    <option value="">Select Puzzles and Gameplay Score</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}"
                                        @if($i==old('puzzles_gameplay') || $i==$item->puzzles_gameplay) selected
                                        @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="design_and_theming" class="col-sm-3 col-form-label">Design andTheming
                                Score</label>
                            <div class="col-sm-9">
                                <select name="design_and_theming" class="form-control" id="design_and_theming">
                                    <option value="">Select Design andTheming Score</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}"
                                        @if($i==old('design_and_theming') || $i==$item->design_and_theming) selected
                                        @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="games_mastery" class="col-sm-3 col-form-label">Games Mastery
                                Score</label>
                            <div class="col-sm-9">
                                <select name="games_mastery" class="form-control" id="games_mastery">
                                    <option value="">Select Games Mastery Score</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" @if($i==old('games_mastery')
                                        || $i==$item->games_mastery)
                                        selected @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="innovation_tech" class="col-sm-3 col-form-label">Innovation Tech
                                Score</label>
                            <div class="col-sm-9">
                                <select name="innovation_tech" class="form-control" id="innovation_tech">
                                    <option value="">Select Innovation Tech Score</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}"
                                        @if($i==old('innovation_tech') || $i==$item->innovation_tech) selected
                                        @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="overall" class="col-sm-3 col-form-label">Overall
                                Score</label>
                            <div class="col-sm-9">
                                <select name="overall" class="form-control" id="overall">
                                    <option value="">Select Overall Score</option>
                                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" @if($i==old('overall') ||
                                        $i==$item->overall)
                                        selected @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="difficulty" class="col-sm-3 col-form-label">Difficulty
                                Score</label>
                            <div class="col-sm-9">
                                <select name="difficulty" class="form-control" id="difficulty">
                                    <option value="">Select Difficulty Score</option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" @if($i==old('difficulty') ||
                                        $i==$item->difficulty)
                                        selected @endif>{{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-sm-3 col-form-label">Time</label>
                            <div class="col-sm-9">
                                <input type="text" name="time" class="form-control" id="time" placeholder="Time"
                                    value="{{ old('time') ?? $item->time }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="length" class="col-sm-3 col-form-label">Length</label>
                            <div class="col-sm-9">
                                <input type="text" name="length" class="form-control" id="length" placeholder="Length"
                                    value="{{ old('length') ?? $item->length }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="accessibility" class="col-sm-3 col-form-label">Accessibility</label>
                            <div class="col-sm-9">
                                <input type="text" name="accessibility" class="form-control" id="accessibility"
                                    placeholder="Accessibility"
                                    value="{{ old('accessibility') ?? $item->accessibility }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-sm-3 col-form-label">Value</label>
                            <div class="col-sm-9">
                                <input type="text" name="value" class="form-control" id="value" placeholder="Value"
                                    value="{{ old('value') ?? $item->value }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ideal_for" class="col-sm-3 col-form-label">Ideal For</label>
                            <div class="col-sm-9">
                                <input type="text" name="ideal_for" class="form-control" id="ideal_for"
                                    placeholder="Ideal For" value="{{ old('ideal_for') ?? $item->ideal_for }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="file-upload-default d-none">
                                <div class="input-group">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="good_for_kids" class="col-sm-3 col-form-label">Good for Kids</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="good_for_kids" value="0">
                                        <input type="checkbox" name="good_for_kids" class="form-check-input" value="1"
                                            {{ old('good_for_kids') ? 'checked' : $item->good_for_kids ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ideal_for" class="col-sm-3 col-form-label">Good for Enthusiasts</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="good_for_enthusiasts" value="0">
                                        <input type="checkbox" name="good_for_enthusiasts" class="form-check-input"
                                            value="1"
                                            {{ old('good_for_enthusiasts') ? 'checked' : $item->good_for_enthusiasts ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="good_for_design" class="col-sm-3 col-form-label">Good for Design</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="good_for_design" value="0">
                                        <input type="checkbox" name="good_for_design" class="form-check-input" value="1"
                                            {{ old('good_for_design') ? 'checked' : $item->good_for_design ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="good_for_technology" class="col-sm-3 col-form-label">Good for Technology</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="good_for_technology" value="0">
                                        <input type="checkbox" name="good_for_technology" class="form-check-input"
                                            value="1"
                                            {{ old('good_for_technology') ? 'checked' : $item->good_for_technology ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <a href="{{ route("$route.index") }}">
                            <button type="button" class="btn btn-light">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection