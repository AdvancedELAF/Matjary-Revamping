$(document).ready(function () {

    /* HEADER SCROLL CODE */
    $(window).scroll(function () {
        var sticky = $("header"),
            scroll = $(window).scrollTop();
        if (scroll >= 10) {
            sticky.addClass("bg-white");
        } else {
            sticky.removeClass("bg-white");
        }
    });

    $('#latest-product-carousel').owlCarousel({
        loop:false,
        margin:20,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

    $('#featured-product-carousel').owlCarousel({
        loop:false,
        margin:20,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

    $('#pos-product-carousel').owlCarousel({
        loop:false,
        margin:20,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

    $('#gift-card-carousel').owlCarousel({
        loop:false,
        margin:20,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })

    $('.category-carousel').owlCarousel({
        autoplay: true,
        loop: false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    // GIFT CARD ON CLICK (PAYMENT PAGE)

    $("#giftCardOption").click(function () {
        $(".giftCardInput").css({"display":"block"});
    });

});


