@extends('layouts.admin')

@section('title', 'Create Itinerary')

@section('breadcrumb')
    <div class="page-title">
        <h3>Create Itinerary</h3>
        {{ Breadcrumbs::render('create_itinerary', $tourId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Create Itinerary</h4>
    </div>

    <form class="ct-pd" action="{{ route('itinerary.store', $tourId) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label">Title <strong>*</strong></label>
            <div class="col-sm-8">
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
            <label class="col-sm-7"></label>
            <div class="col-sm-2">
                <button class="btn btn-success button-submit" type="submit">Save</button>
            </div>
        </div>
    </form>
@endsection


