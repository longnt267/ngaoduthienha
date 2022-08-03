$(document).ready(function () {
    var baseUrl = $('.wrap-comment').data('base-url');
    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        fetch_data(page)
    });

    function fetch_data(page) {
        $.ajax({
            method: "POST",
            url: `${baseUrl}?page=${page}`,
            success: function (data) {
                $(".wrap-comment").html(data);
            },
        });
    }
});
