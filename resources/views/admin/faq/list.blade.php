@extends('layouts.admin')

@section('title')
    {{ 'Faqs: '.$nameTour }}
@endsection
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Faq</h3>
        {{ Breadcrumbs::render('faq', $tourId) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Faq</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-3">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
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
            <a href="{{ route('faq.create', $tourId) }}" class="btn btn-success">
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
                    <th>Question</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>    
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var datatable = $('#datatable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    method: 'POST',
                    url: "{{ route('faq.data', $tourId) }}",
                    data: function(d) {
                        d.search = $('#search-box').val();
                        d.status = $('#status-box').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false, class: 'align-middle'},  
                    {data: 'question', name: 'question', width: '65%', orderable: false, class: 'align-middle'},
                    {data: 'status', name: 'status', width: '10%', orderable: false, class: 'align-middle'},
                    {data: 'action', name: 'action', width: '15%', orderable: false, class: 'align-middle'},
                ]
            });

            $("#search-box").keyup(function() {
                datatable.draw();
                e.preventDefault();
            });

            $('#status-box').change(function() {
                datatable.draw();
                e.preventDefault();
            })
        })
    </script>
@endsection
