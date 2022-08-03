$(window).on('load', function() {
    $(document).ready(function() {
        $('#slide-1').owlCarousel({
            items: 1,
            margin: 30,
            loop: false,
            dots: false,
            nav: true,
            navText: ['<div class="nav-prev"><img src="assets/icons/outline/arrow-left.svg" alt=""></div>','<div class="nav-next"><img src="assets/icons/outline/arrow-right.svg" alt=""></div>'],
            responsiveClass:true,
            responsiveBaseElement: 'body',
            responsive: {
               0: {
                   items: 1,
                   nav: false,
                   dots: true,
               },
               580: {
                   items: 3,
                   nav: false,
                   dots: true,
               },
               1200: {
                   items: 4
               }
            }
        });
    
        $('.sl-t2').owlCarousel({
            items: 3,
            margin: 30,
            loop: false,
            dots: false,
            nav: true,
            navText: ['<div class="nav-prev"><img src="assets/icons/outline/arrow-left.svg" alt=""></div>','<div class="nav-next"><img src="assets/icons/outline/arrow-right.svg" alt=""></div>'],
        });
    
        // btn menu
        var btnMenu = document.getElementsByClassName('btn-menu');
        var btnClose = document.getElementsByClassName('btn-close');
        var menu = document.getElementsByClassName('menu-responsive');
        btnMenu[0].onclick = function() {
            menu[0].style.left = '0';
        }
    
        btnClose[0].onclick = function() {
            menu[0].style.left = '-100%';
           
        }
    
    });
})