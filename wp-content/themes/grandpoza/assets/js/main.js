/*
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
  Construction, Architecture & Building Company Template
–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

    - File           : main.js
    - Desc           : Template - JavaScript
    - Version        : 1.1
    - Date           : 2017-03-01
    - Author         : CODASTROID
    - Email          : codastroid@gmail.com
    - Author URI     : https://themeforest.net/user/codastroid?ref=CODASTROID

–––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
*/

(function($) {

    "use strict";

    var bodySelect = $('body'),
        htmlBodySelect = $('html, body');

    /*-------------------------------------
        Background Image
    -------------------------------------*/
    var background_image = function() {
        $("[data-bg-img]").each(function() {
            var attr = $(this).attr('data-bg-img');
            if (typeof attr !== typeof undefined && attr !== false && attr !== "") {
                $(this).css('background-image', 'url('+attr+')');
            }
        });  
    };

    /*-------------------------------------
        Preloader
    -------------------------------------*/
    var preloader = function() {
        if($('#preloader').length) {
            $('#preloader > *').fadeOut(); /*  will first fade out the loading animation */
            $('#preloader').delay(150).fadeOut('slow'); /*  will fade out the white DIV that covers the website. */
            bodySelect.delay(150).removeClass('preloader-active');
        }
    };

    /*-------------------------------------
        Toggle Class
    -------------------------------------*/
    var toogle_class = function() {
        $('[data-toggle-class]').each(function(){
            var self = $(this),
                data_toggle_event = self.data('toggle-event'),
                toggle_event = data_toggle_event.substring(0, data_toggle_event.lastIndexOf('#')),
                toggle_event_elem = data_toggle_event.substring(data_toggle_event.lastIndexOf('#')),
                toggle_class = self.data('toggle-class');

            if (toggle_event === "hover") { 
                toggle_event = "mouseenter, mouseleave";
            }
            $(toggle_event_elem).on(toggle_event, function() {
                self.toggleClass(toggle_class);
            });
        });
    };

    /*-------------------------------------
        Back Top
    -------------------------------------*/
    var back_to_top = function() {
        var backTop = $('#backTop');
        if (backTop.length) {
            var scrollTrigger = 200,
                scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                backTop.addClass('show');
            } else {
                backTop.removeClass('show');
            }
        }
    };
    
    /*-------------------------------------
        Click To Back Top
    -------------------------------------*/
    var click_back = function() {
        var backTop = $('#backTop');
        backTop.on('click', function(e) {
            htmlBodySelect.animate({
                scrollTop: 0
            }, 700);
            e.preventDefault();
        });
    };

    /*-------------------------------------
        MixitUp init
    -------------------------------------*/
    var gallery_mixitup = function() {
        $('.portfolio-area .portfolio-wrapper').mixItUp();
        $('.portfolio-area .portfolio-filter .filter').on('click', function(e){
            e.preventDefault();
        });  
    };
    
    /*-------------------------------------
        Magnific Popup init
    -------------------------------------*/
    var magnific_popup = function() {
        $('.img-lightbox').magnificPopup({
            type: 'image',
            mainClass: 'mfp-fade',
            gallery: {
                enabled: true
            }
          
        });
        $('.iframe-lightbox').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    };

    /*-------------------------------------
        Skills Progress Bar
    -------------------------------------*/
    var progress_bar = function() {
        $('.skill-percentage').each(function () {
            var $this = $(this);
            var width = $(this).data('percent');
            $this.html('<span class="progress-tooltip">'+width+' %</span>');
            $this.css({
                'transition': 'width 3s'
            });
            setTimeout(function () {
                $this.appear(function () {
                    $this.css('width', width + '%');
                    setTimeout(function() {
                      $this.find('.progress-tooltip').css({
                        'opacity': '1'
                      });  
                    }, 200);
                });
            }, 1000);
        });
    };

    /*-------------------------------------
        Navbar JS
    -------------------------------------*/
    var navbar_js = function() {
        $('.dropdown-mega-menu > a, .nav-menu > li:has( > ul) > a').append("<span class=\"indicator\"><i class=\"fa fa-angle-down\"></i></span>");
        $('.nav-menu > li ul > li:has( > ul) > a').append("<span class=\"indicator\"><i class=\"fa fa-angle-right\"></i></span>");
        $(".dropdown-mega-menu, .nav-menu li:has( > ul)").on('mouseenter', function () {
            if ($(window).width() > 991) {
                $(this).children("ul, .mega-menu").fadeIn(100);
            }
        });
        $(".dropdown-mega-menu, .nav-menu li:has( > ul)").on('mouseleave', function () {
            if ($(window).width() > 991) {
                $(this).children("ul, .mega-menu").fadeOut(100);
            }
        });
        $(".dropdown-mega-menu > a, .nav-menu li:has( > ul) > a").on('click', function (e) {
            if ($(window).width() <= 991) {
                $(this).parent().addClass("active-mobile").children("ul, .mega-menu").slideToggle(150, function() {
                    
                });
                $(this).parent().siblings().removeClass("active-mobile").children("ul, .mega-menu").slideUp(150);
            }
            e.preventDefault();
        });
        $(".nav-toggle").on('click', function (e) {
            var toggleId = $(this).data("toggle");
            $(toggleId).slideToggle(150);
            e.preventDefault();
        });
        $('#menu').on('click', function() {
            if ($(window).width() <= 991) {
                $('.navigation').slideToggle('normal');
            }
            return false;
        });
        $('.navigation>ul> li >a').on('click', function() { 
            if ($(window).width() <= 991) {
                $('.navigation>ul> li').removeClass('on');
                $('.navigation>ul> li> ul').slideUp('normal');
                if ($(this).next().next('ul').is(':hidden') === true) {
                    $(this).parent('li').addClass('on');
                    $(this).next().next('ul').slideDown('normal');
                }
            }
        });
        $('.sub-menu >a').on('click', function() { 
            if ($(window).width() <= 991) {
                $('.sub-menu').removeClass('on');
                $('.sub-menu> ul').slideUp('normal');
                if ($(this).next().next('ul').is(':hidden') === true) {
                    $(this).parent('li').addClass('on');
                    $(this).next().next('ul').slideDown('normal');
                }
            }
        });
        $(window).on('resize', function() {
            if ($(window).width() >= 991) {
                $('.navigation').show();
            }
        });
    };
    var navbar_resize_load = function() {
        var navMenu = $('.nav-menu'),
            navBar = $(".nav-bar");
        if ($(".nav-header").css("display") === "block") {
            navBar.addClass('nav-mobile');
            navMenu.find("li.active").addClass("active-mobile");
        }
        else {
            navBar.removeClass('nav-mobile');
        }

        if ($(window).width() >= 991) {
            $(".dropdown-mega-menu a, .nav-menu li:has( > ul) a").each(function () {
                $(this).parent().children("ul, .mega-menu").slideUp(0);
            });
            $($(".nav-toggle").data("toggle")).show();
            navMenu.find("li").removeClass("active-mobile");
        }
    };

    /*-------------------------------------
        Bootstrao Touchspin
    -------------------------------------*/
    var TouchSpin = function () {

        if ($('.quantity-spinner').length) {
            $("input.quantity-spinner").TouchSpin({
                verticalbuttons: true
            });
        }
    };

    /*-------------------------------------
        Owl Carousel Init
    -------------------------------------*/
    var owl_carousel = function () {
        
        /** Detect Post Galleries and slide their pictures */
        if ($(".page-content .gallery-post-format").length > 0) {
            $(".page-content .gallery-post-format .inline-gallery .gallery").each(function (k, gallery) {
                var images = $(gallery).find("img");
                if (images.length > 0) {

                    $(gallery)
                        .html("")
                        .attr({
                            "data-autoplay" : true,
                            "data-nav"      : true
                        });

                    $(images).each(function (k, img) {

                        $(gallery).append(img);

                    });

                    $(gallery).addClass("owl-carousel");
                }
            });
        }

        $('.owl-carousel').each(function () {
            var carousel = $(this),
                autoplay_hover_pause = carousel.data('autoplay-hover-pause'),
                loop = carousel.data('loop'),
                items_general = carousel.data('items'),
                margin = carousel.data('margin'),
                autoplay = carousel.data('autoplay'),
                autoplayTimeout = carousel.data('autoplay-timeout'),
                smartSpeed = carousel.data('smart-speed'),
                nav_general = carousel.data('nav'),
                navSpeed = carousel.data('nav-speed'),
                xxs_items = carousel.data('xxs-items'),
                xxs_nav = carousel.data('xxs-nav'),
                xs_items = carousel.data('xs-items'),
                xs_nav = carousel.data('xs-nav'),
                sm_items = carousel.data('sm-items'),
                sm_nav = carousel.data('sm-nav'),
                md_items = carousel.data('md-items'),
                md_nav = carousel.data('md-nav'),
                lg_items = carousel.data('lg-items'),
                lg_nav = carousel.data('lg-nav'),
                center = carousel.data('center'),
                dots_global = carousel.data('dots'),
                xxs_dots = carousel.data('xxs-dots'),
                xs_dots = carousel.data('xs-dots'),
                sm_dots = carousel.data('sm-dots'),
                md_dots = carousel.data('md-dots'),
                lg_dots = carousel.data('lg-dots');

            carousel.owlCarousel({
                autoplayHoverPause: autoplay_hover_pause,
                loop: (loop ? loop : false),
                items: (items_general ? items_general : 1),
                lazyLoad: true,
                margin: (margin ? margin : 0),
                autoplay: (autoplay ? autoplay : false),
                autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),
                smartSpeed: (smartSpeed ? smartSpeed : 250),
                dots: (dots_global ? dots_global : false),
                nav: (nav_general ? nav_general : false),
                navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"],
                navSpeed: (navSpeed ? navSpeed : false),
                center: (center ? center : false),
                responsiveClass: true,
                responsive: {
                    0: {
                        items: ( xxs_items ? xxs_items : (items_general ? items_general : 1)),
                        nav: ( xxs_nav ? xxs_nav : (nav_general ? nav_general : false)),
                        dots: ( xxs_dots ? xxs_dots : (dots_global ? dots_global : false))
                    },
                    480: {
                        items: ( xs_items ? xs_items : (items_general ? items_general : 1)),
                        nav: ( xs_nav ? xs_nav : (nav_general ? nav_general : false)),
                        dots: ( xs_dots ? xs_dots : (dots_global ? dots_global : false))
                    },
                    768: {
                        items: ( sm_items ? sm_items : (items_general ? items_general : 1)),
                        nav: ( sm_nav ? sm_nav : (nav_general ? nav_general : false)),
                        dots: ( sm_dots ? sm_dots : (dots_global ? dots_global : false))
                    },
                    992: {
                        items: ( md_items ? md_items : (items_general ? items_general : 1)),
                        nav: ( md_nav ? md_nav : (nav_general ? nav_general : false)),
                        dots: ( md_dots ? md_dots : (dots_global ? dots_global : false))
                    },
                    1199: {
                        items: ( lg_items ? lg_items : (items_general ? items_general : 1)),
                        nav: ( lg_nav ? lg_nav : (nav_general ? nav_general : false)),
                        dots: ( lg_dots ? lg_dots : (dots_global ? dots_global : false))
                    }
                }
            });

        });
    };

    /*-------------------------------------
        Cart Delete Item Alert
    -------------------------------------*/
    var cart_delete_item = function(){
        var close = $(".cart-area").find(".close[data-dismiss='alert']");
        close.on('click', function(){
            var deleteBol = confirm("Do You Really Want to Delete This item ?");
            if (deleteBol === false) {
                return false;
            }
        });
    };

    /*-------------------------------------
        Fun Fact
    -------------------------------------*/
    var factCounter = function() {
        var counterText = $('.count-text');
        if(counterText.length){
            
            counterText.each(function() {

                var $this = $(this);
                var n = $this.attr("data-stop"),
                    r = parseInt($this.attr("data-speed"), 10);
                
                setTimeout(function () {
                    $this.appear(function () {
                        if (!$this.hasClass("counted")) {
                            $this.addClass("counted");
                            $({
                                countNum: $this.text()
                            }).animate({
                                countNum: n
                            }, {
                                duration: r,
                                easing: "linear",
                                step: function() {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $this.text(this.countNum);
                                }
                            });
                        }  
                    });
                    
                }, 1000);             
            });
        }

    };

    /*-------------------------------------
        Hero Area Dynamic Height
    -------------------------------------*/
    var heroHeight = function() {
        var heroAreaContent = $("#heroArea .hero-content");
        if (heroAreaContent.length) {
            var headerHeight = parseInt($('#mainHeader').outerHeight(), 10),
            topbarHeight = parseInt($('#topbar').outerHeight(), 10),
            windowHeight = parseInt($(window).height(), 10);
            heroAreaContent.css({
                "min-height": (windowHeight - (topbarHeight + headerHeight)) + "px"
            });
        }
    };

    /*-------------------------------------
        Vegas Slider
    -------------------------------------*/
    var vegasSlider = function(){
        $(".hero-images-slider").vegas({
            slides: [
                { src: "assets/images/background/02.jpg" },
                { src: "assets/images/background/07.jpg" },
                { src: "assets/images/background/42.jpg" },
                { src: "assets/images/background/05.jpg" }
            ],
            timer: false
        });
    };

    /*-------------------------------------
        Contact Form JS
    -------------------------------------*/
    var validateEmail = function(email) {
        var patt = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        if (patt.test(email) === true ) {
            return true;
        }
        return false;
    };
    var validatePhone = function(phone) {
        var patt = /^[0-9]{8,20}$/;
        if (patt.test(phone) === true ) {
            return true;
        }
        return false;
    };
    var contact_response = function(responseNode, type) {
        /* Response Messages */
        var success_response = 'Your email was sent!',
            error_response = 'Something went wrong!',
            error_net_response = 'Could not connect to server!';

        if (type === "success") {
            responseNode.removeClass('text-error').addClass('text-valid');
            responseNode.text(success_response);
        }
        else {
            responseNode.removeClass('text-valid').addClass('text-error');
            if (type === "netError") {
                responseNode.text(error_net_response);
            }
            else {
                responseNode.text(error_response);
            }
        }
    };
    var contactForm = function() {

        $("#contactForm").on("submit", function(e) {
            event.preventDefault();
            var self = $(this),
                valid_form = true,
                valid_email = false,
                valid_phone = false,
                name = $("#contactName"),
                email = $("#contactEmail"),
                emailValue = email.val(),
                phone = $("#contactPhone"),
                phoneValue = phone.val(),
                subject = $("#contactSubject"),
                message = $("#contactMessage"),
                formFields = [name, subject, message],
                action = self.attr('action'),
                responseNode = $('#contactResponse');

            formFields.forEach(function(input) {
                if (input.val() === '') {
                    input.addClass('input-error');
                    valid_form = false;
                }
            });

            if (emailValue !== '' && validateEmail(emailValue) === true) {
                valid_email = true;
            }
            if (phoneValue !== '' && validatePhone(phoneValue) === true) {
                valid_phone = true;
                console.log(valid_phone);
            }

            if (valid_email === false && valid_phone === false) {
                email.addClass('input-error');
                phone.addClass('input-error');
                valid_form = false;
            }
            if (valid_email === true || valid_phone === true) {
                email.removeClass('input-error');
                phone.removeClass('input-error');
            }
            if (valid_email === true && valid_phone === false) {
                phone.val('');
            } else if (valid_phone === true && valid_email === false) {
                email.val('');
            }

            self.find('input, textarea').on('change', function(){
                $(this).removeClass('input-error');
            });

            if (valid_form === true) {
                $.ajax({
                    type: "POST",
                    url: action,
                    data: self.serialize(),
                    success: function(result){
                        console.log(result);
                        if (result === "success"){
                            self[0].reset();
                            contact_response(responseNode, "success");
                        } else {
                            contact_response(responseNode, "error");
                        }
                    },
                    error: function(){
                        contact_response(responseNode, "netError");
                    }
                });
            }

        });
    };

    var masonary_blog_layout = function () {
        if (window.screen.width > 768 ) {
            $('.page-blog-grid .row').masonry({
                itemSelector: '.blog-post',
                horizontalOrder: true,
                percentPosition: true
            });
        }
    }

    /*-------------------------------------
     Stars Rating functions
    -------------------------------------*/
    var data_rating = function() {
        $('.rating').each(function () {
            var rating = $(this).find('.rating-stars').attr('data-rating'),
                rating_index = 5 - rating;
            $(this).find('.rating-stars > i').eq(rating_index).addClass('star-active');
        });
    };

    var do_rating = function() {
        var rating_stars_select = $('.rating .rating-stars.rate-allow');
        rating_stars_select.on('mouseenter', function () {
            $(this).find('i').removeClass('star-active');
        });
        rating_stars_select.on('mouseleave', function () {
            data_rating();
        });
        rating_stars_select.on('click', 'i', function () {
            var data_destination = $(this).parent().attr("data-target");
            var num_stars = $(this).siblings().length + 1,
                rating_index = $(this).index(),
                rating_count_select = $(this).parent().parent().find('.rating-count'),
                reviews_num = parseInt(rating_count_select.text(), 10),
                rate_value = num_stars - rating_index;
            if (data_destination.length > 0)
            {
                $(data_destination).val(rate_value);
            }
            reviews_num ++;

            $(this).parent().attr('data-rating', rate_value);
            data_rating();
            if ($(this).parent().attr('data-review')) {
                return false;
            }
            else {
                $(this).parent().attr('data-review', '1');
                rating_count_select.text(reviews_num);
            }
        });
    };

    /* =================================
       When document is ready
    ================================== */
    $(document).on('ready', function() {
        preloader();
        background_image();
        click_back();
        factCounter();
        magnific_popup();
        progress_bar();
        TouchSpin();
        gallery_mixitup();
        navbar_js();
        owl_carousel();
        toogle_class();
        heroHeight();
        vegasSlider();
        cart_delete_item();
        contactForm();
        data_rating();
        do_rating();
        masonary_blog_layout();
        $("body").on('updated_cart_totals', function () {
            TouchSpin();
        });

    });
        
    /* =================================
       When document is loading
    ================================== */  
    $(window).on('load', function() {
        preloader();
        navbar_resize_load();
    }); 

    /* =================================
       When Window is resizing
    ================================== */  
    $(window).on('resize', function() {
        navbar_resize_load();
        heroHeight();
    });

    /* =================================
       When document is Scrollig
    ================================== */    
    $(window).on('scroll', function() {
        back_to_top();
    });

    
})(jQuery);