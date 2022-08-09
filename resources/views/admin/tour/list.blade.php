@extends('layouts.admin')

@section('title', 'Tour')
    
@section('breadcrumb')
    <div class="page-title">
        <h3>Tour</h3>
        {{ Breadcrumbs::render('tour') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Tour</h4>
    </div>

    <div class="row wrap-action ct-pd">
        <div class="col-lg-3">
            <input id="search-box" type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-lg-2">
            <select id="status-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select status</option>
                <option value="">All</option>
                <option value="1">Active</option>
                <option value="2">Block</option>
            </select>
        </div>
        <div class="col-lg-2">
            <select id="des-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select destination</option>
                <option value="">All</option>
                @foreach ($destination as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>               
                @endforeach
            </select>
        </div>
        <div class="col-lg-2">
            <select id="type-box" class="select2" style="width: 100%!important;">
                <option selected disabled hidden>Select type of tour</option>
                <option value="">All</option>
                @foreach ($typeTour as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="{{ route('tour.create') }}" class="btn btn-success" style="margin-bottom: 10px">
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
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Trending</th>
                    <th>Status</th>
                    <th class="text-center">More Info</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>    
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
                    url: "{{ route('tour.data') }}",
                    data: function(d) {
                        d.search = $('#search-box').val();
                        d.status = $('#status-box').val();
                        d.destination = $('#des-box').val();
                        d.typeTour = $('#type-box').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', class: 'align-middle', orderable: false},
                    {data: 'title', name: 'title', width: '20%', class: 'align-middle', orderable: false },
                    {data: 'image', name: 'image', width: '10%', class: 'align-middle text-center', orderable: false},
                    {data: 'price', name: 'price', width: '10%', class: 'align-middle text-center', orderable: false},
                    {data: 'trending', name: 'trending', width: '5%', class: 'align-middle text-center', orderable: false},
                    {data: 'status', name: 'status', width: '5%', class: 'align-middle text-center', orderable: false},
                    {data: 'more', name: 'more', width: '10%', class: 'align-middle', orderable: false},
                    {data: 'action', name: 'action', width: '15%', class: 'align-middle text-center', orderable: false},
                ]
            });

            $("#search-box").keyup(function() {
                datatable.draw();
            });
            
            $('#status-box').change(function() {
                datatable.draw();
            })

            $('#des-box').change(function() {
                datatable.draw();
            })

            $('#type-box').change(function() {
                datatable.draw();
            })
        })
    </script>
@endsection
