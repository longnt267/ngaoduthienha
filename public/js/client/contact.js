$(document).ready(function() {
    // responsive menu
    var btnMenu = $('.btn-menu');
    var btnClose = $('.logo i');
    var menu = $('.menu-responsive');
    btnMenu.on('click', function() {
        menu.css('left', 0);
    })

    btnClose.on('click', function() {
        menu.css('left', '-100%');
    })
})

// store contact by ajax
function storeContact(url) {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            name : $('#name').val(),
            email : $('#email').val(),
            phone : $('#phone').val(),
            message : $('#message').val()
        }
    }).done(function() {
        console.log('success');
    }).fail(function(response) {
        let errorName = $('#feedback-name');
        let errorEmail = $('#feedback-email');
        let errorPhone = $('#feedback-phone');
        let errorMessage = $('#feedback-message');
        showError(errorName, response.responseJSON.errors.name);
        showError(errorEmail, response.responseJSON.errors.email);
        showError(errorPhone, response.responseJSON.errors.phone);
        showError(errorMessage, response.responseJSON.errors.message);
    })
}

function showError(element, data) {
    if(data !== 'undefined') {
        if(data.length > 0) {
            element.children().remove();
            let content = `<strong>${data[0]}</strong>`;
            element.append(content);
        }
    }
}