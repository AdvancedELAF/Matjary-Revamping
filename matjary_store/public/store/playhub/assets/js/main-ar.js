$(document).ready(function () {

    /* SHORTLIST ICON STARTS*/
    // $(".wishlist i").click(function () {
    //     $(".wishlist i,span").toggleClass("press", 1000);
    // });
    /* SHORTLIST ICON ENDS */
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.all-category-nav').length) {
            $(".all-category-list").hide(); // Hide the menus.
        }
        else {
            $(".all-category-list").show();
        }
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('.account-login').length) {
            $(".login-list").hide(); // Hide the menus.
        }
        else {
            $(".login-list").show();
        }
    });

    $('#latest-products-carousel').owlCarousel({
        rtl: true,
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

    $('#featured-products-carousel').owlCarousel({
        rtl: true,
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

    $('#category-carousel-one').owlCarousel({
        rtl: true,
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

    $('#category-carousel-two').owlCarousel({
        rtl: true,
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

    $('#category-carousel-three').owlCarousel({
        rtl: true,
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

    $('#offers-products-carousel').owlCarousel({
        autoplay: true,
        loop: false,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })

    $(".cat-tab-item").click(function () {
        let carouselid = $(this).data('carouselid');
        $('#category-carousel-' + carouselid).owlCarousel({
            autoplay: true,
            loop: false,
            margin: 10,
            nav: true,
            rtl: rtl,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    });

    $('#pos-products-carousel').owlCarousel({
        rtl: true,
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

    $('#gift-card-carousel').owlCarousel({
        rtl: true,
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

    $('#category-products-carousel').owlCarousel({
        rtl: true,
        autoplay: true,
        loop: false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })

    // GIFT CARD ON CLICK (PAYMENT PAGE)

    $("#giftCardOption").click(function () {
        $(".giftCardInput").css({ "display": "block" });
    });

    /* Allow Only Number Validation */
    $('.numberonly').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });

    /* Flat Number Only Validation */
    $('.floatNumberOnly').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9-.]/g))
            return false;
    });

    $('#cancel_reason').on('change', function () {
        if (this.value == "Any Other Reason") {
            $("#otherReason").show();
        } else {
            $("#otherReason").hide();
        }
    });

    $('#brand-carousel').owlCarousel({
        autoplay: true,
        loop: false,
        margin: 10,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })

    $("#languageChange").click(function () {
        let action_page = $(this).data('actionurl');
        let lang = $(this).data('lang');
        let requestData = { lang: lang };
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: action_page,
            beforeSend: function () {
                swal({
                    title: "",
                text: (lang == "en") ? "معالجة..." : "Processing...",
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                    showConfirmButton: false
                });
            },
            success: function (resp) {  /* A function to be called if request succeeds */
                respData = JSON.parse(resp);
                window.location.reload();
            }
        });
    });
});