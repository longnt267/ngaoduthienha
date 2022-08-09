$(document).ready(function () {
    var bigimage = $("#parent-glr");
    var thumbs = $("#child-glr");
    //var totalslides = 10;
    var syncedSecondary = true;

    bigimage
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<i class="far fa-chevron-left"></i>',
                '<i class="far fa-chevron-right"></i>',
            ],
        })
        .on("changed.owl.carousel", syncPosition);

    thumbs
        .on("initialized.owl.carousel", function () {
            thumbs.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: 4,
            margin: 29,
            dots: false,
            nav: false,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: 4,
            responsiveRefreshRate: 100,
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if loop is set to false, then you have to uncomment the next line
        //var current = el.item.index;

        //to disable loop, comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = thumbs.find(".owl-item.active").length - 1;
        var start = thumbs.find(".owl-item.active").first().index();
        var end = thumbs.find(".owl-item.active").last().index();

        if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
        }
    }

    thumbs.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bigimage.data("owl.carousel").to(number, 300, true);
    });
    // end thumb carousel

    // handler collapse
    var collapToggle = $(".collap-toggle");
    for (let i = 0; i < collapToggle.length; i++) {
        collapToggle.eq(i).on("click", function () {
            var collapContent = collapToggle.eq(i).next();
            var arrowSrc = collapToggle.eq(i).children("img");
            collapContent.toggleClass("display");
            if (collapContent.hasClass("display")) {
                arrowSrc.attr("src", "../../assets/icons/outline/arrow-bot.png");
            } else {
                arrowSrc.attr("src", "../../assets/icons/outline/arrow-top.png");
            }
        });
    }

    // handler button description, addtional-info, reviews
    var btnDescript = $(".btn-descript");
    var btnAddtional = $(".btn-addtional");
    var btnReview = $(".btn-review");
    var panelDescript = $("#description");
    var panelAddtional = $("#addtional-info");
    var panelReview = $("#review");

    btnDescript.on("click", function () {
        panelDescript.removeClass("display");
        panelAddtional.addClass("display");
        panelReview.addClass("display");
        btnDescript.addClass("orange");
        btnAddtional.removeClass("orange");
        btnReview.removeClass("orange");
    });

    btnAddtional.on("click", function () {
        panelDescript.addClass("display");
        panelAddtional.removeClass("display");
        panelReview.addClass("display");
        btnDescript.removeClass("orange");
        btnAddtional.addClass("orange");
        btnReview.removeClass("orange");
    });

    btnReview.on("click", function () {
        panelDescript.addClass("display");
        panelAddtional.addClass("display");
        panelReview.removeClass("display");
        btnDescript.removeClass("orange");
        btnAddtional.removeClass("orange");
        btnReview.addClass("orange");
    });

    // handler rating star
    var allStar = $(".rating-star").children("i");
    // setup default star
    getColorStar("#FFB612", 3);
    for (let i = 0; i < 5; i++) {
        var star = allStar.eq(i);
        star.on("click", function () {
            getColorStar("#C4C4C4", 5);
            getColorStar("#FFB612", i);
            $('input[name="star"]').attr("value", i + 1);
            console.log($("#input-star").val());
        });
    }

    function getColorStar(color, number) {
        for (let i = 0; i <= number; i++) {
            allStar.eq(i).css("color", color);
        }
    }

    // handling crossbar
    for(let i = 0; i <= 5; i++) {
      element = $(`#crossbar-${i+1}`)
      rating = element.data("rating")
      processCrossbar(element, rating)
    }
    function processCrossbar(element, rating) {
      let allRating = $('.review-cross').data('rating-all')
      let value = (rating/allRating)*100;
      element.css('width', `${value}%`)
    }

    // responsive menu
    var btnMenu = $(".btn-menu");
    var btnClose = $(".logo i");
    var menu = $(".menu-responsive");
    btnMenu.on("click", function () {
        menu.css("left", 0);
    });

    btnClose.on("click", function () {
        menu.css("left", "-100%");
    });

    let dates_json = $('#dates_json').val();
    let dates_array = JSON.parse(dates_json);
    
    $('#start-date').flatpickr({
        enable: dates_array,
        defaultDate: dates_array[0],
        minDate: new Date()
    });

    $("#end-date").datepicker({ dateFormat: "yy-mm-dd" });
    var currentDay = new Date();
    var duration = parseInt($("#duration").val());
    
    $("#end-date").datepicker(
        "setDate",
        calcEndDate(currentDay, duration)
    );
    // handling when date picker changed
    $("#start-date").on('change', function () {
        let dateStart = new Date(`${$("#start-date").val()}`);
        let dateEnd = calcEndDate(dateStart, duration);
        $("#end-date").datepicker("setDate", dateEnd);
    });

    function calcEndDate(start, duration) {
        let dateEnd = new Date();
        dateEnd.setDate(start.getDate() + duration);
        return dateEnd;
    }

    // handling ajax submit form - info booking
    var url = $("#booking-form").data("url");
    var redirect = $("#booking-form").data("redirect");
    var data = {
        duration: $("#duration").val(),
        number_people: 1,
        total_price: $("#number_people").data("price"),
        tour_id: $("#tour_id").val(),
        type_tour: $("#type_tour").val(),
        destination: $("#destination").val(),
    };
    $("#number_people").change(function () {
        let totalPrice = $(this).data("price") * $(this).val();
        totalPrice = new Intl.NumberFormat('en-US', {minimumIntegerDigits: 2, useGrouping:false}).format(totalPrice);
        $("#total").text(`${totalPrice}`);
        data.number_people = $(this).val();
        data.total_price = totalPrice;
    });

    $("#btn-submit").click(function () {
        data.departure_date = $("#start-date").val();
        data.end_date = $("#end-date").val();
        if ($('#max_people').val() >= $("#number_people").val()) {
            saveBooking(url, data, redirect);
        }
    });
});

function saveBooking(url, data, redirect) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        method: "POST",
        url: url,
        data: data,
    }).done(function () {
        window.location.href = `${redirect}`;
    });
}

// handling ajax submit form - review
$("#review-submit").click(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        method: "POST",
        url: $("#form-review").data("action"),
        data: {
            star: $("#input-star").val(),
            comment: $("#input-comment").val(),
        },
    }).done(function (data) {
        $(".wrap-comment").html(data);
    });
});

