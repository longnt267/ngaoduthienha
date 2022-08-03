@extends('layouts.admin')

@section('title')
    {{ 'Itinerary Detail: '.$tour->title }}
@endsection
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Itinerary Detail</h3>
        {{ Breadcrumbs::render('iti_detail', $tour, $itineraryId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Itinerary Detail</h4>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form class="ct-pd" action="javascript:void(0)">
                <div class="row">
                    <div class="col-sm-4">
                        <select id="action-form" class="custom-select" disabled>
                            <option value="{{ route('iti_detail.store', $itineraryId) }}">Create Itinerary Detail</option>
                            <option value="update">Update Itinerary Detail</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title <strong>*</strong></label>
                    <div class="col-sm-12">
                        <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                            name="title" value="{{ old('title') }}">
                        <span class="invalid-feedback d-inline" role="alert"></span>
                    </div>
                </div>
        
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Content <strong>*</strong></label>
                    <div class="col-sm-12">
                        <textarea name="content" id="content" class="content" cols="30" rows="10" class="@error('content') is-invalid @enderror">
                            {{ old('content') }}
                        </textarea>
                        <span class="invalid-feedback d-inline" role="alert"></span>
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <button class="btn btn-success button-submit" type="submit" style="width: 200px;">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="ct-pd">
                <div class="form-group row">
                    <div class="col-sm-7">
                        <input id="search-box" type="search" class="form-control" placeholder="Search">
                        <input type="text" id="get-url" class="d-none" value="{{ route('iti_detail.data', $itineraryId) }}">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped display" style="width:100%" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>    
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/iti-detail.js') }}"></script>
@endsection
