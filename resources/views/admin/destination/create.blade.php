@extends('layouts.admin')

@section('title', 'Create Destination')

@section('breadcrumb')
    <div class="page-title">
        <h3>Create Destination</h3>
        {{ Breadcrumbs::render('create_destination') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Create Destination</h4>
    </div>

    <form class="ct-pd row" action="{{ route('destination.store') }}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="col-sm-8">
            <div class="form-group">
                <label for="title">Title <strong>*</strong></label>
                <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                    name="title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug <strong>*</strong></label>
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    placeholder="Slug" value="{{ old('slug') }}">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group d-flex">
                <label >Status</label>
                <div class="wrap-radio">
                    <input type="radio" id="radio1" name="status" value="1" checked />
                    <label for="radio1">Active</label>
                </div>
                <div class="wrap-radio">
                    <input type="radio" id="radio2" name="status" value="2"/>
                    <label for="radio2">Block</label>
                </div>
            </div>
        </div>

        <div class="col-sm-4 d-flex justify-content-center">
            <div class="form-group file-upload" id="file-upload1">
                <label for="image">Image *</label>
                <div class="image-box text-center">
                    <p>Upload Image</p>
                    <img src="{{ old('image') }}" alt="">
                </div>
                <div class="controls">
                    <input type="file" name="image" class="@error('image') is-invalid @enderror" id="image"
                        style="display:none;">
                    @error('image')
                        <span class="isvalid-feedback-custom">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-sm-12" style="display: flex; justify-content: center;">
            <button type="submit" class="btn btn-success mr-2" name="submit" value="submit">Save Destination</button>
            <button type="submit" class="btn btn-primary" name="submit" value="submit-back">Save & Go Back</button>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('js/admin/destination.js') }}"></script>
@endsection
