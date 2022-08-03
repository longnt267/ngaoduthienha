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

    <input type="text" id="url" class="d-none" value="{{ route('review.data', $tourId) }}">
    <div class="table-responsive">
        <table class="table table-striped display" style="width:100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Star</th>
                    <th>Comment</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
    <script src="{{ asset('js/admin/review.js') }}"></script>
@endsection
