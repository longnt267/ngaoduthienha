$(document).ready(function() {
    var url = $('#url').val();
    var datatable = $('#datatable').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        stateSave: true,
        ordering: false,
        ajax: {
            method: 'POST',
            url: url,
            data: function(d) {
                d.status = $('#status-box').val();
                d.star = $('#star-box').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', class: 'align-middle', orderable: false},
            {data: 'star', name: 'star', width: '5%', class: 'align-middle', orderable: false },
            {data: 'comment', name: 'comment', width: '50%', class: 'align-middle', orderable: false},
            {data: 'status', name: 'status', width: '10%', orderable: false, class: 'align-middle'},
            {data: 'created_at', name: 'created_at', width: '12%', class: 'align-middle', orderable: false}
        ]
    });

    $('#status-box').change(function() {
        datatable.draw();
    })

    $('#star-box').change(function() {
        datatable.draw();
    })
})
