$(document).ready(function() {
    // handling get data DataTable
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
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%', orderable: false, searchable: false, class: 'align-middle'},
            {data: 'image', name: 'image', width: '15%', orderable: false, class: 'align-middle'},
            {data: 'title', name: 'title', width: '50%', orderable: false, class: 'align-middle'},
            {data: 'status', name: 'status', width: '10%', orderable: false, class: 'align-middle'},
            {data: 'action', name: 'action', width: '15%', orderable: false, class: 'align-middle'},
        ]
    });

    $("#search-box").keyup(function() {
        datatable.draw();
    });
    
    $('#status-box').change(function() {
        datatable.draw();
    })

    // Js - create blade and edit blade
    var inputTitle = $('#title');
    var inputSlug = $('#slug');
    renderSlugInput(inputTitle, inputSlug);
    uploadImage();
})