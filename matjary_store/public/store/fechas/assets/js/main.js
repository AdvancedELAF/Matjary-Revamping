$(document).ready(function () {

    /* SHORTLIST ICON STARTS*/
    // $(".wishlist i").click(function () {
    //     $(".wishlist i,span").toggleClass("press", 1000);
    // });
    /* SHORTLIST ICON ENDS */

    $(document).on('click', function (event) {
        
        if(!$(event.target).closest('.list-group').length) {
            $(".list-group").hide(); // Hide the menus.
        }

    });

    /* CATEGORY DROPDOWN STARTS */

    $(".all-category-nav").hover(function () {
        $(".all-category-list").toggleClass("d-block");
        $(".close-bar").toggleClass("d-block");
        $(".menu-arrow").toggleClass("d-none");
    });

    $(".close-bar").click(function () {
        $(".all-category-list").removeClass("d-block");
        $(".close-bar").removeClass("d-block");
        $(".menu-arrow").removeClass("d-none");
    });

    /* CATEGORY DROPDOWN ENDS */
    /* LOGIN DROPDOWN STARTS */

    $(".account-login").hover(function () {
        $(".login-list").toggleClass("d-block");
    });

    /* LOGIN DROPDOWN ENDS */

    // $(document).on('click', function (event) {
    //     if (!$(event.target).closest('.account-login').length) {
    //         $(".login-list").hide(); // Hide the menus.
    //     }
    //     else {
    //         $(".login-list").show();
    //     }
    // });

    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/Matjary-Revamping/matjary_store';        
    }else{
        base_url;
    }
    let lang = $('#languageChange').data('lang');
    let rtl = '';
    if(lang=='en'){
        rtl = true;
    }else if(lang=='ar'){
        rtl = false;
    }

    $('#latest-products-carousel').owlCarousel({
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


    $('#featured-products-carousel').owlCarousel({
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

    $('#category-carousel-0').owlCarousel({
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

    $('#gift-card-carousel').owlCarousel({
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
        $(".giftCardInput").css({"display":"block"});
    });

    /* prevent onpaste event on input */
    var preventPasteInputs = document.querySelectorAll('.numberonly');
    for (var i = 0; i < preventPasteInputs.length; i++) {
        preventPasteInputs[i].addEventListener('paste', function(e) {
            e.preventDefault();
        });
    }
    
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
        if(this.value == "Any Other Reason"){
            $("#otherReason").show();
        } else {
            $("#otherReason").hide();
        }
    });

    $("#languageChange").click(function () {
        let action_page = $(this).data('actionurl');
        let lang = $(this).data('lang');
        let requestData = {lang:lang};
        $.ajax
        ({
            type: "POST",
            data: requestData,
            url: action_page,
            beforeSend: function() {
                swal({
                    title: "",
                    text: (lang == "en") ? "معالجة..." : "Processing...",
                    imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                    showConfirmButton: false
                });
            },
            success: function(resp){  /* A function to be called if request succeeds */
                respData = JSON.parse(resp);
                window.location.reload();
            }
        });
    });

});

/*Cookie Consent start */
$(document).ready(function () {
    const cookieBox = document.querySelector("#CookieConsentBox"),
    acceptBtn = cookieBox.querySelector("#acceptCookie");
    declineBtn = cookieBox.querySelector("#declineCookie");
    acceptBtn.onclick = ()=>{
      /* setting cookie for 1 month, after one month it'll be expired automatically */
      document.cookie = "CookieBy=Matjary Store; max-age="+60*60*24*30;
      if(document.cookie){ /* if cookie is set */
        cookieBox.classList.add("hide"); /* hide cookie box */
        $('#CookieConsentBox').hide();
      }else{ /* if cookie not set then alert an error */
        alert((lang == "en") ?"لا يمكن تعيين ملف تعريف الارتباط! يرجى إلغاء حظر هذا الموقع من إعداد ملفات تعريف الارتباط في متصفحك.":"Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
      }
    }

    declineBtn.onclick = ()=>{
        /* setting cookie for 1 month, after one month it'll be expired automatically */
        document.cookie = "CookieBy=; max-age="+60*60*24*30;
        if(document.cookie){ /* if cookie is set */
          cookieBox.classList.add("hide"); /* hide cookie box */
          $('#CookieConsentBox').hide();
        }else{ /* if cookie not set then alert an error */
          alert((lang == "en") ?"لا يمكن رفض ملف تعريف الارتباط! يرجى إلغاء حظر هذا الموقع من إعداد ملفات تعريف الارتباط في متصفحك.":"Cookie can't be declined! Please unblock this site from the cookie setting of your browser.");
        }
    }
});

$(window).on('load', function() {
    let checkCookie = document.cookie.indexOf("CookieBy=Matjary Store"); /* checking our cookie */
    /* if cookie is set then hide the cookie box else show it */
    let cookieLength = document.cookie.indexOf("CookieBy") >= 0;
    if(checkCookie == -1){
        if(cookieLength==true){
            $('#CookieConsentBox').hide();
        }else{
            $('#CookieConsentBox').show();
        }
    }else{
        $('#CookieConsentBox').hide();
    }
});
/*Cookie Consent end */


