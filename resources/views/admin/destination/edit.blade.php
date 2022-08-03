@extends('layouts.admin')

@section('title', 'Edit Destination')

@section('breadcrumb')
    <div class="page-title">
        <h3>Edit Destination</h3>
        {{ Breadcrumbs::render('edit_destination', $data->id) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Edit Destination</h4>
    </div>

    <form class="ct-pd row" action="{{ route('destination.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-sm-8">
            <div class="form-group">
                <label for="title">Title <strong>*</strong></label>
                <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                    name="title" value="{{ $data->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug <strong>*</strong></label>
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    placeholder="Slug" value="{{ $data->slug }}">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group d-flex">
                <label >Status</label>
                @if ($data->status == 1)
                    <div class="wrap-radio">
                        <input type="radio" id="radio1" name="status" value="1" checked/>
                        <label for="radio1">Active</label>
                    </div>
                    <div class="wrap-radio">
                        <input type="radio" id="radio2" name="status" value="2"/>
                        <label for="radio2">Block</label>
                    </div>
                @else
                    <div class="wrap-radio">
                        <input type="radio" id="radio1" name="status" value="1"/>
                        <label for="radio1">Active</label>
                    </div>
                    <div class="wrap-radio">
                        <input type="radio" id="radio2" name="status" value="2" checked/>
                        <label for="radio2">Block</label>
                    </div>    
                @endif
            </div>
        </div>

        <div class="col-sm-4 d-flex justify-content-center">
            <div class="form-group file-upload" id="file-upload1">
                <label for="image">Image *</label>
                <div class="image-box image-box-uploaded text-center">
                    <p style="display: none;">Upload Image</p>
                    <img src="{{ asset('storage/upload/'.$data->image) }}" alt="" style="display: inline;">
                </div>
                <div class="controls">
                    <input type="file" name="image" class="@error('image') is-invalid @enderror" id="image"
                        style="display:none;">
                    @error('image')
                        <span class="invalid-feedback" role="alert" style="text-align: center;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-sm-12" style="display: flex; justify-content: center;">
            <input type="submit" class="btn btn-success mt-3" value="Save" style="width: 150px;">
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('js/admin/destination.js') }}"></script>
@endsection
