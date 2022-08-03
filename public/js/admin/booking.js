$(document).ready(function() {
    var url = $('#get-url').val();
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
                d.departure_date = $('#departure-box').val();
                d.payment_status = $('#method-box').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', class: 'align-middle', orderable: false},
            {data: 'booking_code', name: 'booking_code', width: '15%', class: 'align-middle', orderable: false },
            {data: 'fullname', name: 'fullname', width: '20%', class: 'align-middle', orderable: false},
            {data: 'number_people', name: 'number_people', width: '10%', class: 'align-middle', orderable: false},
            {data: 'departure_date', name: 'departure_date', width: '10%', class: 'align-middle', orderable: false},
            {data: 'total_price', name: 'total_price', width: '10%', class: 'align-middle', orderable: false},
            {data: 'payment_status', name: 'payment_status', width: '10%', class: 'align-middle', orderable: false},
            {data: 'status', name: 'status', width: '10%', class: 'align-middle', orderable: false},
            {data: 'action', name: 'action', width: '5%', class: 'align-middle', orderable: false},
            
        ]
    });

    $("#search-box").keyup(function() {
        datatable.draw();
    });
    
    $('#status-box').change(function() {
        datatable.draw();
    })

    $('#departure-box').change(function() {
        datatable.draw();
    })

    $('#method-box').change(function() {
        datatable.draw();
    })

})