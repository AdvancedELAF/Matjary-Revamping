/*
 Theme Name: Nominee
 Author: TrendyTheme
 */

/* ======= TABLE OF CONTENTS ================================== 
 
 # Preloader
 # jQuery for page scrolling feature - requires jQuery Easing plugin
 # Sticky Menu
 # superslides
 # Enable bootstrap tooltip
 # Textrotator
 # Counter
 # Social Counter
 # Twitter Feed Carousel
 # Magnific Popup for image
 # Magnific Popup for embeds
 # Social share popup window
 # Issue carousel
 # Nominee Carousel
 # Nominee carousel height control
 # Latest post carousel
 # Testimonial Carousel
 # Archivement Carousel
 # Team Carousel
 # Client Carousel
 # Countdown
 # Detect IE version
 # Back to Top
 # Google Map
 # Shuffle for reformation filter
 # Masonry Grid
 # Placeholder
 # Ticker
 # Flickr photo
 # Donate amount select
 # Gallery
 # Newsletter popup
 # Login register form
 
 ========================================================= */

jQuery(function ($) {
    'use strict';

    /* === Preloader === */
    (function () {
        var $preloader = $('#preloader');
        if (!$preloader.length) {
            return;
        }
        $(window).on('beforeunload', function () {
            $preloader.fadeIn('slow');
        });
        $preloader.fadeOut(800);
    }());


    /* === Add Remove Class === */
    (function () {
        $('.comment-respond .comment-form input[type="text"], .comment-respond .comment-form input[type="url"], .comment-respond .comment-form input[type="email"], .comment-respond .comment-form textarea, .charitable-donation-form input, .charitable-donation-form select').addClass('form-control');
    }());

    /* === jQuery for page scrolling feature - requires jQuery Easing plugin === */
    (function () {

        $('.navbar-nav a[href^="#"], .tt-scroll').on('click', function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);
            var headerHeight = $('.navbar, .navbar.sticky').outerHeight();

            if (target) {
                $('html, body').stop().animate({
                    'scrollTop': $target.offset().top - headerHeight + "px"
                }, 1200, function () {
                    window.location.hash = target;
                });
            }
        });
    }());

    /* === Mobile Dropdown Menu === */
    (function () {
        $('.dropdown-menu-trigger').each(function () {
            $(this).on('click', function (e) {
                $(this).toggleClass('menu-collapsed');
            });
        });
    }());

    /* === Toogle sidebar === */
    (function () {
        $('.tt-toggle-button > button').on('click', function (e) {
            $('body').toggleClass('tt-sidebar-open');
        });
        $('.tt-offcanvas-sidebar .offcanvas-overlay, .offcanvas-container .tt-close').on('click', function (e) {
            $('body').removeClass('tt-sidebar-open');
        });
    }());

    /* === Sticky Menu === */
    (function () {
        var nav = $('.header-transparent .navbar, .header-style-box-style .header-wrapper, .header-default .header-wrapper, .header-style-fullwidth .header-wrapper, .header-style-center-logo .header-wrapper');
        var scrolled = false;

        var headerHeight = $('.header-wrapper').outerHeight();

        $(window).scroll(function () {
            if (150 < $(window).scrollTop() && !scrolled) {

                $('.site-wrapper').css('padding-top', headerHeight + "px");

                nav.addClass('sticky animated fadeInDown').animate({'margin-top': '0px'});
                scrolled = true;
            }

            if (20 > $(window).scrollTop() && scrolled) {

                $('.site-wrapper').css('padding-top', '0');

                nav.removeClass('sticky animated fadeInDown').animate('margin-top', '0px');
                scrolled = false;
            }
        });
    }());


    /* ======= superslides ======= */
    if ($('#slides').length > 0) {
        $('#slides').superslides({
            play: 7000,
            animation: 'fade'
        });
    }

    /* ======= Enable bootstrap tooltip ======= */
    (function () {
        $('[data-toggle="tooltip"]').tooltip()
    }());

    /* ======= Textrotator ======= */
    var ttAnimation = $('.rotate').attr('data-animation');
    var ttAniSpeed = $('.rotate').attr('data-speed');

    $(".rotate").textrotator({
        animation: ttAnimation, // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
        separator: "|", //  You can define a new separator (|, &, * etc.) by yourself using this field.
        speed: ttAniSpeed // How many milliseconds until the next word show.
    });

    /* === Counter === */
    $('.fact-wrap, .tt-fundraise-wrapper').on('inview', function (event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.timer').each(function () {
                var $this = $(this);
                $({Counter: 0}).animate({Counter: $this.text()}, {
                    duration: 2000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).off('inview');
        }
    });

    /* === Social Counter === */
    $('.social-counter').on('inview', function (event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.count').each(function () {
                var $this = $(this);
                $({Counter: 0}).animate({Counter: $this.text()}, {
                    duration: 2000,
                    easing: 'swing',
                    step: function () {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).off('inview');
        }
    });

    /* === Twitter Feed Carousel === */

    (function () {
        var twitterFeed = $('.twitterfeed').attr('data-twitter-id');
        var ttMaxTweet = $('.twitterfeed').attr('data-max-tweet');
        var feedConfig = {
            "profile": {"screenName": twitterFeed},
            "domId": 'twitterfeed',
            "maxTweets": ttMaxTweet,
            "enableLinks": true,
            "showUser": false,
            "showTime": true,
            "showImages": false,
            "showRetweet": false,
            "showInteraction": false,
            "lang": 'en',
            "customCallback": carouselTweets
        };
        twitterFetcher.fetch(feedConfig);

        function carouselTweets(tweets) {
            var x = tweets.length;
            var n = 0;
            var html = "";
            while (n < x) {
                html += '<div class="item">' + tweets[n] +
                        "</div>";
                n++
            }
            $(".twitter-carousel").html(html);
            $(".twitter_retweet_icon").html(
                    '<i class="fa fa-retweet"></i>');
            $(".twitter_reply_icon").html(
                    '<i class="fa fa-reply"></i>');
            $(".twitter_fav_icon").html(
                    '<i class="fa fa-star"></i>');
            $(".twitter-carousel").owlCarousel({
                dots: true,
                items: 1,
                loop: true,
                autoplayHoverPause: true,
                autoplay: true
            });
        }
    }());

    /* === Twitter Feed === */
    (function () {

        var ttTwitterID = $('.spokesman-tweet').attr('data-twitter-id');
        var ttMaxTweet = $('.spokesman-tweet').attr('data-max-tweet');
        var ttConfig = {
            "profile": {"screenName": ttTwitterID},
            "domId": 'twitterfeed',
            "maxTweets": ttMaxTweet,
            "enableLinks": true,
            "showUser": true,
            "showTime": true,
            "showImages": false,
            "showRetweet": false,
            "showInteraction": false,
            "lang": 'en',
            customCallback: ttHandleTweets
        };

        function ttHandleTweets(tweets) {
            var x = tweets.length;
            var n = 0;
            var html = "";
            while (n < x) {
                html += '<div class="item">' + tweets[n] +
                        "</div>";
                n++
            }
            $(".tt-tweets").html(html);
        }
        twitterFetcher.fetch(ttConfig);

    }());


    /* ======= Magnific Popup ======= */
    $(window).load(function () {
        $(".image-link").magnificPopup({
            type: 'image',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            fixedContentPos: false,
            gallery: {
                enabled: true
            }
        });
    });


    /* ======= Magnific Popup for product image ======= */
    $(window).load(function () {
        $(".woocommerce-product-gallery__image > a, .widget .gallery-item a").magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            gallery: {
                enabled: true
            },
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function (element) {
                    return element.find('img');
                }
            },
            removalDelay: 300, // Delay in milliseconds before popup is removed
            mainClass: 'mfp-no-margins mfp-with-zoom', // this class is for CSS animation below

        });
    });


    /* ======= Magnific Popup for embeds ======= */
    $('.tt-popup').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: true,
        fixedContentPos: false
    });

    /* ======= Social share popup window ======= */
    (function () {
        $('.post-share ul li a').on('click', function () {
            var newwindow = window.open($(this).attr('href'), '', 'height=450,width=700');
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        });
    }());

    /* ======= Issue carousel ======= */
    (function () {
        if ($('.tt-issue-wrapper').length > 0) {
            $('.tt-issue-wrapper').each(function () {
                var issueNav = $(this).find('.issue-carousel').attr('data-issue-nav');
                var issueAutoPlay = $(this).find('.issue-carousel').attr('data-issue-play');

                var isDot = false;
                var isNav = false;

                if (issueNav == 'dots') {
                    isDot = true;
                }
                if (issueNav == 'nav') {
                    isNav = true;
                }

                $('.issue-carousel').owlCarousel({
                    autoplay: issueAutoPlay,
                    autoplayTimeout: 5000,
                    loop: true,
                    margin: 30,
                    items: 3,
                    autoplayHoverPause: true,
                    dots: isDot,
                    nav: isNav,
                    navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        900: {
                            items: 3
                        }
                    }
                });
            });
        }
    }());

    /* ======= Nominee Carousel ======= */
    (function () {
        if ($('.tt-carousel').length > 0) {
            var nomineeRtl = false,
                    navigation = $('.tt-carousel').attr('data-navigation'),
                    pagination = $('.tt-carousel').attr('data-pagination'),
                    noineeLoop = $('.tt-carousel').attr('data-loop'),
                    autoplay = $('.tt-carousel').attr('data-autoplay'),
                    autoplayTimeout = $('.tt-carousel').attr('data-autoplaytimeout'),
                    mouseDrag = $('.tt-carousel').attr('data-mousedrag');

            if (nomineeJSObject.rtl == true) {
                nomineeRtl = true;
            }

            if (navigation == 'visible' ? navigation = true : navigation = false)
                ;
            if (pagination == 'visible' ? pagination = true : pagination = false)
                ;
            if (noineeLoop == 'enable' ? noineeLoop = true : noineeLoop = false)
                ;
            if (mouseDrag == 'enable' ? mouseDrag = true : mouseDrag = false)
                ;
            if (autoplay == 'enable' ? autoplay = true : autoplay = false)
                ;
            if (autoplayTimeout ? autoplayTimeout : autoplayTimeout = 5000)
                ;

            var nomineeOwl = $('.tt-carousel').owlCarousel({
                items: 1,
                autoplay: autoplay,
                autoplayTimeout: autoplayTimeout,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                navSpeed: 800,
                dotsSpeed: 800,
                loop: noineeLoop,
                mouseDrag: mouseDrag,
                touchDrag: true,
                nav: navigation,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                dots: pagination,
                rtl: nomineeRtl
            });

            /* // add animate.css class(es) to the elements to be animated */
            function setAnimation(_elem, _InOut) {
                /*
                 // Store all animationend event name in a string.
                 // cf animate.css documentation
                 */
                var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                _elem.each(function () {
                    var $elem = $(this);
                    var $animationType = 'animated ' + $elem.data('animation-' + _InOut);

                    $elem.addClass($animationType).one(animationEndEvent, function () {
                        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                    });
                });
            }

            /* // Fired after current slide has been changed */
            nomineeOwl.on('changed.owl.carousel', function (event) {

                var $currentItem = $('.owl-item', nomineeOwl).eq(event.item.index);
                var $elemsToanim = $currentItem.find("[data-animation-in]");
                setAnimation($elemsToanim, 'in');
            });
        }
    }());


    /* ======= Nominee carousel height control ======= */
    (function () {
        if ($('.tt-carousel').length > 0) {
            var carouselWrapper = $('.tt-carousel');
            var carouselItem = $('.tt-carousel .item');

            var largeHeight = carouselWrapper.attr('data-lg-height'),
                    mediumHeight = carouselWrapper.attr('data-md-height'),
                    smallHeight = carouselWrapper.attr('data-sm-height'),
                    mobileHeight = carouselWrapper.attr('data-xs-height'),
                    mobileSmallHeight = carouselWrapper.attr('data-xxs-height');

            $(window).on('resize load', function (e) {
                if (carouselWrapper.innerWidth() > 1400) {
                    carouselItem.css('height', largeHeight);
                } else if (carouselWrapper.innerWidth() > 991 && carouselWrapper.innerWidth() < 1399) {
                    carouselItem.css('height', mediumHeight);
                } else if (carouselWrapper.innerWidth() > 767 && carouselWrapper.innerWidth() < 992) {
                    carouselItem.css('height', smallHeight);
                } else if (carouselWrapper.innerWidth() > 575 && carouselWrapper.innerWidth() < 768) {
                    carouselItem.css('height', mobileHeight);
                } else {
                    carouselItem.css('height', mobileSmallHeight);
                }
            });

            /*// Mouse move animation */
            if ($('.tt-extra-image').length > 0) {
                var lFollowX = 0,
                        lFollowY = 0,
                        x = 0,
                        y = 0,
                        friction = 1 / 20;

                function moveBackground() {
                    x += (lFollowX - x) * friction;
                    y += (lFollowY - y) * friction;

                    var translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

                    $('.tt-carousel .item .tt-extra-image img').css({
                        '-webit-transform': translate,
                        '-moz-transform': translate,
                        'transform': translate
                    });

                    window.requestAnimationFrame(moveBackground);
                }

                $(window).on('mousemove click', function (e) {
                    var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
                    var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
                    lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
                    lFollowY = (10 * lMouseY) / 100;
                });

                moveBackground();
            }
        }
    }());

    /* ======= Latest post carousel ======= */
    (function () {

        $('.latest-post-carousel').owlCarousel({
            autoplay: true,
            loop: true,
            items: 1,
            autoplayHoverPause: true
        })

    }());

    /* ======= Testimonial Carousel ======= */
    (function () {
        $('.testimonial-carousel').owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            loop: true,
            items: 1,
            autoplayHoverPause: true
        })
    }());

    /* ======= Archivement Carousel ======= */
    (function () {
        $('.archivement-carousel').owlCarousel({
            autoplay: true,
            loop: true,
            items: 1,
            autoplayHoverPause: true
        })
    }());

    /* ======= Team Carousel ======= */
    (function () {
        $('.team-carousel').owlCarousel({
            loop: true,
            margin: 30,
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
    }());

    /* ======= Career Carousel ======= */
    (function () {
        if ($('.political-career-wrapper').length > 0) {
            $('.career-carousel').owlCarousel({
                loop: false,
                margin: 15,
                dots: false,
                nav: true,
                items: 4,
                navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        }
    }());

    /* ======= Client Carousel ======= */
    (function () {
        var clientCarousel = $('.client-carousel');
        clientCarousel.hide();
        $(window).on('load', function () {
            clientCarousel.show();
            var itemDesktop = clientCarousel.attr('data-item-desktop');
            var itemTablet = clientCarousel.attr('data-item-tablet');
            var itemMobile = clientCarousel.attr('data-item-mobile');

            clientCarousel.owlCarousel({
                autoplay: true,
                loop: true,
                margin: 30,
                dots: false,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: itemMobile
                    },
                    600: {
                        items: itemTablet
                    },
                    1000: {
                        items: itemDesktop
                    }
                }
            })
        })
    }());

    /* ======= Countdown ======= */
    (function () {
        $('[data-countdown]').each(function () {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime(''
                        + '<li><span class="days">%D<span><p>' + nomineeJSObject.count_day + '</p></li>'
                        + '<li><span class="hours">%H<span><p>' + nomineeJSObject.count_hour + '</p></li>'
                        + '<li><span class="minutes">%M<span><p>' + nomineeJSObject.count_minutes + '</p></li>'
                        + '<li><span class="second">%S<span><p>' + nomineeJSObject.count_second + '</p></li>'
                        ));
            });
        });
    }());


    /* === Detect IE version === */
    (function () {
        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1], 10) : false;
        }

        if (getIEVersion()) {
            $('html').addClass('ie' + getIEVersion());
        }
    }());

    /* === Detect IOS Mobile device === */
    (function () {
        if (navigator.userAgent.match(/iP(hone|od|ad)/i)) {
            jQuery('html').addClass('ios-browser');
        }
    }());

    /* ======= Back to Top ======= */
    (function () {
        $('body').append('<div id="toTop"><i class="fa fa-angle-up"></i></div>');

        $(window).scroll(function () {
            if ($(this).scrollTop() !== 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });

        $('#toTop').on('click', function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });
    }());

    /* ======= Google Map ======= */
    (function () {
        if ($('#ttmap').length > 0) {
            //set your google maps parameters
            var $latitude = $('#ttmap').attr('data-map-latitude'),
                    $longitude = $('#ttmap').attr('data-map-longitude'),
                    $map_zoom = 12;
            /* ZOOM SETTING */

            //google map custom marker icon 
            var $marker_url = $('#ttmap').attr('data-map-marker');

            //we define here the style of the map

            var style = [{
                    stylers: [{
                            "hue": "#000"
                        }, {
                            "saturation": -100
                        }, {
                            "gamma": 2.15
                        }, {
                            "lightness": 12
                        }]
                }];

            //set google map options
            var map_options = {
                center: new google.maps.LatLng($latitude, $longitude),
                zoom: $map_zoom,
                panControl: true,
                zoomControl: true,
                mapTypeControl: false,
                streetViewControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                styles: style
            }
            //initialize the map
            var map = new google.maps.Map(document.getElementById('ttmap'), map_options);
            //add a custom marker to the map                
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng($latitude, $longitude),
                map: map,
                visible: true,
                icon: $marker_url
            });
        }
    }());

    /* === Shuffle for reformation filter  === */
    (function () {
        $(window).on('load', function () {
            $('.reformation-wrap').each(function (i, e) {
                var ttGrid = $(this).find('.tt-grid');
                var self = this;
                ttGrid.shuffle({
                    itemSelector: '.tt-item' // the selector for the items in the grid
                });

                /* reshuffle when user clicks button filter item */
                $(this).find('.tt-filter button').on('click', function (e) {
                    e.preventDefault();

                    // set active class
                    $(self).find('.tt-filter button').removeClass('active');
                    $(this).addClass('active');

                    // get group name from clicked item
                    var ttGroupName = $(this).attr('data-group');

                    // reshuffle grid
                    ttGrid.shuffle('shuffle', ttGroupName);
                });
            });
        });
    }());

    /* === Masonry Grid  === */
    $(window).load(function () {
        $('.masonry-wrap').masonry({
            "columnWidth": ".masonry-column"
        });
    });

    /* === Placeholder  === */
    (function () {
        $('input, textarea, email, number').placeholder();
    }());

    /* === Ticker  === */
    $(window).on('load', function () {
        $('.news-ticker-wrapper').fadeIn();
        if (nomineeJSObject.nominee_news_ticker == true) {
            $('.news-ticker').newsTicker({
                row_height: 40,
                max_rows: 1,
                speed: 600,
                direction: 'up',
                duration: 4000,
                autostart: 1,
                pauseOnHover: 1
            });
        }
    }());

    /* === Flickr photo  === */
    (function () {
        var ttFlickr = $('.tt-flickr-photo');
        ttFlickr.jflickrfeed({
            limit: ttFlickr.attr('data-photo-limit'),
            qstrings: {
                id: ttFlickr.attr('data-flickr-id')
            },
            itemTemplate: '<li>' +
                    '<a href="{{image}}" title="{{title}}">' +
                    '<img src="{{image_s}}" alt="{{title}}" />' +
                    '</a>' +
                    '</li>'
        });
    }());

    /* === Donate amount select === */
    (function () {
        $('input.others-amount').on('focus', function () {
            $(this).closest('.donate-amount').find('.amount-button').removeClass('active');
        });
    }());

    /* === Blank other donate amount === */
    (function () {
        $('.donate-amount .amount-button').on('click', function () {
            $(this).closest('.donate-amount').find('.others-amount').val('');
        });
    }());

    /* === Gallery === */
    $(window).on('load', function () {
        // The slider being synced must be initialized first
        $('.tt-gallery-wrapper').each(function (i, e) {

            var ttGalleryNav = $(this).find('.tt-gallery-nav');
            var ttGalleryThumb = $(this).find('.tt-gallery-thumb');
            var ttGallery = $(this).find('.tt-gallery');

            ttGalleryThumb.flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: true,
                slideshow: false,
                itemWidth: 150,
                asNavFor: ttGallery
            });

            ttGallery.flexslider({
                animation: "slide",
                directionNav: false,
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: ttGalleryThumb
            });

            // Navigation 
            ttGalleryNav.find('.prev').on('click', function (e) {
                ttGallery.flexslider('prev')
                return false;
            });

            ttGalleryNav.find('.next').on('click', function (e) {
                ttGallery.flexslider('next')
                return false;
            });
        });
    }());

    /* === Newsletter popup === */
    if (nomineeJSObject.newsletter_popup && nomineeJSObject.is_front_page) {
        $(window).on('load', function () {
            if (nomineeJSObject.newsletter_popup_limit == 1) {
                if (document.cookie.indexOf('visited=true') == -1) {
                    var fifteenDays = 1000 * 60 * 60 * 24 * 15;
                    var expires = new Date((new Date()).valueOf() + fifteenDays);
                    document.cookie = "visited=true;expires=" + expires.toUTCString();
                    setTimeout(function () {
                        $('.tt-newsletter-popup').modal();
                    }, nomineeJSObject.newsletter_popup_time * 1000);
                }
            } else {
                setTimeout(function () {
                    $('.tt-newsletter-popup').modal();
                }, nomineeJSObject.newsletter_popup_time * 1000);
            }
        });
    }

    // wishlist count update
    (function () {
        var ttWishListCount = function () {
            $.ajax({
                data: {
                    action: 'update_wishlist_count'
                },
                success: function (data) {
                    // console.log( data );
                    $('.tt-wishlist-count span').html(data);
                },

                url: yith_wcwl_l10n.ajax_url
            });
        };

        $('body').on('added_to_wishlist removed_from_wishlist', ttWishListCount);
    }());

    /* === Login register form === */
    (function () {
        $('.toggle').on('click', function () {
            $('.login-wrapper').stop().addClass('active');
        });

        $('.close').on('click', function () {
            $('.login-wrapper').stop().removeClass('active');
        });

        /* // Perform AJAX login/register on form submit */
        $('form#login, form#register').on('submit', function (e) {
            // if (!$(this).valid()) return false;
            $('p.status', this).show().text(nomineeJSObject.loadingmessage);
            var action = 'ajaxlogin';
            var username = $('form#login #username').val();
            var password = $('form#login #password').val();
            var email = '';
            var security = $('form#login #security').val();
            if ($(this).attr('id') == 'register') {
                var action = 'ajaxregister';
                var username = $('#signonname').val();
                var password = $('#signonpassword').val();
                var email = $('#email').val();
                var security = $('#signonsecurity').val();
            }
            var ctrl = $(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: nomineeJSObject.ajaxurl,
                data: {
                    'action': action,
                    'username': username,
                    'password': password,
                    'email': email,
                    'security': security
                },
                success: function (data) {
                    $('p.status', ctrl).text(data.message);
                    if (data.loggedin == true) {
                        document.location.href = nomineeJSObject.redirecturl;
                    }
                }
            });
            e.preventDefault();
        });
    }());

    /* // sidebar sticky */
    (function () {
        $('.sidebar-sticky').ttStickySidebar({
            additionalMarginTop: 0
        });
    }());

    /*// Product by Vendor Form */
    (function () {
        $('.card img').each(function () {
            $(this).on('click', function (e) {
                var product_val = $(this).attr('alt');
                $('#prodBrand').val(product_val);
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#contact-details-form-sep").offset().top
                }, 1000);
                $('#vendor_email').focus();
            });
        });
    }());

    (function () {
        $('#wpcf7-f4885-p5-o3').hide();
        $('.download_ae_broucher_btn').on('click', function (e) {
            e.preventDefault();
            $('.download_ae_broucher_btn').hide();
            if ($('.download_ae_broucher_form').css('display') == 'none') {
                $('.download_ae_broucher_form').show(500);
                return false;
            }
        });
    }());

    /* go to slide 5, for home page */
    /*
     (function () {
     $('.brochure-download-image').on('click', function (e) {
     $("html, body").animate({scrollTop: 0}, "slow");
     $('#carouselExampleIndicators').carousel(4);
     $('#en-carouselIndicators').carousel(4).addClass('active');
     
     e.preventDefault();
     $('.download_ae_broucher_btn').hide();
     if ($('.download_ae_broucher_form').css('display') == 'none') {
     $('.download_ae_broucher_form').show(500);
     return false;
     }
     });
     }());
     */

    /* go to slide 5, from other pages */
    /*
     (function () {
     function getSlideParameter(key) {
     key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
     var match = location.search.match(new RegExp("[?&]" + key + "=([^&]+)(&|$)"));
     var slide = match && decodeURIComponent(match[1].replace(/\+/g, " "));
     if (Math.floor(slide) == slide && $.isNumeric(slide))
     return parseInt(slide);
     else
     return 0;//if 'slide' parameter is not present or doesn't have correct values load 0th slide
     }
     //$('#carouselExampleIndicators').carousel(getSlideParameter('slide'));
     $('#en-carouselIndicators').carousel(getSlideParameter('slide'));
     })();
     */

    /* 	ARABIC URL Alignment */
    (function () {

        var theLanguage = $('html').attr('lang');
        if (theLanguage == 'ar') {

            /* download broucher form in arabic */
            $('#wpcf7-f4885-p5-o1').css({"float": "right"});
            $('#wpcf7-f4885-p5-o1 .wpcf7-form-control wpcf7-submit').css({"float": "right"});
            $('.wpcf7 input[type="url"], .wpcf7 input[type="email"], .wpcf7 input[type="tel"], .awsm-filter-items, a.awsm-job-item, .page-header, header.entry-header, .entry-content').css({"direction": "rtl"});

            $('.wpcf7 .wpcf7-submit').css({"float": "right"});

            $('li#menu-item-4703').css({"left": "2rem", "position": "absolute"});

            $('i.fa.fa-angle-double-right').css({"-moz-transform": "scaleX(-1)", " -o-transform": "scaleX(-1)", "-webkit-transform": "scaleX(-1)", " transform": "scaleX(-1)", "filter": "FlipH", "-ms-filter": "FlipH", "margin": "10px", "float": "right"});

            $('i.fa.fa-phone, i.icofont-support-faq, i.fa.fa-envelope').css({"-moz-transform": "scaleX(-1)", " -o-transform": "scaleX(-1)", "-webkit-transform": "scaleX(-1)", " transform": "scaleX(-1)", "filter": "FlipH", "-ms-filter": "FlipH", "margin-left": "20px", "float": "right"});

            $('i.icofont-rounded-right').css({"-moz-transform": "scaleX(-1)", " -o-transform": "scaleX(-1)", "-webkit-transform": "scaleX(-1)", " transform": "scaleX(-1)", "filter": "FlipH", "-ms-filter": "FlipH", "float": "right"});

            $('.google-logo img, .google-star').css({"display": "inline-flex"});

            $('ul.social_footer_cust, ul.social_footer_cust li, p.comp-sales-underline, .ar-btn-align').css({"float": "right"});

            $('.ar-btn-align-left').css({"float": "left"});

            $('span.about-ae-desc, span.about-our-content, span.title-alignment, span.subcontent, span.comp-sales-icon1-desc, span.maintenance-service-offer-content').css({"text-align": "right", "display": "block", "line-height": "3rem"});

            $('h4.about-our-title, .ar-font-align h1').css({"text-align": "right"});

            $('span.tab-align-adapt, span.tab-view-align, span.comp-sales-cont, span.maintenance-service-desc-one, span.maintenance-service-offer-title, span.network-banner-title, span.network-banner-content-one, span.tech-support-list-title, span.tech-support-list-content, span.outsourcing-title, span.ar-font-align').css({"text-align": "right", "display": "block"});

            $('span.prod-un-gr').css({"text-align": "right", "display": "block", "line-height": "1.5em"});

            $('span.fa.fa-angle-right').css({"-moz-transform": "scaleX(-1)", " -o-transform": "scaleX(-1)", "-webkit-transform": "scaleX(-1)", " transform": "scaleX(-1)", "filter": "FlipH", "-ms-filter": "FlipH"});

            $('label.form-label-title').css({"text-align": "right"});

            $('i.fa.fa-phone.fa-2x.ar-cont-ico, i.fa.fa-envelope.fa-2x.ar-cont-ico').css({"float": "left"});
            $('span.network-banner-content-two, span.it-solution-title, span.net-src-cont, span.tech-supp-cont, span.maint-src-cont, span.smart-home-blog-title, span.smart-home-blog-para').css({"text-align": "right", "display": "block", "line-height": "1.3em"});

            $('span.smart-home-blog-title, span.smart-home-blog-para').css({"text-align": "right", "display": "block", "line-height": "1.5em"});

            $('span.tab-txt-align, span.tab-text-align, span.ar-font-align, span.tab-text-align-trending').css({"text-align": "right", "display": "block"});

            $('span.it-solution-title').css({"text-align": "right", "display": "block", "line-height": "1.3em", "transform": "scaleX(-1)"});

            $('.ar-image-align, .page-banner img').css({"transform": "scaleX(-1)"});

            $('span.line-one, span.line-two, span.line-three').css({"right": "5rem"});

            $('ul.outsourcing-list, .ar-lap-list-align, ul.tab-list-align').css({"text-align": "right", "display": "inline-grid"});

            $('ul.ar-list-align').css({"direction": "rtl"});

            $('i.icofont-verification-check.icofont-2x').css({"float": "right"});

            $('span.key-att-list').css({"text-align": "right", "display": "block", "margin-right": "4rem"});

            $('i.fa.fa-angle-right').css({"float": "left", "transform": "scaleX(-1)", "margin-right": "1rem"});
            $('i.icofont-square-right').css({"float": "left", "transform": "scaleX(-1)", "position": "absolute", "right": "13rem", "margin": "10px"});

            $('h4.ar-font-align').css({"text-align": "right"});

            $('i.icofont-rounded-right').css({"margin": "10px"});

            $('#wpcf7-f2807-p2784-o1, #wpcf7-f4180-p3969-o1, ul.parent').css({"direction": "rtl"});

            $('#features-holder .feature-box .feature-details p').css({"text-align": "right"});

            if ($(window).width() <= 767) {
                $("h3.ae-brochure-title").css({"margin-left": "0"});
                $("h4.ae-brochure-subtitle").css({"margin-left": "0"});
                $("h4.ae-brochure-subtitle-two").css({"margin-left": "0"});
            }

            if ($(window).width() > 767) {
                $("h3.ae-brochure-title").css({"left": "unset", "right": "0"});
                $("h4.ae-brochure-subtitle").css({"left": "unset", "right": "0"});
                $("h4.ae-brochure-subtitle-two").css({"left": "unset", "right": "0"});
            }

            $(".feature-title-holder").css({"display": "flex", "flex-direction": "row-reverse"});

            $("span.feature-title").css({"margin-top": "1rem", "margin-right": "2.5rem"});

            $(".cyber-box h4").css({"font-size": "20px"});

            $("h3.cybersec-two-title, ul.cybersec-two-list, p.cybersec-title-three, ul.cybersec-three-list, ul.cybersec-feature-list, p.cyber-sec-four, h4.cybersec-five-title, p.cybersec-five-para, ul.cybersec-sublist, h4.cyber-test-sec-box-bg-grey, h4.cyber-test-sec-box-bg-white, p.grey-bg-box, h3.cybersec-six-title, p.cyber-sec-six, ul.cyber-sec-six-list, p.cyber-app-sec-one, h4.cyber-app-sec-title, p.cyber-app-sec-para, p.cyber-network-sec-one, h4.cyber-siem-title, ul.cyber-siem-list, h4.cyber-ddos-title, ul.cyber-ddos-list, h4.cyber-email-title, h4.cyber-firewall-title, p.cyber-email-sec-service, p.cyber-firewall-sec-service, h4.cyber-antivirus-title, p.cyber-network-sec-one, p.white-bg-box").css({"direction": "rtl", "line-height": "1.5em"});

            $("span.cybersec-sec-one, span.cybersec-img-title").css({"direction": "rtl", "display": "block", "line-height": "1.5em"});

            $("#ar-slider").css("display", "block");
            $("#en-slider").css("display", "none");

            $(".right-erp-content-four, .left-erp-content-four").css({"margin-left": "12rem"});
            $(".right-erp-content-four h3").css({"text-align": "right", "margin-right": "0rem"});

            $(".left-erp-content-four h3").css({"text-align": "right", "margin-left": "0rem"});

            $(".pp-title p, .tc-title p, .rc-title p, .sp-title p, .pp-content p, .tc-content p, .rc-content p, .sp-content p, .camera-offer-title h4, .camera-offer-para p").css({"text-align": "right"});

            $("span.awsm-job-specification-label").css({"display": "grid"});

            $(".variations th").css("text-align", "right");

            $("li#menu-item-6122").css({"position": "absolute", "left": "8rem"});
        } else {
            $("#ar-slider").css("display", "none");
            $("#en-slider").css("display", "block");
            $(".variations th").css("text-align", "left")
            $("li#menu-item-6122").css({"position": "absolute", "right": "8rem"});
        }
    }());

    (function () {
        $(".brochure-download-image").click(function () {
            $(".download_ae_broucher_form_bottom, #wpcf7-f4885-p5-o3").css({"display": "block"});
            $(".wpb_single_image.wpb_content_element.vc_align_center.brochure-download-image img").css({"margin-top": "2%"});
            $('input#ae_broucher_email').focus();
        });
    }());

    /*======== WHY ADVANCED ELAF SECTION JS ========*/

    (function () {
        var featureIconHolder = $(".feature-icon-holder", "#features-links-holder");

        featureIconHolder.on("click", function () {
            featureIconHolder.removeClass("opened");
            $(this).addClass("opened");
            $(".show-details", "#features-holder").removeClass("show-details");
            $(".feature-d" + $(this).data("id"), "#features-holder").addClass("show-details");
        });

        /* Fix #features-holder height in features section */
        var featuresHolder = $("#features-holder");
        var featuresLinksHolder = $("#features-links-holder");
        var featureBox = $(".show-details", "#features-holder");

        featuresHolder.css("height", featureBox.height() + 120);
        featuresLinksHolder.css("height", featureBox.height() + 120);

        /* Fix #features-holder height in features section */
        $(window).on("resize", function () {
            featuresHolder.css("height", featureBox.height() + 120);
            featuresLinksHolder.css("height", featureBox.height() + 120);
            return false;
        });
    }());

    /*======== CUSTOM CCTV PACKAGE CALCULATION JS STARTS ========*/
    (function () {

        const cameraTypeValueAnalogue = "Analogue";
        const cameraTypeValueIP = "IP";

        const megaPixelValue2MP = "2MP";
        const megaPixelValue5MP = "5MP";
        const megaPixelValue4K = "4K";

        const cableValue20M = "20Meters";
        const cableValue50M = "50Meters";
        const cableValue100M = "100Meters";
        const cableValue150M200M = "150-200Meters";

        const hardDiskValue1TB = "1TB";
        const hardDiskValue2TB = "2TB";
        const hardDiskValue4TB = "4TB";
        const hardDiskValue6TB = "6TB";

        const analogue2MPcost = 110;
        const analogue5MPcost = 200;
        const analogue4Kcost = 245;

        const iP2MPcost = 200;
        const iP5MPcost = 300;
        const iP4Kcost = 450;

        const cableCost20M = 70;
        const cableCost50M = 120;
        const cableCost100M = 150;
        const cableCost150M200M = 250;

        const hardDiskCost1TB = 220;
        const hardDiskCost2TB = 280;
        const hardDiskCost4TB = 450;
        const hardDiskCost6TB = 640;

        var indoorCameraQty;
        var outdoorCameraQty;
        var cameraTypeValue;
        var cameraMegaPixelValue;
        var cablesValue;
        var hardDiskValue;

        $("#indoorCameraID").change(function () {
            indoorCameraQty = $("#indoorCameraID option:selected").val();
        });

        $("#outdoorCameraID").change(function () {
            outdoorCameraQty = $("#outdoorCameraID option:selected").val();
        });

        $("#cameraTypeID").change(function () {
            cameraTypeValue = $("#cameraTypeID option:selected").val();
        });

        $("#cameraMegaPixelID").change(function () {
            cameraMegaPixelValue = $("#cameraMegaPixelID option:selected").val();
        });

        $("#cablesID").change(function () {
            cablesValue = $("#cablesID option:selected").val();
        });

        $("#hardDiskID").change(function () {
            hardDiskValue = $("#hardDiskID option:selected").val();
        });

        $(".packagePricing").hide();

        $("#packageSubmitBtn").hide();

        $("#packageSubmitBtn").click(function () {
            $("#calculateBtn").hide();
        });

        $("#calculateBtn").click(function () {
            if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice1 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice1);
                $('#packageAmt_id').val(variantPrice1);   
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice2 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice2);
                $('#packageAmt_id').val(variantPrice2);   
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice3 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice3);
                $('#packageAmt_id').val(variantPrice3);   
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice4 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice4);
                $('#packageAmt_id').val(variantPrice4);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice5 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice5);
                $('#packageAmt_id').val(variantPrice5);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice6 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice6);
                $('#packageAmt_id').val(variantPrice6);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice7 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice7);
                $('#packageAmt_id').val(variantPrice8);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice8 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice8);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice9 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice9);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice10 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice10);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice11 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice11);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice12 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice12);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice13 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice13);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice14 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice14);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice15 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice15);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice16 = indoorCameraQty * analogue2MPcost + outdoorCameraQty * analogue2MPcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice16);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice17 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice17);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice18 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice18);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice19 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice19);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice20 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice20);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice21 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice21);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice22 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice22);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice23 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice23);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice24 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice24);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice25 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice25);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice26 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice26);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice27 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice27);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice28 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice28);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice29 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice29);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice30 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice30);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice31 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice31);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice32 = indoorCameraQty * analogue5MPcost + outdoorCameraQty * analogue5MPcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice32);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice33 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice33);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice34 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice34);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice35 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice35);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice36 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice36);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice37 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice37);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice38 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice38);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice39 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice39);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice40 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice40);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice41 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice41);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice42 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice42);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice43 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice43);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice44 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice44);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice45 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice45);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice46 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice46);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice47 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice47);
            } else if (cameraTypeValue == cameraTypeValueAnalogue && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice48 = indoorCameraQty * analogue4Kcost + outdoorCameraQty * analogue4Kcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice48);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice49 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice49);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice50 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice50);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice51 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice51);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice52 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice52);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice53 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice53);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice54 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice54);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice55 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice55);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice56 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice56);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice57 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice57);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice58 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice58);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice59 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice59);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice60 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice60);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice61 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice61);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice62 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice62);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice63 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice63);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue2MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice64 = indoorCameraQty * iP2MPcost + outdoorCameraQty * iP2MPcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice64);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice65 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice65);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice66 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice66);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice67 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice67);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice68 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice68);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice69 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice69);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice70 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice70);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice71 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice71);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice72 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice72);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice73 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice73);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice74 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice74);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice75 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice75);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice76 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice76);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice77 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice77);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice78 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice78);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice79 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice79);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue5MP && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice80 = indoorCameraQty * iP5MPcost + outdoorCameraQty * iP5MPcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice80);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice81 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost20M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice81);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice82 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost20M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice82);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice83 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost20M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice83);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue20M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice84 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost20M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice84);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice85 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost50M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice85);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice86 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost50M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice86);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice87 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost50M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice87);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue50M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice88 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost50M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice88);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice89 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost100M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice89);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice90 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost100M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice90);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice91 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost100M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice91);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue100M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice92 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost100M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice92);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue1TB) {
                var variantPrice93 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost150M200M + hardDiskCost1TB;
                $('#packageAmt').text(variantPrice93);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue2TB) {
                var variantPrice94 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost150M200M + hardDiskCost2TB;
                $('#packageAmt').text(variantPrice94);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue4TB) {
                var variantPrice95 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost150M200M + hardDiskCost4TB;
                $('#packageAmt').text(variantPrice95);
            } else if (cameraTypeValue == cameraTypeValueIP && cameraMegaPixelValue == megaPixelValue4K && cablesValue == cableValue150M200M && hardDiskValue == hardDiskValue6TB) {
                var variantPrice96 = indoorCameraQty * iP4Kcost + outdoorCameraQty * iP4Kcost + cableCost150M200M + hardDiskCost6TB;
                $('#packageAmt').text(variantPrice96);
            } else {
                //var variant97 = "0";
                //$('#packageAmt').text(variant97);
                $('#packageAmt').text("Price On Request");
            }

			/*show package price*/
            $(".packagePricing").show();
			
            /* submit button show/hide based on the package value */
            let packageAmt1 = $('#packageAmt').text();
            if (packageAmt1 == "NaN") {
                $('#packageAmt').text("Price On Request");
                return false;
            } else if (packageAmt1.length > 1) {
                $("#packageSubmitBtn").show();
                return false;
            } else {
                $("#packageSubmitBtn").hide();
            }
			
        });

    }());

    /*======== CUSTOM CCTV PACKAGE CALCULATION JS ENDS ========*/
});