@extends('layouts.admin')

@section('title', 'Booking')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Booking</h3>
        {{ Breadcrumbs::render('booking') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Booking</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-4">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
            <input type="text" id="get-url" class="d-none" value="{{ route('booking.data') }}">
        </div>
        <div class="col-lg-2">
            <select id="method-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select payment_status</option>
                <option value="">All</option>
                <option value="1">Unpaid</option>
                <option value="2">Paid</option>
            </select>
        </div>
        <div class="col-lg-2">
            <select id="status-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select status</option>
                <option value="">All</option>
                <option value="1">New</option>
                {{--  <option value="2">Confirmed</option>  --}}
                <option value="3">Cancelled</option>
                <option value="4">Complete</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="date" id="departure-box" style="width: 100%; height: 35px; border: 1px solid #e9ecef; padding: 9px; color: #000000a8;">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Booking Code</th>
                    <th>Fullname</th>
                    <th>Number people</th>
                    <th>Departure date</th>
                    <th>Price</th>
                    <th>Payment status</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
    <script src="{{ asset('js/admin/booking.js') }}"></script>
@endsection
