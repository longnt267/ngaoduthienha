// This is file which provide all logic function for whole website.
function ChangeToSlug(str) {
    str = str.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    str = str.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
    str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
    str = str.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
    str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
    str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
    str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
    str = str.replace(/đ/gi, "d");
    //Xóa các ký tự đặt biệt
    str = str.replace(
        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
        ""
    );
    //Đổi khoảng trắng thành ký tự gạch ngang
    str = str.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    str = str.replace(/\-\-\-\-\-/gi, "-");
    str = str.replace(/\-\-\-\-/gi, "-");
    str = str.replace(/\-\-\-/gi, "-");
    str = str.replace(/\-\-/gi, "-");
    //Xóa các ký tự gạch ngang ở đầu và cuối
    str = "@" + str + "@";
    str = str.replace(/\@\-|\-\@|\@/gi, "");
    //In slug ra textbox có id “slug”
    return str;
}

// Get slug of inputTyping's value to inputSlug
function renderSlugInput(inputTyping, inputSlug) {
    inputTyping.on("keyup", function () {
        if (inputTyping.val() != null) {
            let slug = ChangeToSlug(inputTyping.val());
            inputSlug.val(slug);
        }
    });
}

// Change status ajax request
function changeStatusAjax(url, status) {
    $.ajax({
        url: url,
        type: "POST",
        data: {
            status: status,
        },
    })
        .done(function () {
            toastr.success("Status changed successfully");
        })
        .fail(function () {
            toastr.error("Status changed failed");
        });
}

function changeStatusPayment(id, url) {
    $.ajax({
        url: url,
        type: "POST",
        data: {
            status: 2,
        },
    })
        .done(function () {
            toastr.success("Status of payment changed successfully");
            $("#datatable").DataTable().draw();
        })
        .fail(function () {
            toastr.error("Status of payment changed failed");
        });
}

function confirmDelete(url) {
    Swal.fire({
        title: "Do you want delete this item ?",
        icon: "warning",
        target: document.getElementById("main-wrapper"),
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteAjax(url);
        }
    });
}

// Delete ajax request
function deleteAjax(url) {
    $.ajax({
        url: url,
        type: "DELETE",
    })
        .done(function () {
            toastr.success("Delete successfully");
            $("#datatable").DataTable().draw();
        })
        .fail(function (response) {
            let error = response.responseJSON.message;
            if (error.indexOf("SQLSTATE[23000]") == 0) {
                toastr.error("Can't be delete because there are active tours");
            } else {
                toastr.error("Delete failed");
            }
        });
}

function uploadImage() {
    $(".image-box").click(function (event) {
        var previewImg = $(this).children("img");

        $(this).siblings().children("input").trigger("click");

        $(this)
            .siblings()
            .children("input")
            .change(function () {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var urll = e.target.result;
                    $(previewImg).attr("src", urll);
                    previewImg.parent().css("background", "transparent");
                    previewImg.show();
                    previewImg.siblings("p").hide();
                };
                reader.readAsDataURL(this.files[0]);
                $(".image-box").css("border", "none");
            });
    });
}
