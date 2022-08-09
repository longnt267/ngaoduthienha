@extends('layouts.admin')

@section('title', 'Review')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Review</h3>
        {{ Breadcrumbs::render('tour') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Review</h4>
    </div>
    <div class="row wrap-action ct-pd">
        <div class="col-lg-2">
            <select id="status-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select status</option>
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="2">Block</option>
            </select>
        </div>
        <div class="col-lg-2">
            <select id="star-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select star</option>
                <option value="">All</option>
                <option value="1">1 <i class="mdi mdi-star"></i></option>
                <option value="2">2 <i class="mdi mdi-star"></i></option>
                <option value="3">3 <i class="mdi mdi-star"></i></option>
                <option value="4">4 <i class="mdi mdi-star"></i></option>
                <option value="5">5 <i class="mdi mdi-star"></i></option>
            </select>
        </div>
    </div>
    <input type="text" id="url" class="d-none" value="{{ route('review.data', $tourId) }}">
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Star</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
    <script src="{{ asset('js/admin/review.js') }}"></script>
@endsection
