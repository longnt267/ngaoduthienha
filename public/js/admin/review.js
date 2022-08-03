$(document).ready(function() {
    var url = $('#url').val();
    var datatable = $('#datatable').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            method: 'POST',
            url: url
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', class: 'align-middle', orderable: false},
            {data: 'star', name: 'star', width: '5%', class: 'align-middle', orderable: false },
            {data: 'comment', name: 'comment', width: '50%', class: 'align-middle', orderable: false},
            {data: 'created_at', name: 'created_at', width: '12%', class: 'align-middle', orderable: false}
        ]
    });

    $("#search-box").keyup(function() {
        datatable.draw();
    });
    
})
