@extends('layouts.admin')

@section('title', 'Create Faq')

@section('breadcrumb')
    <div class="page-title">
        <h3>Create Faq</h3>
        {{ Breadcrumbs::render('create_faq', $tourId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Create Itinerary</h4>
    </div>

    <form class="ct-pd" action="{{ route('faq.store', $tourId) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="question" class="col-sm col-form-label">Question <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="question" type="text" class="form-control  @error('question') is-invalid @enderror" placeholder="Question"
                    name="question" value="{{ old('title') }}">
                @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm">Answer <strong>*</strong></label>
            <div class="col-sm-11">
                <textarea name="answer" id="answer" cols="30" rows="10" class="@error('answer') is-invalid @enderror"></textarea>
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="status" class="col-sm-1">Status</label>
            <div class="group-radio col-sm-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status" value="2">
                    <label class="form-check-label" for="inlineRadio2">Block</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-success mr-2" name="submit" value="submit">Save Faq</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit-back">Save & Go Back</button>
            </div>
        </div>
    </form>

    <script>
        CKEDITOR.replace('answer');
    </script>
@endsection


