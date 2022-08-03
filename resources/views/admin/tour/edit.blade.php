@extends('layouts.admin')

@section('title', 'Edit Tour')

@section('breadcrumb')
    <div class="page-title">
        <h3>Edit Tour</h3>
        {{ Breadcrumbs::render('edit_tour', $data->id) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Edit Tour</h4>
    </div>

    <form class="ct-pd row" action="{{ route('tour.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-sm-6" style="border-right: 1px dashed #88888840;">
            <div class="form-group">
                <label for="title">Title <strong>*</strong></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Title" value="{{ $data->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug <strong>*</strong></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    placeholder="Slug" value="{{ $data->slug }}">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price <strong>*</strong></label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    placeholder="Price" value="{{ $data->price }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="destination-id">Destination</label>
                <select class="form-control @error('destination_id') is-invalid @enderror" id="destination-id"
                    name="destination_id">
                    @foreach ($destination as $item)
                        @if ($item->id == $data->destination_id)
                            <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->title }}</option>    
                        @endif
                    @endforeach
                </select>
                @error('destination_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="type-tour-id">Type of tour</label>
                <select class="form-control @error('type_tour_id') is-invalid @enderror" id="type-tour-id"
                    name="type_tour_id">
                    @foreach ($typeTour as $item)
                        @if ($item->id == $data->type_tour_id)
                            <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->title }}</option> 
                        @endif
                    @endforeach
                </select>
                @error('type_tour_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration"
                    name="duration" placeholder="Duration" min="1" max="10" value="{{ $data->duration }}">
                @error('duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_people">Max people</label>
                <input type="number" class="form-control @error('max_people') is-invalid @enderror" id="max_people"
                    name="max_people" placeholder="Max people" min="1" max="50" value="{{ $data->max_people }}">
                @error('max_people')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="possible_date">Possible dates<strong>*</strong></label>
                <input class="form-control @error('possible_date') is-invalid @enderror" id="possible_date"
                    name="possible_date" placeholder="Possible dates" value="{{ old('possible_date') }}">
                @error('possible_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input hidden id="dates_json" value="{{ $datesJson }}">

            <div class="form-group d-flex">
                <label for="status">Status</label>
                <div class="group-radio" style="margin: -1px 0 0 15px;">
                    @if ($data->status == 1)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                        <label class="form-check-label" for="inlineRadio1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="2">
                        <label class="form-check-label" for="inlineRadio2">Block</label>
                    </div>
                    @endif
                    @if ($data->status == 2)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="1" >
                        <label class="form-check-label" for="inlineRadio1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="2" checked>
                        <label class="form-check-label" for="inlineRadio2">Block</label>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group file-upload" id="file-upload1">
                <label for="image">Image <strong>*</strong></label>
                <div class="image-box image-box-uploaded text-center" style="margin: 0 auto 36px auto;">
                    <p style="display: none;">Upload Image</p>
                    <img src="{{ asset('/storage/upload/'.$data->image) }}" style="display: inline;">
                </div>
                <div class="controls">
                    <input type="file" name="image" class="@error('image') is-invalid @enderror" id="image"/ style="display:none;">
                    @error('image')
                        <span class="invalid-feedback" role="alert" style="text-align: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="map">Embed link map</label>
                <input type="text" name="map" id="map" class="form-control" placeholder="Map" value={{ $data->map }}>
            </div>

            <div class="form-group">
                <label for="image-360">Embed link image 360</label>
                <input type="text" name="image_360" id="image-360" class="form-control" placeholder="Image 360" value="{{ $data->image_360 }}">
            </div>

            <div class="form-group">
                <label for="video">Embed link video</label>
                <input type="text" name="video" id="video" class="form-control" placeholder="Video" value="{{ $data->video }}">
            </div>
        </div>

        <div class="col-sm-12">
            <label>Description</label>
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="border-bottom: none;">
                  <a class="nav-link active" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
                  <a class="nav-link" id="nav-included-tab" data-toggle="tab" href="#nav-included" role="tab" aria-controls="nav-included" aria-selected="false">What Included</a>
                  <a class="nav-link" id="nav-departure-tab" data-toggle="tab" href="#nav-departure" role="tab" aria-controls="nav-departure" aria-selected="false">Departure</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active " id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
                    <textarea name="overview" id="overview" rows="10" cols="80">
                        @if (!empty($data->description->overview))
                          {{ $data->description->overview }}
                        @endif
                    </textarea>
                </div>
                <div class="tab-pane fade" id="nav-included" role="tabpanel" aria-labelledby="nav-included-tab">
                    <textarea name="included" id="included" rows="10" cols="80">
                        @if (!empty($data->description->included))
                          {{ $data->description->included }}
                        @endif
                    </textarea>
                </div>
                <div class="tab-pane fade" id="nav-departure" role="tabpanel" aria-labelledby="nav-departure-tab">
                    <textarea name="departure" id="departure" rows="10" cols="80">
                        @if (!empty($data->description->departure))
                          {{ $data->description->departure }}
                        @endif
                    </textarea>
                </div>
            </div>   
        </div>

        <div class="col-sm-12">
            <div class="form-group" style="margin-top: 20px;">
                <label for="addtional_info">Addtional Info</label>
                <textarea name="addtional_info" id="addtional_info" rows="10" cols="80">
                    {{ $data->addtional_info }}
                </textarea>
            </div>
        </div>

        <div class="col-sm-12" style="display: flex; justify-content: center;">
            <input type="submit" class="btn btn-success" value="Save" style="width: 150px;">
        </div>
    </form>
    <script>
        CKEDITOR.replace('addtional_info');
        CKEDITOR.replace('overview');
        CKEDITOR.replace('included');
        CKEDITOR.replace('departure');
    </script>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var inputTitle = $('#title');
            var inputSlug = $('#slug');
            renderSlugInput(inputTitle, inputSlug);
            uploadImage();
        })

        let dates_json = $('#dates_json').val();
        let dates_array = JSON.parse(dates_json);
        $('#possible_date').flatpickr({
            disable: dates_array,
            minDate: "today",
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
    </script>
@endsection
