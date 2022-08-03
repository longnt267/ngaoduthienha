$(document).ready(function() {
    var url = $('#url').val();
    var datatable = $('#datatable').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            method: 'POST',
            url: url,
            data: function(d) {
                d.search = $('#search-box').val();
                d.status = $('#status-box').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', class: 'align-middle', orderable: false},
            {data: 'name', name: 'name', width: '20%', class: 'align-middle', orderable: false },
            {data: 'email', name: 'email', width: '20%', class: 'align-middle', orderable: false},
            {data: 'phone', name: 'phone', width: '12%', class: 'align-middle', orderable: false},
            {data: 'status', name: 'status', width: '10%', class: 'align-middle', orderable: false},
            {data: 'action', name: 'action', width: '8%', class: 'align-middle', orderable: false}
        ]
    });

    $("#search-box").keyup(function() {
        datatable.draw();
    });
    
    $('#status-box').change(function() {
        datatable.draw();
    })

})

function changeStatusAjax(url) {
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            status: 2
        }
    }).done(function() {
        $('#datatable').DataTable().draw();
    })
}