@extends('layouts.admin')

@section('title', 'Edit Itinerary')

@section('breadcrumb')
    <div class="page-title">
        <h3>Edit Itinerary</h3>
        {{ Breadcrumbs::render('edit_itinerary', $tourId, $id) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Edit Itinerary</h4>
    </div>

    <form class="ct-pd" action="{{ route('itinerary.update', ['tour_id' => $tourId, 'id' => $id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label">Title <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                    name="title" value="{{ $itinerary->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
                <button class="btn btn-success button-submit" type="submit" style="width: 200px">Save</button>
            </div>
        </div>
    </form>
@endsection


