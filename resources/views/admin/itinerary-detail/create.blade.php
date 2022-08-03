@extends('layouts.admin')

@section('title', 'Create Itinerary Detail')

@section('breadcrumb')
    <div class="page-title">
        <h3>Create Itinerary Detail</h3>
        {{ Breadcrumbs::render('create_iti_detail', $tour, $itineraryId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Create Itinerary Detail</h4>
    </div>

    <form class="ct-pd" action="{{ route('iti_detail.store', $itineraryId) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm col-form-label">Title <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                    name="title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm">Content <strong>*</strong></label>
            <div class="col-sm-11">
                <textarea name="content" id="content" cols="30" rows="10" class="@error('content') is-invalid @enderror"></textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
                <button class="btn btn-success button-submit" type="submit" style="width: 200px;">Save</button>
            </div>
        </div>
    </form>

    <script>
        CKEDITOR.replace('content');
    </script>
@endsection


