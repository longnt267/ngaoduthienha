@extends('layouts.admin')

@section('title', 'Destinations')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Destinations</h3>
        {{ Breadcrumbs::render('destination') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Destinations</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-3">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
            <input type="text" id="get-url" class="d-none" value="{{ route('destination.data') }}" >
        </div>
        <div class="col-lg-3">
            <select id="status-box" class="custom-select">
                <option selected disabled hidden>Select status</option>
                <option value="0">All</option>
                <option value="1">Active</option>
                <option value="2">Block</option>
            </select>
        </div>
        <div class="col-lg-6 btn-edit">
            <a href="{{ route('destination.create') }}" class="btn btn-success">
                <i class="fal fa-plus"></i>
                <span>Add</span>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
   <script src="{{ asset('js/admin/destination.js') }}"></script>
@endsection
