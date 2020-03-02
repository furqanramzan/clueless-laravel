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
                    <form action="{{ route("$route.update", $item->id) }}" method="POST" class="forms-sample"
                        enctype="multipart/form-data">
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
                                    placeholder="Room Overview"
                                    value="{{ old('room_overview') ?? $item->room_overview }}">
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
                            <label for="puzzles_gameplay" class="col-sm-3 col-form-label">Puzzles and Gameplay</label>
                            <div class="col-sm-9">
                                <input type="text" name="puzzles_gameplay" class="form-control" id="puzzles_gameplay"
                                    placeholder="Puzzles and Gameplay" value="{{ old('puzzles_gameplay') ?? $item->puzzles_gameplay }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="design_and_theming" class="col-sm-3 col-form-label">Design and Theming</label>
                            <div class="col-sm-9">
                                <input type="text" name="design_and_theming" class="form-control"
                                    id="design_and_theming" placeholder="Design and Theming"
                                    value="{{ old('design_and_theming') ?? $item->design_and_theming }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="games_mastery" class="col-sm-3 col-form-label">Games Mastery</label>
                            <div class="col-sm-9">
                                <input type="text" name="games_mastery" class="form-control" id="games_mastery"
                                    placeholder="Games Mastery" value="{{ old('games_mastery') ?? $item->games_mastery }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="innovation_tech" class="col-sm-3 col-form-label">Innovation Tech</label>
                            <div class="col-sm-9">
                                <input type="text" name="innovation_tech" class="form-control" id="innovation_tech"
                                    placeholder="Innovation Tech" value="{{ old('innovation_tech') ?? $item->innovation_tech }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="overall" class="col-sm-3 col-form-label">Overall Score</label>
                            <div class="col-sm-9">
                                <input type="text" name="overall" class="form-control" id="overall"
                                    placeholder="Overall Score" value="{{ old('overall') ?? $item->overall }}">
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
                            <label for="average_price" class="col-sm-3 col-form-label">Average Price</label>
                            <div class="col-sm-9">
                                <input type="text" name="average_price" class="form-control" id="average_price"
                                    placeholder="Average Price" value="{{ old('average_price') ?? $item->average_price }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minimum_players" class="col-sm-3 col-form-label">Minimum Players</label>
                            <div class="col-sm-9">
                                <input type="text" name="minimum_players" class="form-control" id="minimum_players"
                                    placeholder="Minimum Players" value="{{ old('minimum_players') ?? $item->minimum_players }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maximum_players" class="col-sm-3 col-form-label">Maximum Players</label>
                            <div class="col-sm-9">
                                <input type="text" name="maximum_players" class="form-control" id="maximum_players"
                                    placeholder="Maximum Players" value="{{ old('maximum_players') ?? $item->maximum_players }}">
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
                            <label class="col-sm-3 col-form-label">Detail Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="detail_image" class="file-upload-default d-none">
                                <div class="input-group">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Detail Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jump_scares" class="col-sm-3 col-form-label">Jump Scares</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="jump_scares" value="0">
                                        <input type="checkbox" name="jump_scares" class="form-check-input" value="1"
                                            {{ old('jump_scares') ? 'checked' : $item->jump_scares ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wheelchair" class="col-sm-3 col-form-label">Wheelchair</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="wheelchair" value="0">
                                        <input type="checkbox" name="wheelchair" class="form-check-input" value="1"
                                            {{ old('wheelchair') ? 'checked' : $item->wheelchair ? 'checked' : '' }}></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_closed" class="col-sm-3 col-form-label">Is Closed</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="hidden" name="is_closed" value="0">
                                        <input type="checkbox" name="is_closed" class="form-check-input" value="1"
                                            {{ old('is_closed') ? 'checked' : $item->is_closed ? 'checked' : '' }}></label>
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