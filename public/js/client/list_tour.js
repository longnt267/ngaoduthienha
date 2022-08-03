// Xu li ranger slider
window.onload = function () {
    slideOne();
    slideTwo();
    postionTooltip();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.value = `${sliderOne.value}`;
    fillColor();
    postionTooltip();
}
function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.value = `${sliderTwo.value}`;
    fillColor();
    postionTooltip();
}
function fillColor() {
    percent1 = (sliderOne.value / sliderMaxValue) * 100;
    percent2 = (sliderTwo.value / sliderMaxValue) * 100;
    sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #FF7B42 ${percent1}% , #FF7B42 ${percent2}%, #dadae5 ${percent2}%)`;
}
function postionTooltip() {
    let subtractValue = sliderTwo.value - sliderOne.value;
    subtractValue > 0 && subtractValue <= 300
        ? (displayValTwo.style.bottom = 0)
        : (displayValTwo.style.bottom = "55px");
    subtractValue == 0
        ? (displayValTwo.style.display = "none")
        : (displayValTwo.style.display = "block");
    value1 = Math.floor((sliderOne.value / sliderMaxValue) * 100);
    value2 = Math.floor(100 - (sliderTwo.value / sliderMaxValue) * 100);
    percent1 = `calc(${value1}% - 25px)`;
    percent2 = `calc(${value2}% - 20px)`;
    displayValOne.style.left = percent1;
    displayValTwo.style.right = percent2;
}
document.addEventListener("DOMContentLoaded", function () {
    // Xu li filter
    var btnFilter = document.getElementsByClassName("btn-filter");
    var boardFilter = document.getElementsByClassName("wrap-filter");
    btnFilter[0].onclick = function () {
        boardFilter[0].classList.toggle("hidden");
        boardFilter[0].style.transition = "1s";
    };

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
});

// handling pass parameter input to url
// input checkbox duration
var chkDuration = $("#duration");
var durationRequest = $("#duration-filter-group").data("duration-request");
var duration = durationRequest == "none" ? [] : durationRequest;

if(durationRequest != 'none') {
    chkDuration.attr("checked", "checked");
}
$("#duration-filter-group input[type='checkbox']")
    .each(function () {
        // handling checked
        for (let i = 0; i < durationRequest.length; i++) {
            if (durationRequest[i] == $(this).val()) {
                $(this).attr("checked", "checked");
            }
        }
        // handling update value of checkbox of durations
        $(this).change(function () {
            if (this.checked) {
                duration.push($(this).val());
            } else {
                for (let i = 0; i < duration.length; i++) {
                    if (duration[i] == $(this).val()) {
                        duration.splice(i, 1);
                    }
                }
            }
            if (duration.length > 0) {
                let value = JSON.stringify(duration);
                chkDuration.val(value);
                chkDuration.attr("checked", "checked");
            } else {
                chkDuration.val("");
                chkDuration.attr("checked", false);
            }
        });
    });

// input checkbox type of tour
var chkTypeTour = $("#type_tour");
var typeRequest = $("#type-filter-group").data("type-request");
var typeTour = typeRequest == "none" ? [] : typeRequest;

if(typeRequest != 'none') {
    chkTypeTour.attr("checked", "checked");
}    
$("#type-filter-group input[type='checkbox']")
    .each(function () {
        // handling checked
        for (let i = 0; i < typeRequest.length; i++) {
            if (typeRequest[i] == $(this).val()) {
                $(this).attr("checked", "checked");
            }
        }
        // handling update value of checkbox of durations
        $(this).change(function () {
            if (this.checked) {
                typeTour.push($(this).val());
            } else {
                for (let i = 0; i < typeTour.length; i++) {
                    if (typeTour[i] == $(this).val()) {
                        typeTour.splice(i, 1);
                    }
                }
            }
            if (typeTour.length > 0) {
                let value = JSON.stringify(typeTour);
                chkTypeTour.val(value);
                chkTypeTour.attr("checked", "checked");
            } else {
                chkTypeTour.val("");
                chkTypeTour.attr("checked", false);
            }
        });
    });