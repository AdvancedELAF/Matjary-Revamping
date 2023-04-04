$(document).ready(function () {
    /* SHORTLIST ICON STARTS*/
    // $(".wishlist i").click(function () {
    //     $(".wishlist i,span").toggleClass("press", 1000);
    // });
    /* SHORTLIST ICON ENDS */

    /* BRANDS PARTNER CAROUSEL STARTS */

    $('#brand-partners-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
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

    /* BRANDS PARTNER CAROUSEL ENDS */

    // GIFT CARD ON CLICK (PAYMENT PAGE)

    $("#giftCardOption").click(function () {
        $(".giftCardInput").css({"display":"block"});
    });
});