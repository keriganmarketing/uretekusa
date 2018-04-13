(function($) {
	
	
	/***************************************************************************************************************
||||||||||||||||||||||||||||        CUSTOM SCRIPT FOR TITAN BUILDER            |||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
||||||||||||||||||||||||||||              TABLE OF CONTENT                  ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
****************************************************************************************************************
01. Revolution slider
02. Sticky header
03. Prealoader
04. Language switcher
05. prettyPhoto
06. BrandCarousel
07. Testimonial carousel
08. ScrollToTop 
09. Cart Touch Spin
10. PriceFilter
11. Cart touch spin
12. Fancybox activator
13. ContactFormValidation
14. Scoll to target
15. PrettyPhoto

****************************************************************************************************************
||||||||||||||||||||||||||||            End TABLE OF CONTENT                ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************/


"use strict";



//===RevolutionSliderActiver===
function revolutionSliderActiver () {
	if ($('.rev_slider_wrapper #slider1').length) {
		$("#slider1").revolution({
			sliderType:"standard",
			sliderLayout:"auto",
			delay:5000,
            
            navigationType:"bullet",
		    navigationArrows:"0",
		    navigationStyle:"preview3",
            
            dottedOverlay:'yes',
            
            hideTimerBar:"off",
            onHoverStop:"off",
			navigation: {
				arrows:{enable:true} 
			}, 
            gridwidth: [1200],
            gridheight: [880, 800, 750, 700]
		});
	};
}



//====Main menu===
function mainmenu() {
	//Submenu Dropdown Toggle
	if($('.main-menu li.dropdown ul').length){
		$('.main-menu li.dropdown').append('<div class="dropdown-btn"></div>');
		
		//Dropdown Button
		$('.main-menu li.dropdown .dropdown-btn').click(function() {
			$(this).prev('ul').slideToggle(500);
		});
	}

}




//===Header Sticky===
function stickyHeader() {
    if ($('.stricky').length) {
        var strickyScrollPos = 100;
        if ($(window).scrollTop() > strickyScrollPos) {
            $('.stricky').addClass('stricky-fixed');
            $('.scroll-to-top').fadeIn(1500);
        } else if ($(this).scrollTop() <= strickyScrollPos) {
            $('.stricky').removeClass('stricky-fixed');
            $('.scroll-to-top').fadeOut(1500);
        }
    };
}


//===scoll to Top===
function scrollToTop() {
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").click(function() {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }
}


//===Search box ===
function searchbox() {
	//Search Box Toggle
	if($('.seach-toggle').length){
		//Dropdown Button
		$('.seach-toggle').click(function() {
			$(this).toggleClass('active');
			$(this).next('.search-box').toggleClass('now-visible');
		});
	}

}




// ===Project===
function projectMasonaryLayout() {
    if ($('.masonary-layout').length) {
        $('.masonary-layout').isotope({
            layoutMode: 'masonry'
        });
    }

    if ($('.post-filter').length) {
        $('.post-filter li').children('span').click(function() {
            var Self = $(this);
            var selector = Self.parent().attr('data-filter');
            $('.post-filter li').children('span').parent().removeClass('active');
            Self.parent().addClass('active');


            $('.filter-layout').isotope({
                filter: selector,
                animationOptions: {
                    duration: 500,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
    }

    if ($('.post-filter.has-dynamic-filter-counter').length) {
        // var allItem = $('.single-filter-item').length;

        var activeFilterItem = $('.post-filter.has-dynamic-filter-counter').find('li');

        activeFilterItem.each(function() {
            var filterElement = $(this).data('filter');
            console.log(filterElement);
            var count = $('.gallery-content').find(filterElement).length;

            $(this).children('span').append('<span class="count"><b>' + count + '</b></span>');
        });
    };
}


//===Prettyphoto Lightbox===
function prettyPhoto() {
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        animation_speed:'normal',
        slideshow:3000,
        autoplay_slideshow: false,
        fullscreen: true,
        social_tools: false
    });
}




//=== Fact counter ===
function CounterNumberChanger () {
	var timer = $('.timer');
	if(timer.length) {
		timer.appear(function () {
			timer.countTo();
		})
	}

}


//=== Tool tip ===
function tooltip () {
	if ($('.tool_tip').length) {
			$('.tool_tip').tooltip();
		};
	$
}


//=== Accordion Box ===
function accordion() {
    if($('.accordion-box').length){
        $(".accordion-box .accord-btn").click(function() {

            if($(this).hasClass('active')!==true){
            $('.accordion .accord-btn').removeClass('active');

            }

            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(500);
            }else{
                $(this).addClass('active');
                $('.accordion .accord-content').slideUp(500);
                $(this).next('.accord-content').slideDown(500);	
            }
        });	
    }
}


//=== Cart Touch Spin ===
function cartTouchSpin() {
    if ($('.quantity-spinner').length) {
        $("input.quantity-spinner").TouchSpin({
            verticalbuttons: true
        });
    }
}



//=== Select menu === 
function selectDropdown () {
  if($(".selectmenu").length) {
    $( ".selectmenu" ).selectmenu();
  };
}



//=== Price Filter===
function priceFilter() {
    if ($('.price-ranger').length) {
        $('.price-ranger #slider-range').slider({
            range: true,
            min: 10,
            max: 200,
            values: [11, 99],
            slide: function(event, ui) {
                $('.price-ranger .ranger-min-max-block .min').val('$' + ui.values[0]);
                $('.price-ranger .ranger-min-max-block .max').val('$' + ui.values[1]);
            }
        });
        $('.price-ranger .ranger-min-max-block .min').val('$' + $('.price-ranger #slider-range').slider('values', 0));
        $('.price-ranger .ranger-min-max-block .max').val('$' + $('.price-ranger #slider-range').slider('values', 1));
    };
}


//=== Prealoder===
function prealoader() {
    if($('.preloader').length){
        $('.preloader').delay(2000).fadeOut(500);
    }
}
 

// ===Date picker ===
function datepicker () {
    if ($('#datepicker').length) {
        $('#datepicker').datepicker();
    };
}




//=== Thm scroll anim===
function thmScrollAnim() {
    if ($('.wow').length) {
        var wow = new WOW({
            mobile: false
        });
        wow.init();
    };
}


//=== Contact Form Validation ===
if($("#contact-form").length){
    $("#contact-form").validate({
        submitHandler: function(form) {
          var form_btn = $(form).find('button[type="submit"]');
          var form_result_div = '#form-result';
          $(form_result_div).remove();
          form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
          var form_btn_old_msg = form_btn.html();
          form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
          $(form).ajaxSubmit({
            dataType:  'json',
            success: function(data) {
              if( data.status == 'true' ) {
                $(form).find('.form-control').val('');
              }
              form_btn.prop('disabled', false).html(form_btn_old_msg);
              $(form_result_div).html(data.message).fadeIn('slow');
              setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
            }
          });
        }
    });
}

// team-slider
if ($(".team-carousel").length) {
    $(".team-carousel").owlCarousel({
        autoplay: true,
        loop: true,
        autoplayHoverPause: true,
        dotsEach: true,
        margin:30,
        dotsSpeed: 1000,
        smartSpeed: 1000,
        pagination: true,
        nav: false,
        items: 4,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1366: {
                items: 4
            }
        }
    });
};

// partners-slider
    if ($(".brand-carousel").length) {
        $(".brand-carousel").owlCarousel({
            autoplay: true,
            loop: true,
            autoplayHoverPause: true,
            pagination: false,
            dotsSpeed: 1000,
            smartSpeed: 1000,
            margin:80,
            nav: true,
            items: 6,
            navElement: "span",
            navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 2
                },
                767: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1201: {
                    items: 5
                },
                1366: {
                    items: 6
                }
            }
        });
    };


function teamCarosule () {
    if ($('#our-team-construct .owl-carousel').length) {
        $('#our-team-construct .owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        });
    }
}









// Dom Ready Function
jQuery(document).ready(function () {
	(function ($) {
        // add your functions
        revolutionSliderActiver ();
        mainmenu ();
        scrollToTop ();
        prettyPhoto ();
        CounterNumberChanger ();
        accordion ();
        cartTouchSpin ();
        selectDropdown ();
        priceFilter ();
        datepicker ();
        searchbox ();
        tooltip ();
        thmScrollAnim();
        teamCarosule();
 
	})(jQuery);
});


// Scroll Function
jQuery(window).scroll(function(){
	(function ($) {
	stickyHeader()
    
	})(jQuery);
});



// Instance Of Fuction while Window Load event
jQuery(window).load(function() {
    (function($) {
        projectMasonaryLayout ();
        prealoader ()
        
    })(jQuery);
});


//------like end-----
  var bunch_theme = {   
    count: 0,
    likeit: function(options, selector)
    {
  options.action = '_bunch_ajax_callback';
  
  if( $(selector).data('_bunch_like_it') === true ){
   bunch_theme.msg( 'You have already done this job', 'error' );
   return;
  }
  
  $(selector).data('_bunch_like_it', true );
 
  bunch_theme.loading(true);
  
  $.ajax({
   url: ajaxurl,
   type: 'POST',
   data:options,
   dataType:"json",
   success: function(res){
 
    try{
     var newjason = res;
 
     if( newjason.code === 'fail'){
   $(selector).data('_bunch_like_it', false );
   bunch_theme.loading(false);
   bunch_theme.msg( newjason.msg, 'error' );
     }else if( newjason.code === 'success' ){
   //$('a[data-id="'+options.data_id+'"]').html( '<i class="fa fa-heart-o"></i> '+newjason.value );
   bunch_theme.loading(false);
   $(selector).data('_bunch_like_it', true );
   bunch_theme.msg( newjason.msg, 'success' );
     }
     
    }
    catch(e){
     bunch_theme.loading(false);
     $(selector).data('_bunch_like_it', false );
     bunch_theme.msg( 'There was an error with request '+e.message, 'error' );
     
    }
   }
  });
    },
    loading: function( show ){
  if( $('.ajax-loading' ).length === 0 ) {
   $('body').append('<div class="ajax-loading" style="display:none;"></div>');
  }
  
  if( show === true ){
   $('.ajax-loading').show('slow');
  }
  if( show === false ){
   $('.ajax-loading').hide('slow');
  }
    },
    
    msg: function( msg, type ){
  if( $('#pop' ).length === 0 ) {
   $('body').append('<div style="display: none;" id="pop"><div class="pop"><div class="alert"><p></p></div></div></div>');
  }
  if( type === 'error' ) {
   type = 'danger';
  }
  var alert_type = 'alert-' + type;
  
  $('#pop > .pop p').html( msg );
  $('#pop > .pop > .alert').addClass(alert_type);
  
  $('#pop').slideDown('slow').delay(5000).fadeOut('slow', function(){
   $('#pop .pop .alert').removeClass(alert_type);
  });
  
  
    },
    
   };
  
 //------like end-----
 
 
//Like Script
$('.jolly_like_it').click(function(e) {

e.preventDefault();

	var opt = {subaction:'likeit', data_id:$(this).attr('data-id')};
	bunch_theme.likeit( opt, this );
	
	setTimeout(function(){
	   window.location.reload(1);
	}, 4000);
	
	return false;
});
/**like end*/


})(jQuery);