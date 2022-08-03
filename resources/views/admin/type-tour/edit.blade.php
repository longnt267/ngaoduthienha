@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title">
        <h3>Edit Type of Tour</h3>
        {{ Breadcrumbs::render('edit_type_tour', $data->id) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Edit Type of Tour</h4>
    </div>

    <form class="ct-pd" action="{{ route('type_tour.update', $data->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label">Title <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                    name="title" value="{{ $data->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="slug" class="col-sm-1 col-form-label">Slug <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    placeholder="Slug" value="{{ $data->slug }}">
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group d-flex">
            <label class="col-sm-1" style="padding-left: 0px!important;">Status</label>
            @if ($data->status == 1)
                <div class="wrap-radio wrap-radio-2">
                    <input type="radio" id="radio1" name="status" value="1" checked />
                    <label for="radio1">Active</label>
                </div>   
                <div class="wrap-radio">
                    <input type="radio" id="radio2" name="status" value="2" />
                    <label for="radio2">Block</label>
                </div>
            @else 
                <div class="wrap-radio wrap-radio-2">
                    <input type="radio" id="radio1" name="status" value="1" />
                    <label for="radio1">Active</label>
                </div>
                <div class="wrap-radio">
                    <input type="radio" id="radio2" name="status" value="2" checked />
                    <label for="radio2">Block</label>
                </div>
            @endif    
        </div>

        <div class="form-group row">
            <div class="col-sm-12" style="display: flex; justify-content: center;">
                <input type="submit" class="btn btn-success mt-3" value="Save" style="width: 150px;">
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var inputTitle = $('#title');
            var inputSlug = $('#slug');
            renderSlugInput(inputTitle, inputSlug);

        })
    </script>

@endsection
