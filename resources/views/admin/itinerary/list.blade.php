@extends('layouts.admin')

@section('title')
    {{ 'Itinerary: '.$nameTour }}
@endsection
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Itinerary</h3>
        {{ Breadcrumbs::render('itinerary', $tourId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Itinerary</h4>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <form class="ct-pd" action="javascript:void(0)">
                <div class="row">
                    <div class="col-sm-4">
                        <select id="action-form" class="custom-select" disabled>
                            <option value="{{ route('itinerary.store', $tourId) }}">Create Itinerary</option>
                            <option value="update">Update Itinerary</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-12 col-form-label">Title <strong>*</strong></label>
                    <div class="col-sm-12">
                        <input id="title" type="text" class="form-control  @error('title') is-invalid @enderror" placeholder="Title"
                            name="title" value="{{ old('title') }}">
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
        <div class="col-sm-7">
            <div class="ct-pd">
                <div class="form-group row">
                    <div class="col-sm-7">
                        <input id="search-box" type="search" class="form-control" placeholder="Search">
                        <input type="text" id="get-url" class="d-none" value="{{ route('itinerary.data', $tourId) }}">
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
    <script src="{{ asset('js/admin/itinerary.js') }}"></script>
@endsection
