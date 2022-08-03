@extends('layouts.admin')

@section('title', 'Type of tour')

@section('breadcrumb')
    <div class="page-title">
        <h3>Type of tour</h3>
        {{ Breadcrumbs::render('type_tour') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Type of tour</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-3">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-lg-3">
            <select id="status-box" class="custom-select">
                <option selected disabled hidden>Select status</option>
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="2">Block</option>
            </select>
        </div>
        <div class="col-lg-6 btn-edit">
            <a href="{{ route('type_tour.create') }}" class="btn btn-success">
                <i class="fal fa-plus"></i>
                <span>Add</span>
            </a>
        </div>
    </div>
    
    <table class="table table-striped ct-pd custom-table" id="datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var datatable = $('#datatable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    method: 'POST',
                    url: "{{ route('type_tour.data') }}",
                    data: function(d) {
                        d.search = $('#search-box').val();
                        d.status = $('#status-box').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false, class: 'align-middle'},
                    {data: 'title', name: 'title', width: '50%', orderable: false, class: 'align-middle'},
                    {data: 'status', name: 'status', width: '20%', orderable: false, class: 'align-middle'},
                    {data: 'action', name: 'action', width: '15%', orderable: false, class: 'align-middle'},
                ]
            });

            $("#search-box").keyup(function() {
                datatable.draw();
            });
            
            $('#status-box').change(function() {
                datatable.draw();
            })
        })
    </script>
@endsection
