function deleteImageAjax(element, url) {
    $.ajax({
        type: "DELETE",
        url: url,
    }).done(function(data) {
        element.remove();
        toastr.success(data);
        if($('.wrap-image').length == 0) {
            $('.wrap-album').append('<strong id="empty-album" class="mb-2">Empty Album</strong>');
        }
      
    })
}

$(document).ready(function () {
    var btnUpload = $("#upload-image");
    var url = $('#url-upload').val();

    btnUpload.change(function () {
        let formData = new FormData();
        let totalFiles = this.files.length;
        for (let i = 0; i < totalFiles; i++) {
            formData.append("file" + i, this.files[i]);
        }
        formData.append("totalFiles", totalFiles);

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.errors.length > 0) {
                for (let i = 0; i < data.errors.length; i++) {
                    toastr.error(data.errors[i]);
                }
            }
            if (data.response.length > 0) {
                $("#empty-album").css("display", "none");
                for (let i = 0; i < data.response.length; i++) {
                    let content = '<div class="wrap-image">';
                    content += `<img src="${data.response[i]["path"]}" >`;
                    content += `<i class="fal fa-trash-alt" onclick="deleteImageAjax($(this).parent('div'), '${data.response[i]['uri']}')"></i>`;
                    content += "</div>";
                    $(".wrap-album").append(content);
                    let message = data.response[i]["name"] + " uploaded successfully";
                    toastr.success(message);
                }
            }
        });
    });
});
