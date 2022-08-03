@extends('layouts.admin')

@section('title', 'Tour')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Contact</h3>
        {{ Breadcrumbs::render('tour') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Contact</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-3">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
            <input type="text" id="url" class="d-none" value="{{ route('contact.data') }}">
        </div>
        <div class="col-lg-2">
            <select id="status-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select status</option>
                <option value="">All</option>
                <option value="1">Unread</option>
                <option value="2">Readed</option>
            </select>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
    <script src="{{ asset('js/admin/contact.js') }}"></script>
@endsection
