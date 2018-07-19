webpackJsonp([3],{

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(521);


/***/ },

/***/ 521:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	window.FabriqueApp = __webpack_require__(522);

	jQuery(function() {
	  'use strict';
	  FabriqueApp.init();
	  FabriqueApp.main();
	  FabriqueApp.startItems();
	  return FabriqueApp.afterItems();
	});


/***/ },

/***/ 522:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var $, Cookies, FabriqueApp, ScrollMagic;

	__webpack_require__(523);

	__webpack_require__(539);

	ScrollMagic = __webpack_require__(533);

	Cookies = __webpack_require__(535);

	__webpack_require__(540);

	__webpack_require__(541);

	__webpack_require__(542);

	__webpack_require__(543);

	__webpack_require__(544);

	__webpack_require__(545);

	__webpack_require__(546);

	__webpack_require__(547);

	__webpack_require__(548);

	__webpack_require__(549);

	__webpack_require__(550);

	__webpack_require__(551);

	__webpack_require__(552);

	__webpack_require__(553);

	__webpack_require__(554);

	__webpack_require__(555);

	__webpack_require__(556);

	__webpack_require__(557);

	__webpack_require__(558);

	__webpack_require__(559);

	__webpack_require__(560);

	__webpack_require__(561);

	__webpack_require__(562);

	__webpack_require__(563);

	__webpack_require__(564);

	__webpack_require__(565);

	__webpack_require__(566);

	__webpack_require__(568);

	__webpack_require__(569);

	__webpack_require__(570);

	__webpack_require__(571);

	__webpack_require__(572);

	__webpack_require__(573);

	__webpack_require__(574);

	__webpack_require__(575);

	__webpack_require__(576);

	__webpack_require__(577);

	__webpack_require__(578);

	__webpack_require__(579);

	__webpack_require__(580);

	__webpack_require__(581);

	__webpack_require__(582);

	$ = jQuery;

	FabriqueApp = {};

	FabriqueApp.init = function() {
	  this.mobileScreenWidth = 767;
	  this.tabletScreenWidth = 960;
	  this.smController = new ScrollMagic.Controller;
	  this.ajaxUrl = FabriqueOptions.ajax_url;
	  this.ajaxNonce = FabriqueOptions.ajax_nonce;
	  this.isSafari = navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Chrome') === -1;
	  this.body = $('body');
	  this.isResponsive = this.body.hasClass('fbq-layout-responsive');
	  this.isHeaderOnFrame = this.body.hasClass('header-on-frame');
	  this.defaultScheme = this.body.data('scheme') ? this.body.data('scheme') : 'light';
	  this.layout = this.body.data('layout') ? this.body.data('layout') : 'full';
	  this.frameWidth = this.layout !== 'frame' ? 0 : this.body.data('frame_width');
	  this.carouselArrowStyle = this.body.data('arrow_style') ? this.body.data('arrow_style') : 'ln-arrow';
	  this.carouselArrowBackground = this.body.data('arrow_background') ? this.body.data('arrow_background') : 'square';
	  this.pageLoad = $('.fbq-page-load');
	  this.hasPageLoad = this.pageLoad.length ? true : false;
	  this.mainWrapper = $('.fbq-main-wrapper');
	  this.isHorizontalScroll = this.mainWrapper.hasClass('fbq-scrollpage--full--horizontal');
	  this.isVerticalScroll = this.mainWrapper.hasClass('fbq-scrollpage--full--vertical');
	  this.isHalfPageScroll = this.mainWrapper.hasClass('fbq-scrollpage--half');
	  this.content = $('.fbq-content');
	  this.header = $('.fbq-header');
	  this.navbar = $('.fbq-navbar');
	  this.mainNavbar = this.navbar.filter('[data-role=navigation]');
	  this.navbarMobile = $('.fbq-navbar--mobile');
	  this.mainNavbarMobile = this.navbarMobile.filter('[data-role=navigation]');
	  if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
	    this.isMobileOrTablet = true;
	  } else {
	    this.isMobileOrTablet = false;
	  }
	  return this.pswpElement = $('.pswp');
	};

	FabriqueApp.main = function() {
	  var youtubeVideoBackground;
	  FabriqueApp.navbars();
	  if (FabriqueApp.hasPageLoad) {
	    FabriqueApp.body.addClass('fbq-unscrollable');
	    setTimeout(function() {
	      if (!FabriqueApp.pageLoad.hasClass('loaded')) {
	        FabriqueApp.pageLoad.addClass('loaded');
	        return FabriqueApp.body.removeClass('fbq-unscrollable');
	      }
	    }, 20000);
	    if (!FabriqueApp.pageLoad.hasClass('loaded')) {
	      $(window).load(function() {
	        return setTimeout(function() {
	          FabriqueApp.pageLoad.addClass('loaded');
	          return FabriqueApp.body.removeClass('fbq-unscrollable');
	        }, 200);
	      });
	    }
	  }
	  if ($('#wpadminbar').length) {
	    FabriqueApp.body.addClass('with-admin-toolbar');
	  }
	  if (FabriqueApp.isHorizontalScroll || FabriqueApp.isVerticalScroll || FabriqueApp.isHalfPageScroll) {
	    FabriqueApp.mainWrapper.fbqOnePageScroll();
	  } else {
	    $('.fbq-section--fit-height').fbqSetSize();
	  }
	  if (FabriqueApp.hasPageLoad) {
	    $(window).load(function() {
	      return FabriqueApp.body.fbqAnimated();
	    });
	  } else {
	    FabriqueApp.body.fbqAnimated();
	  }
	  $('.fbq-audio').fbqAudio();
	  $('.fbq-page-hero--fit-height').fbqSetSize({
	    addLineHeight: false,
	    itemWrapper: '.fbq-page-hero-wrapper'
	  });
	  $('.fbq-post-share-button').on('click', function(e) {
	    var shareToggle;
	    e.preventDefault();
	    shareToggle = $(e.currentTarget);
	    return shareToggle.siblings('.fbq-post-share-box').fadeToggle();
	  });
	  $('.fbq-post-print').on('click', function(e) {
	    e.preventDefault();
	    return window.print();
	  });
	  $('.js-share:not(.fbq-social-email)').on('click', function(e) {
	    this.link = $(this).attr('href');
	    window.open(this.link, 'window', 'left=20, top=20, width=600, height=700, toolbar=0, resizable=1');
	    return false;
	  });
	  youtubeVideoBackground = $('iframe.fbq-video-background-inner--youtube');
	  if (youtubeVideoBackground.length > 0) {
	    FabriqueApp.body.append('<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>');
	    window.onYouTubeIframeAPIReady = function() {
	      return youtubeVideoBackground.each(function(index, element) {
	        var player;
	        return player = new YT.Player(element, {
	          events: {
	            onReady: function(event) {
	              var videoBg, videoDuration, videoEl, videoPlayer;
	              videoPlayer = event.target;
	              videoEl = $(element);
	              videoBg = videoEl.closest('.fbq-background');
	              if (videoEl.data('sound') === 'muted' || !videoEl.is(':visible')) {
	                videoPlayer.mute();
	              }
	              videoPlayer.playVideo();
	              videoEl.addClass('loaded');
	              videoDuration = videoPlayer.getDuration();
	              setInterval(function() {
	                if (videoDuration - videoPlayer.getCurrentTime() <= 1) {
	                  return videoPlayer.seekTo(0, true);
	                }
	              }, 400);
	              videoBg.on('switchSlideBackgroundTo.fbq', function() {
	                return videoPlayer.playVideo();
	              });
	              return videoBg.on('switchSlideBackgroundFrom.fbq', function() {
	                return videoPlayer.pauseVideo();
	              });
	            }
	          }
	        });
	      });
	    };
	  }
	  $('.woocommerce-ordering').fbqShopDropdown();
	  $('#delivery_checkout_field').fbqPickerForm();
	  $('.variations-radio').fbqVariationRadio();
	  $('.fbq-product-gallery').fbqProductGallery();
	  $('.variations_form').fbqVariableProductImage();
	  $('.fbq-widget-contact-select').on('change', function(e) {
	    var currentSelect, selectedContact;
	    currentSelect = $(e.currentTarget);
	    selectedContact = parseInt(currentSelect.val());
	    return currentSelect.siblings().removeClass('active').filter("[data-contact=" + selectedContact + "]").addClass('active');
	  });
	  return $(document).on('click', function(e) {
	    if (!$(e.target).is('.fbq-post-share-button')) {
	      return $('.fbq-post-share-box').fadeOut();
	    }
	  });
	};

	FabriqueApp.navbars = function() {
	  FabriqueApp.navbar.fbqNavbar();
	  $('.fbq-side-navbar').fbqSideNavbar();
	  return FabriqueApp.navbarMobile.fbqNavbar({
	    mobile: true
	  });
	};

	FabriqueApp.fetchItems = function() {
	  return $('.fbq-item');
	};

	FabriqueApp.startItems = function() {
	  var items;
	  items = FabriqueApp.fetchItems();
	  return items.each(function(index, item) {
	    var result;
	    result = item.className.match(/js-item-(\S+)/);
	    if (!result) {
	      return;
	    }
	    item.fbqItem = result[1];
	    return FabriqueApp.initItem(item);
	  });
	};

	FabriqueApp.initItem = function(item) {
	  var el;
	  if (!item.fbqItem) {
	    return;
	  }
	  el = $(item);
	  switch (item.fbqItem) {
	    case 'accordion':
	      el.fbqAccordion();
	      break;
	    case 'blog':
	      el.fbqEntries();
	      break;
	    case 'custompost':
	      el.fbqEntries();
	      break;
	    case 'project':
	      el.fbqEntries();
	      break;
	    case 'product':
	      el.fbqEntries();
	      break;
	    case 'productcat':
	      el.fbqEntries();
	      break;
	    case 'bannertext':
	      el.fbqBannerText();
	      break;
	    case 'client':
	      if (el.hasClass('fbq-client--carousel')) {
	        el.find('.fbq-client-content').fbqCarousel();
	      }
	      break;
	    case 'countdown':
	      el.fbqCountdown();
	      break;
	    case 'testimonial':
	      if (el.hasClass('fbq-testimonial--carousel')) {
	        el.fbqCarousel();
	      }
	      break;
	    case 'featuredpost':
	      el.fbqFeaturedPost();
	      break;
	    case 'gallery':
	      el.fbqGallery();
	      break;
	    case 'milestone':
	      el.fbqMilestone();
	      break;
	    case 'modal':
	      el.fbqModal();
	      break;
	    case 'skill':
	      el.fbqSkill();
	      break;
	    case 'showmore':
	      return el.find('.js-showmore-button').on('click', function(e) {
	        e.preventDefault();
	        return el.toggleClass('active');
	      });
	    case 'slider':
	      el.fbqSlider();
	      break;
	    case 'tab':
	      el.fbqTab();
	      break;
	    case 'box':
	      el.fbqBox();
	      break;
	    case 'video':
	      return el.fbqVideo();
	  }
	};

	FabriqueApp.afterItems = function() {
	  var cookiesNotice, cookiesNoticeExp, hashArgs, hashArgsLength, hashIndex, hashTarget, hashTargetEl, hashType, loc, originalTarget, scrollH, scrollV, sidebarBackground;
	  $('.image-lazy-load').fbqImage();
	  sidebarBackground = $('.fbq-sidebar-background');
	  if (sidebarBackground) {
	    $(window).load(function() {
	      setTimeout(function() {
	        var height;
	        height = $('.fbq-main').outerHeight();
	        return sidebarBackground.css('height', height + "px");
	      }, 500);
	      return setTimeout(function() {
	        return sidebarBackground.css('height', '').addClass('fbq-sidebar-background-container');
	      }, 2000);
	    });
	  }
	  $('.fbq-row--main').fbqRow();
	  loc = window.location;
	  if (loc.hash) {
	    hashType = '';
	    hashIndex = 1;
	    hashTarget = loc.hash;
	    if (window.history.pushState) {
	      window.history.pushState('', '/', loc.pathname);
	    } else {
	      scrollV = document.body.scrollTop;
	      scrollH = document.body.scrollLeft;
	      loc.hash = '';
	      document.body.scrollTop = scrollV;
	      document.body.scrollLeft = scrollH;
	    }
	    hashArgs = hashTarget.slice(1).split('-');
	    hashArgsLength = hashArgs.length;
	    if (hashArgsLength > 1) {
	      hashType = hashArgs[0];
	      if (hashArgsLength > 2 && (hashType === 'tab' || hashType === 'accordion' || hashType === 'entries' || hashType === 'slider' || hashType === 'select')) {
	        originalTarget = hashTarget;
	        hashTarget = "#" + hashArgs[0] + "-" + hashArgs[1];
	        hashIndex = originalTarget.replace(hashTarget + "-", '');
	      }
	    }
	    hashTargetEl = $(hashTarget);
	    if (hashTargetEl.length) {
	      $(window).load(function() {
	        return setTimeout(function() {
	          return hashTargetEl.fbqDeepLink({
	            forceOpen: true,
	            targetType: hashType,
	            targetIndex: hashIndex
	          });
	        }, 500);
	      });
	    }
	  }
	  $('.js-back-to-top').fbqBackToTop();
	  cookiesNotice = $('.js-cookies-notice');
	  if (cookiesNotice.length) {
	    if (!Cookies.get('user-visit')) {
	      cookiesNoticeExp = cookiesNotice.data('expire' || 30);
	      Cookies.set('user-visit', 'visited', {
	        expires: cookiesNoticeExp
	      });
	      $(window).load(function() {
	        return cookiesNotice.addClass('active');
	      });
	    } else {
	      cookiesNotice.remove();
	    }
	  }
	  $('a:not(.add_to_cart_button)').fbqDeepLink();
	  $('.fbq-sidebar--fixed .fbq-widgets').fbqPinned({
	    referenceElement: '.fbq-main',
	    parentElement: '.fbq-content',
	    offset: -50
	  });
	  $('.fbq-comment').fbqComment();
	  return $(window).load(function() {
	    $('.fbq-wrapper--parallax-footer').fbqFooterParallax();
	    $('.fbq-background').fbqBackground();
	    return setTimeout(function() {
	      return $(window).resize();
	    }, 500);
	  });
	};

	module.exports = FabriqueApp;


/***/ },

/***/ 539:
/***/ function(module, exports) {

	// removed by extract-text-webpack-plugin

/***/ },

/***/ 540:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.accordion', {
	  options: {
	    multiple: false
	  },
	  _create: function() {
	    var self;
	    self = this;
	    this.element.children('.active').children('.fbq-accordion-body').show();
	    this._on(this.element.children('.fbq-accordion-panel').children('.fbq-accordion-heading'), {
	      'click': $.proxy(this._panelClicked, this)
	    });
	    return this.element.on('accordionOpen.fbq', function(e, index) {
	      return self.panelOpen(index);
	    });
	  },
	  _panelClicked: function(e) {
	    var el, index, previousIndex;
	    e.preventDefault();
	    el = $(e.currentTarget);
	    index = el.data('index');
	    previousIndex = this.element.children('.active').data('index');
	    return this.panelOpen(index, previousIndex);
	  },
	  panelOpen: function(index, previousIndex) {
	    var body, currentBody, currentPanel, multiple, panel;
	    if (!index) {
	      return;
	    }
	    multiple = this.element.data('multiple') || this.options.multiple;
	    panel = this.element.find('.fbq-accordion-panel');
	    body = panel.find('.fbq-accordion-body');
	    currentPanel = panel.filter("[data-index=" + index + "]");
	    currentBody = body.filter("[data-index=" + index + "]");
	    if (currentPanel.hasClass('active')) {
	      if (multiple) {
	        currentPanel.toggleClass('active');
	        currentBody.stop(true, true).slideToggle(300);
	        return currentBody.find('.fbq-item').trigger('hiddenClose.fbq');
	      }
	    } else {
	      if (multiple) {
	        currentPanel.toggleClass('active');
	        currentBody.stop(true, true).slideToggle(300);
	      } else {
	        body.stop(true, true).slideUp(300);
	        panel.removeClass('active');
	        currentBody.stop(true, true).slideDown(300);
	        currentPanel.addClass('active');
	        if (previousIndex) {
	          body.filter("[data-index=" + previousIndex + "]").find('.fbq-item').trigger('hiddenClose.fbq');
	        }
	      }
	      return currentBody.find('.fbq-item').trigger('hiddenOpen.fbq');
	    }
	  }
	});

	$.widget.bridge('fbqAccordion', $.fabrique.accordion);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 541:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.animated', {
	  options: {
	    item: '.anmt-item',
	    offset: 0.95,
	    duration: 800,
	    interval: 200
	  },
	  _create: function() {
	    var element, self;
	    self = this;
	    this.isResponsive = FabriqueApp.isResponsive;
	    this.isMobileOrTablet = FabriqueApp.isMobileOrTablet;
	    this.isHorizontalScroll = FabriqueApp.isHorizontalScroll;
	    this.isVerticalScroll = FabriqueApp.isVerticalScroll;
	    this.isHalfPageScroll = FabriqueApp.isHalfPageScroll;
	    this.tabletScreenWidth = FabriqueApp.tabletScreenWidth;
	    element = this.element;
	    return setTimeout(function() {
	      if (self.isHorizontalScroll || self.isVerticalScroll || self.isHalfPageScroll) {
	        self.initializeSlidePageAnimation(element);
	      } else {
	        self.initializeAnimation(element);
	      }
	      return element.addClass('container-animated');
	    }, 400);
	  },
	  initializeAnimation: function(element) {
	    var animatedInterval, anmtItemOffset, anmtItems, items, self, staggerInterval, staggerLength;
	    self = this;
	    staggerLength = 0;
	    anmtItems = [];
	    items = element.find(this.options.item);
	    anmtItemOffset = this.options.offset;
	    staggerInterval = this.options.interval;
	    items.each(function(index, el) {
	      var anmtItem, isStagger, itemHeight, itemOffsetTop, scrollTop;
	      anmtItem = $(el);
	      if (anmtItem.hasClass('animated')) {
	        return;
	      }
	      isStagger = anmtItem.hasClass('stagger');
	      itemHeight = anmtItem.outerHeight();
	      itemOffsetTop = anmtItem.offset().top;
	      scrollTop = $(window).scrollTop();
	      if (isStagger && itemOffsetTop + itemHeight > scrollTop) {
	        staggerLength++;
	      }
	      if ($(this).attr('data-animation-offset')) {
	        anmtItemOffset = parseFloat($(this).attr('data-animation-offset'));
	      }
	      if (scrollTop + $(window).height() * anmtItemOffset > itemOffsetTop) {
	        if (isStagger && itemOffsetTop + itemHeight > scrollTop) {
	          return anmtItems.push(anmtItem);
	        } else {
	          self.doAnimate(anmtItem);
	          return self.removeAnimate(anmtItem);
	        }
	      } else {
	        return $(window).scroll(function(e) {
	          itemHeight = anmtItem.outerHeight();
	          itemOffsetTop = anmtItem.offset().top;
	          scrollTop = $(window).scrollTop();
	          if (scrollTop + $(window).height() * anmtItemOffset > itemOffsetTop) {
	            if (isStagger && itemOffsetTop + itemHeight > scrollTop) {
	              anmtItems.push(anmtItem);
	            } else {
	              self.doAnimate(anmtItem);
	              self.removeAnimate(anmtItem);
	            }
	            return $(window).unbind('scroll', e.handleObj.handler, e);
	          }
	        });
	      }
	    });
	    return animatedInterval = setInterval((function() {
	      var itemToAnimate;
	      if (anmtItems.length > 0) {
	        itemToAnimate = anmtItems.shift();
	        self.doAnimate(itemToAnimate);
	        staggerLength--;
	        self.removeAnimate(itemToAnimate);
	      }
	      if (staggerLength <= 0) {
	        return clearInterval(animatedInterval);
	      }
	    }), staggerInterval);
	  },
	  initializeSlidePageAnimation: function(element) {
	    var firstContainer, firstContainerItems, items, lastContainer, lastContainerItems, mainColumns, self;
	    self = this;
	    firstContainer = '';
	    lastContainer = '';
	    if (this.isMobileOrTablet && this.isResponsive) {
	      return this.initializeAnimation(element);
	    } else {
	      this.windowWidth = $(window).width();
	      if (this.windowWidth <= this.tabletScreenWidth) {
	        this.initializeAnimation(element);
	      } else {
	        if (this.isHorizontalScroll || this.isVerticalScroll) {
	          items = FabriqueApp.mainWrapper.find('.fbq-section.slick-active').find(this.options.item);
	          this.setSlideAnimation(items);
	        } else {
	          mainColumns = FabriqueApp.mainWrapper.find('.fbq-row').first().children();
	          firstContainerItems = mainColumns.first().find('.fbq-box.slick-active').find(this.options.item);
	          lastContainerItems = mainColumns.last().find('.fbq-box.slick-active').find(this.options.item);
	          this.setSlideAnimation(firstContainerItems);
	          this.setSlideAnimation(lastContainerItems);
	        }
	        $(window).on('slidePageChanged.fbq', function(e, obj) {
	          self.setSlideAnimation(obj.nextSlide.find(self.options.item));
	          return setTimeout(function() {
	            return obj.prevSlide.find(self.options.item).removeClass('animated fbq-opacity1');
	          }, 300);
	        });
	      }
	      return $(window).on('resize', function() {
	        return self._windowResize();
	      });
	    }
	  },
	  _windowResize: function() {
	    var viewportWidth;
	    viewportWidth = $(window).width();
	    if (viewportWidth <= this.tabletScreenWidth && this.windowWidth > this.tabletScreenWidth) {
	      this.unsetSlideAnimation();
	    }
	    return this.windowWidth = viewportWidth;
	  },
	  setSlideAnimation: function(items) {
	    var animatedInterval, anmtItems, self, staggerInterval, staggerLength;
	    self = this;
	    staggerLength = 0;
	    anmtItems = [];
	    staggerInterval = this.options.interval;
	    items.each(function(index, el) {
	      var anmtItem;
	      anmtItem = $(el);
	      if (anmtItem.hasClass('stagger')) {
	        staggerLength++;
	        return anmtItems.push(anmtItem);
	      } else {
	        self.doAnimate(anmtItem);
	        return self.removeAnimate(anmtItem);
	      }
	    });
	    return animatedInterval = setInterval((function() {
	      var itemToAnimate;
	      if (anmtItems.length > 0) {
	        itemToAnimate = anmtItems.shift();
	        self.doAnimate(itemToAnimate);
	        staggerLength--;
	        self.removeAnimate(itemToAnimate);
	      }
	      if (staggerLength <= 0) {
	        return clearInterval(animatedInterval);
	      }
	    }), staggerInterval);
	  },
	  unsetSlideAnimation: function() {
	    var items, self;
	    self = this;
	    items = this.element.find(this.options.item);
	    return items.each(function(index, el) {
	      var anmtItem;
	      anmtItem = $(el);
	      if (!anmtItem.hasClass('animated')) {
	        return self.doAnimate(anmtItem);
	      }
	    });
	  },
	  doAnimate: function(item) {
	    var anmtDuration;
	    anmtDuration = this.options.duration;
	    if (item.attr('data-animation-duration')) {
	      anmtDuration = item.attr('data-animation-duration');
	      item.css({
	        'animation-duration': anmtDuration,
	        '-webkit-animation-duration': anmtDuration
	      });
	    }
	    item.addClass('animated fbq-opacity1');
	    return item.trigger('fbq.itemAnimated');
	  },
	  removeAnimate: function(item) {
	    var anmtDuration;
	    anmtDuration = this.options.duration;
	    if (item.attr('data-animation-duration')) {
	      anmtDuration = item.attr('data-animation-duration');
	    }
	    return setTimeout(function() {
	      return item.css({
	        'animation-duration': '',
	        '-webkit-animation-duration': ''
	      });
	    }, parseInt(anmtDuration));
	  }
	});

	$.widget.bridge('fbqAnimated', $.fabrique.animated);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 542:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.audio', {
	  options: {
	    duration: false
	  },
	  _create: function() {
	    if (this.element.find('.fbq-audio-player').length) {
	      this.audio = this.element.find('audio');
	      this.audioPlayer = this.element.children('.fbq-audio-player');
	      this.audioButton = this.element.find('.fbq-audio-button');
	      this._on(this.element, {
	        'click .fbq-audio-player': '_playerClicked'
	      });
	      return this._on(this.audio, {
	        'ended': '_audioEnded',
	        'play': '_audioPlayed',
	        'pause': '_audioPaused'
	      });
	    } else {

	    }
	  },
	  _playerClicked: function(e) {
	    if (this.audioPlayer.hasClass('pause')) {
	      return this._audioPlayed();
	    } else if (this.audioPlayer.hasClass('play')) {
	      return this._audioPaused();
	    }
	  },
	  _audioPlayed: function() {
	    this.audioPlayer.removeClass('pause').addClass('play');
	    this.audioButton.removeClass('twf-play').addClass('twf-pause');
	    return this.audio[0].play();
	  },
	  _audioPaused: function() {
	    this.audioPlayer.removeClass('play').addClass('pause');
	    this.audioButton.removeClass('twf-pause').addClass('twf-play');
	    return this.audio[0].pause();
	  },
	  _audioEnded: function() {
	    this.audioPlayer.removeClass('play').addClass('pause');
	    return this.audioButton.removeClass('twf-pause').addClass('twf-play');
	  }
	});

	$.widget.bridge('fbqAudio', $.fabrique.audio);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 543:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.background', {
	  options: {
	    enableMobileParallax: false,
	    contentfade: false,
	    speed: 0,
	    type: 'image',
	    ratio: 16 / 9,
	    offset: 10,
	    delayTime: 200
	  },
	  _create: function() {
	    var delayTime, enableMobileParallax, player, self, video, videoObject;
	    self = this;
	    delayTime = this.options.delayTime;
	    enableMobileParallax = this.element.data('mobileparallax') / 10 || this.options.enableMobileParallax;
	    this.fadeItem = this.element.data('contentfade') || this.options.contentfade;
	    this.parallaxSpeed = this.element.data('parallaxspeed') / 10 || this.options.speed;
	    this.type = this.element.data('type') || this.options.type;
	    this.wrapper = this.element.find('.fbq-background-wrapper');
	    if (this.element.hasClass('fbq-background--zoom-in') || this.element.hasClass('fbq-background--zoom-out')) {
	      this._animatedBackground();
	    }
	    if (FabriqueApp.isMobileOrTablet) {
	      this.element.find('.fbq-video-background-inner').remove();
	      if (enableMobileParallax) {
	        if (this.parallaxSpeed !== 0) {
	          this._setWrapperSize();
	          this._doParallax();
	          $(window).on('resize', function() {
	            clearTimeout(self.resizeTimer);
	            return self.resizeTimer = setTimeout(function() {
	              self._setWrapperSize();
	              return self._doParallax();
	            }, delayTime);
	          });
	          return $(window).on('scroll', function() {
	            return self._doParallax();
	          });
	        }
	      }
	    } else {
	      if (this.type === 'video') {
	        video = this.element.find('video');
	        videoObject = this.element.find('.fbq-video-background-inner');
	        if (video.length > 0) {
	          setTimeout(function() {
	            if (video[0].paused) {
	              return video[0].play();
	            }
	          }, 150);
	          if (!video.is(':visible')) {
	            video.prop('muted', true);
	          }
	          this.element.on('switchSlideBackgroundTo.fbq', function() {
	            return video[0].play();
	          });
	          this.element.on('switchSlideBackgroundFrom.fbq', function() {
	            return video[0].pause();
	          });
	        } else if (videoObject.length > 0 && videoObject.hasClass('fbq-video-background-inner--vimeo')) {
	          player = $f(videoObject[0]);
	          player.addEvent('ready', function() {
	            self.element.on('switchSlideBackgroundTo.fbq', function() {
	              return player.api('play');
	            });
	            self.element.on('switchSlideBackgroundFrom.fbq', function() {
	              return player.api('pause');
	            });
	            if (videoObject.data('sound') === 'muted' || !videoObject.is(':visible')) {
	              return player.api('setVolume', 0);
	            }
	          });
	        }
	        if (this.parallaxSpeed === 0) {
	          setTimeout(function() {
	            return self._setVideoBackgroundSize(videoObject, true);
	          }, delayTime);
	          return $(window).on('resize', function() {
	            clearTimeout(self.resizeTimer);
	            return self.resizeTimer = setTimeout(function() {
	              return self._setVideoBackgroundSize(videoObject);
	            }, delayTime);
	          });
	        } else {
	          this.parent = this.element.parent();
	          if (this.fadeItem) {
	            this.parent.addClass('fbq-fade-content');
	          }
	          setTimeout(function() {
	            return self._setVideoBackgroundSize(videoObject, true);
	          }, delayTime);
	          this._setWrapperSize();
	          this._doParallax();
	          $(window).on('resize', function() {
	            clearTimeout(self.resizeTimer);
	            return self.resizeTimer = setTimeout(function() {
	              self._setWrapperSize();
	              self._setVideoBackgroundSize(videoObject);
	              return self._doParallax();
	            }, delayTime);
	          });
	          return $(window).on('scroll', function() {
	            return self._doParallax();
	          });
	        }
	      } else {
	        if (this.parallaxSpeed !== 0) {
	          this.parent = this.element.parent();
	          if (this.fadeItem) {
	            this.parent.addClass('fbq-fade-content');
	          }
	          this._setWrapperSize();
	          this._doParallax();
	          $(window).on('resize', function() {
	            clearTimeout(self.resizeTimer);
	            return self.resizeTimer = setTimeout(function() {
	              self._setWrapperSize();
	              return self._doParallax();
	            }, delayTime);
	          });
	          $(window).on('scroll', function() {
	            return self._doParallax();
	          });
	        }
	        return this.element.on('switchSlideBackgroundTo.fbq', function() {
	          if (self.element.hasClass('animated')) {
	            self.element.removeClass('animated');
	            return setTimeout(function() {
	              return self.element.addClass('animated');
	            }, 50);
	          }
	        });
	      }
	    }
	  },
	  _animatedBackground: function() {
	    var element, item, sceneElement;
	    element = this.element;
	    item = element.closest('.fbq-item');
	    if (item.hasClass('anmt-item')) {
	      return item.on('fbq.itemAnimated', function() {
	        element.addClass('animated');
	        return item.off('fbq.itemAnimated');
	      });
	    } else {
	      sceneElement = new ScrollMagic.Scene({
	        triggerElement: element[0],
	        triggerHook: 'onEnter'
	      });
	      sceneElement.addTo(FabriqueApp.smController);
	      return sceneElement.on('enter', function() {
	        element.addClass('animated');
	        return sceneElement.destroy();
	      });
	    }
	  },
	  _setWrapperSize: function() {
	    var new_height;
	    new_height = this.element.outerHeight();
	    if (this.parallaxSpeed > 0) {
	      new_height += ($(window).height() - new_height) * this.parallaxSpeed;
	    } else if (this.parallaxSpeed < 0) {
	      new_height += ($(window).height() + new_height) * Math.abs(this.parallaxSpeed);
	    }
	    return this.wrapper.css('height', new_height + 'px');
	  },
	  _setVideoBackgroundSize: function(item, initial) {
	    var height, inputRatio, marginL, marginT, ratio, ratioArgs, width, wrapperH, wrapperW;
	    wrapperW = this.wrapper.width();
	    wrapperH = this.wrapper.height();
	    if (initial) {
	      item.addClass('loaded');
	    }
	    inputRatio = this.element.data('ratio');
	    if (inputRatio) {
	      inputRatio = inputRatio.toString();
	      ratioArgs = inputRatio.split(':');
	      ratio = ratioArgs.length === 2 ? parseInt(ratioArgs[0]) / parseInt(ratioArgs[1]) : this.options.ratio;
	    } else {
	      ratio = this.options.ratio;
	    }
	    if (wrapperW / wrapperH > ratio) {
	      width = wrapperW;
	      height = wrapperW / ratio;
	      marginL = 0;
	      marginT = (wrapperH - wrapperW / ratio) / 2;
	    } else {
	      width = wrapperH * ratio;
	      height = wrapperH;
	      marginL = (wrapperW - wrapperH * ratio) / 2;
	      marginT = 0;
	    }
	    item.css('width', width + "px");
	    item.css('height', height + this.options.offset + 'px');
	    item.css('margin-top', marginT - this.options.offset / 2 + 'px');
	    return item.css('margin-left', marginL + "px");
	  },
	  _doParallax: function() {
	    var height, offsetTop, scrollPos, scrollTop, windowH;
	    windowH = $(window).height();
	    scrollTop = $(window).scrollTop();
	    height = this.element.outerHeight();
	    offsetTop = this.element.offset().top;
	    if (scrollTop + windowH <= offsetTop || scrollTop >= offsetTop + height) {
	      return;
	    }
	    if (this.parallaxSpeed > 0) {
	      scrollPos = (scrollTop - offsetTop) * this.parallaxSpeed;
	    } else if (this.parallaxSpeed < 0) {
	      scrollPos = (scrollTop + windowH - offsetTop) * this.parallaxSpeed;
	    }
	    this.wrapper.css({
	      'transform': "translateY(" + scrollPos + "px)"
	    });
	    if (this.fadeItem) {
	      if (offsetTop + height - scrollTop < 2 * height / 3) {
	        if (!this.parent.hasClass('faded')) {
	          return this.parent.addClass('faded');
	        }
	      } else {
	        return this.parent.removeClass('faded');
	      }
	    }
	  }
	});

	$.widget.bridge('fbqBackground', $.fabrique.background);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 544:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.backToTop', {
	  options: {
	    duration: 1000,
	    delayTime: 100
	  },
	  _create: function() {
	    var delayTime, self, windowHeight;
	    self = this;
	    this.scrollTop = $(window).scrollTop();
	    this.scrollingToTop = false;
	    windowHeight = $(window).height();
	    delayTime = this.options.delayTime;
	    if (this.scrollTop > windowHeight) {
	      this.element.addClass('active');
	    }
	    $(window).on('scroll', function() {
	      return self._windowScroll();
	    });
	    return this.element.on('click', function(e) {
	      return self._buttonClicked(e);
	    });
	  },
	  _windowScroll: function() {
	    var scrollTop, windowHeight;
	    scrollTop = $(window).scrollTop();
	    windowHeight = $(window).height();
	    if (scrollTop > windowHeight && this.scrollTop <= windowHeight) {
	      this._buttonActive();
	    } else if (scrollTop <= windowHeight && this.scrollTop > windowHeight) {
	      this._buttonInactive();
	    }
	    return this.scrollTop = scrollTop;
	  },
	  _buttonActive: function() {
	    if (!this.element.hasClass('active')) {
	      return this.element.addClass('active');
	    }
	  },
	  _buttonInactive: function() {
	    if (this.element.hasClass('active')) {
	      return this.element.removeClass('active');
	    }
	  },
	  _buttonClicked: function(e) {
	    var duration, self;
	    e.preventDefault();
	    self = this;
	    duration = this.options.duration;
	    if (this.scrollTop > 0 && !this.scrollingToTop) {
	      this.scrollingToTop = true;
	      FabriqueApp.body.velocity('scroll', {
	        duration: duration,
	        easing: 'easeOut',
	        offset: -100
	      });
	      return setTimeout(function() {
	        return self.scrollingToTop = false;
	      }, duration);
	    }
	  }
	});

	$.widget.bridge('fbqBackToTop', $.fabrique.backToTop);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 545:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.bannertext', {
	  options: {
	    loop: false,
	    duration: 3000,
	    cursor: '|',
	    words: ['Text 1', 'Text 2', 'Text 3', 'Text 4']
	  },
	  _create: function() {
	    var cursor, dynamic, result, style, words;
	    result = this.element.attr('class').match(/fbq-bannertext--(\S+)/);
	    style = result ? result[1] : 'flip';
	    dynamic = this.element.find('.fbq-bannertext-dynamic-inner');
	    words = this.element.data('words').split(',' || this.options.words);
	    this.duration = this.element.data('duration' || this.options.duration);
	    if (this.element.data('loop')) {
	      this.loop = true;
	    } else {
	      this.loop = false;
	    }
	    if (style === 'flip') {
	      return this._flipAnimate(dynamic, words);
	    } else {
	      cursor = this.element.data('cursor' || this.options.cursor);
	      return dynamic.typed({
	        strings: words,
	        typeSpeed: 40,
	        backSpeed: 0,
	        startDelay: 200,
	        backDelay: this.duration,
	        loop: this.loop,
	        loopCount: false,
	        showCursor: true,
	        cursorChar: cursor,
	        attr: null
	      });
	    }
	  },
	  _flipAnimate: function(el, words) {
	    var back, front, i, noOfItems, self, thisLoop;
	    noOfItems = words.length;
	    thisLoop = this.loop;
	    el.append("<span class=\"fbq-bannertext-item\">" + words[0] + "</span>");
	    if (noOfItems > 1) {
	      el.append("<span class=\"fbq-bannertext-item\">" + words[1] + "</span>");
	      self = this;
	      front = el.find('.fbq-bannertext-item:first-child');
	      back = el.find('.fbq-bannertext-item:last-child');
	      i = 0;
	      return setInterval(function() {
	        if (thisLoop === false && i === noOfItems - 1) {
	          return;
	        }
	        el.toggleClass('flip');
	        if (noOfItems > 2) {
	          return setTimeout(function() {
	            var index;
	            index = self._wordIndexCalculate(i, noOfItems);
	            if (el.hasClass('flip')) {
	              front.text(words[index]);
	            } else {
	              back.text(words[index]);
	            }
	            return i++;
	          }, 500);
	        } else {
	          return i++;
	        }
	      }, this.duration);
	    }
	  },
	  _wordIndexCalculate: function(index, items) {
	    var convert, result;
	    convert = (index % items) + 2;
	    if (convert < items) {
	      result = convert;
	    } else {
	      result = convert - items;
	    }
	    return result;
	  }
	});

	$.widget.bridge('fbqBannerText', $.fabrique.bannertext);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 546:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.box', {
	  _create: function() {
	    if (this.element.hasClass('fbq-box--fit-height')) {
	      this.element.children('.fbq-box-inner').fbqSetSize();
	    }
	    if (this.element.hasClass('fbq-box--pinned')) {
	      this.element.fbqPinned();
	    }
	    if (this.element.hasClass('fbq-box--parallax-content')) {
	      return this.element.fbqParallaxContent({
	        items: this.element.find('.fbq-box-body').first().children()
	      });
	    }
	  }
	});

	$.widget.bridge('fbqBox', $.fabrique.box);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 547:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.carousel', {
	  options: {
	    dots: false,
	    fade: false,
	    infinite: true,
	    arrows: true,
	    prevArrow: '<span class="slick-prev fbq-carousel-arrow"><i class="twf twf-ln-arrow-left"></i></span>',
	    nextArrow: '<span class="slick-next fbq-carousel-arrow"><i class="twf twf-ln-arrow-right"></i></span>',
	    slidesToScroll: 1,
	    slidesToShow: 1,
	    autoplay: false,
	    pauseOnHover: true,
	    autoplaySpeed: 5000,
	    vertical: false,
	    responsive: [],
	    variableWidth: false,
	    centerMode: false
	  },
	  _create: function() {
	    var adaptiveHeight, carouselArrowBackground, carouselArrowStyle, centerMode, centerPadding, children, el, halfSlidePosition, isFullSlide, isHalfSlide, mobileScroll, playOnHover, self, sliderOption, sliderSpeed, tabletScroll, variableWidth;
	    self = this;
	    sliderOption = this.options;
	    children = this.element.children();
	    sliderOption.responsive = [];
	    carouselArrowStyle = this.options.carouselArrowStyle ? this.options.carouselArrowStyle : FabriqueApp.carouselArrowStyle;
	    carouselArrowBackground = this.options.carouselArrowBackground ? this.options.carouselArrowBackground : FabriqueApp.carouselArrowBackground;
	    sliderOption.prevArrow = "<span class=\"slick-prev fbq-carousel-arrow " + carouselArrowBackground + "\"><i class=\"twf twf-" + carouselArrowStyle + "-left\"></i></span>";
	    sliderOption.nextArrow = "<span class=\"slick-next fbq-carousel-arrow " + carouselArrowBackground + "\"><i class=\"twf twf-" + carouselArrowStyle + "-right\"></i></span>";
	    isFullSlide = this.options.isFullSlide ? this.options.isFullSlide : false;
	    isHalfSlide = this.options.isHalfSlide ? this.options.isHalfSlide : false;
	    halfSlidePosition = this.options.halfSlidePosition ? this.options.halfSlidePosition : 'left';
	    if (this.element.attr('data-display')) {
	      sliderOption.slidesToShow = this.element.data('display');
	    }
	    playOnHover = this.element.attr('data-play_on_hover');
	    if (playOnHover && playOnHover === 'true') {
	      sliderOption.pauseOnHover = false;
	    }
	    variableWidth = this.element.attr('data-variable_width');
	    if (variableWidth && variableWidth === 'true') {
	      sliderOption.variableWidth = true;
	    }
	    centerMode = this.element.attr('data-center_mode');
	    if (centerMode && centerMode === 'true') {
	      sliderOption.centerMode = true;
	      centerPadding = this.element.attr('data-center_padding');
	      if (centerPadding) {
	        sliderOption.centerPadding = centerPadding;
	      }
	    }
	    adaptiveHeight = this.element.attr('data-adaptive_height');
	    if (adaptiveHeight && adaptiveHeight === 'true') {
	      sliderOption.adaptiveHeight = true;
	    }
	    if (this.element.attr('data-scroll')) {
	      sliderOption.slidesToScroll = this.element.data('scroll');
	    } else {
	      sliderOption.slidesToScroll = sliderOption.slidesToShow;
	    }
	    if (FabriqueApp.isResponsive) {
	      if (sliderOption.slidesToShow > 4) {
	        if (sliderOption.slidesToScroll <= 4) {
	          tabletScroll = sliderOption.slidesToScroll;
	        } else {
	          tabletScroll = 4;
	        }
	        sliderOption.responsive.push({
	          breakpoint: 960,
	          settings: {
	            slidesToShow: 4,
	            slidesToScroll: tabletScroll
	          }
	        });
	      }
	      if (sliderOption.slidesToShow >= 3) {
	        if (sliderOption.slidesToScroll <= 2) {
	          mobileScroll = sliderOption.slidesToScroll;
	        } else {
	          mobileScroll = 2;
	        }
	        sliderOption.responsive.push({
	          breakpoint: 768,
	          settings: {
	            slidesToShow: 2,
	            slidesToScroll: mobileScroll
	          }
	        });
	      }
	      if (sliderOption.slidesToShow > 1) {
	        sliderOption.responsive.push({
	          breakpoint: 480,
	          settings: {
	            slidesToShow: 1,
	            slidesToScroll: 1,
	            adaptiveHeight: true,
	            variableWidth: false
	          }
	        });
	      }
	    }
	    if (this.element.attr('data-arrows')) {
	      sliderOption.arrows = this.element.data('arrows');
	    }
	    if (this.element.attr('data-indicator')) {
	      sliderOption.dots = this.element.data('indicator');
	    }
	    if (this.element.attr('data-loop')) {
	      sliderOption.infinite = this.element.data('loop');
	    }
	    if (this.element.attr('data-fade') && (sliderOption.slidesToScroll = 1)) {
	      sliderOption.fade = true;
	      sliderOption.cssEase = 'linear';
	    }
	    if (this.element.attr('data-duration')) {
	      sliderSpeed = this.element.data('duration');
	      if ($.isNumeric(sliderSpeed)) {
	        sliderOption.autoplay = true;
	        sliderOption.autoplaySpeed = sliderSpeed;
	      }
	    }
	    if (this.options.vertical === true) {
	      sliderOption.prevArrow = '<span class="slick-prev slick-prev--vertical"> <i class="twf twf-ln-arrow-up"></i> </span>';
	      sliderOption.nextArrow = '<span class="slick-next slick-next--vertical"> <i class="twf twf-ln-arrow-down"></i> </span>';
	    }
	    this.initializeCarousel(sliderOption);
	    el = this.element;
	    if (isFullSlide || isHalfSlide) {
	      this.element.on('beforeChange', function(event, slick, prevSlideIndex, nextSlideIndex) {
	        var nextSlide, nextSlideBg, prevSlide, prevSlideBg, slidePosition;
	        if (el.is(slick.$slider) && prevSlideIndex !== nextSlideIndex) {
	          nextSlide = $(slick.$slides.get(nextSlideIndex));
	          prevSlide = $(slick.$slides.get(prevSlideIndex));
	          nextSlideBg = nextSlide.children('.fbq-background');
	          prevSlideBg = prevSlide.children('.fbq-background');
	          nextSlideBg.trigger('switchSlideBackgroundTo.fbq');
	          prevSlideBg.trigger('switchSlideBackgroundFrom.fbq');
	          slidePosition = isHalfSlide ? halfSlidePosition : 'full';
	          return $(window).trigger('slidePageChanged.fbq', {
	            position: slidePosition,
	            prevIndex: prevSlideIndex,
	            nextIndex: nextSlideIndex,
	            prevSlide: prevSlide,
	            nextSlide: nextSlide
	          });
	        }
	      });
	    }
	    this.element.closest('.fbq-item').on('hiddenOpen.fbq', function() {
	      return el.slick('setPosition');
	    });
	    return this.element.on('resetScrollPage.fbq', function() {
	      return el.slick('reinit');
	    });
	  },
	  reposition: function() {
	    if (!this.element.hasClass('slider-ready')) {
	      return this.element.slick('setPosition').addClass('slider-ready');
	    } else {
	      return this.element.slick('setPosition');
	    }
	  },
	  initializeCarousel: function(options) {
	    if (!this.element.hasClass('slider-ready')) {
	      return this.element.slick(options).addClass('slider-ready');
	    } else {
	      return this.element.slick(options);
	    }
	  }
	});

	$.widget.bridge('fbqCarousel', $.fabrique.carousel);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 548:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.collapsedMenu', {
	  options: {
	    sidenavWidth: 280,
	    collapsedDelayTime: 50,
	    transitionDelayTime: 40,
	    transitionDuration: 800,
	    transitionEasing: [20, 10],
	    isParallaxFooter: false
	  },
	  _create: function() {
	    var self;
	    this.button = this.element.find('.fbq-collapsed-button');
	    if (!this.button.length) {
	      return;
	    }
	    self = this;
	    this.body = this.options.body ? this.options.body : $('body');
	    this.collapsedMenuStyle = this.element.data('collapsed_style') ? this.element.data('collapsed_style') : false;
	    if (this.collapsedMenuStyle !== 'offcanvas') {
	      this.collapsedMenu = this.element.find('.fbq-collapsed-menu');
	      this.transformElement = this.element;
	    } else {
	      this.collapsedMenu = this.element.siblings('.fbq-collapsed-menu');
	      this.transformElement = this.collapsedMenu;
	      this.offCanvasOverlay = this.element.siblings('.fbq-offcanvas-overlay');
	      this._on(this.offCanvasOverlay, {
	        'click': '_collapsedButtonClicked'
	      });
	    }
	    this.collapsedDelayTime = this.element.data('fixed') && this.collapsedMenuStyle === 'full' ? 400 : this.options.collapsedDelayTime;
	    this._on(this.button, {
	      'click': '_collapsedButtonClicked'
	    });
	    if (this.collapsedMenuStyle === 'full' || this.collapsedMenuStyle === 'classic') {
	      return this.element.on('closeCollapsedMenu.fbq', function(e) {
	        return self._closeCollapsedMenu();
	      });
	    }
	  },
	  _collapsedButtonClicked: function(e) {
	    e.preventDefault();
	    if (this.button.hasClass('fbq-closed')) {
	      return this._closeCollapsedMenu();
	    } else {
	      return this._openCollapsedMenu();
	    }
	  },
	  _closeCollapsedMenu: function() {
	    var self;
	    self = this;
	    this.collapsedMenu.removeClass('active');
	    this.button.removeClass('fbq-closed');
	    this.button.children().removeClass('fbq-p-bg-contrast-bg');
	    if (this.collapsedMenuStyle === 'classic') {
	      this.collapsedMenu.slideUp(500);
	    } else if (this.collapsedMenuStyle === 'full') {
	      this.body.removeClass('fbq-unscrollable');
	    } else if ((this.collapsedMenuStyle === 'minimal') || (this.collapsedMenuStyle === 'offcanvas')) {
	      this.body.removeClass('nav-opened fbq-unscrollable--horizontal');
	      if (this.offCanvasOverlay) {
	        this.offCanvasOverlay.removeClass('active');
	      }
	    }
	    return setTimeout(function() {
	      self.element.removeClass('opened');
	      return self.transformElement.removeClass('fbq-no-transform');
	    }, this.collapsedDelayTime);
	  },
	  _openCollapsedMenu: function() {
	    var body, collapsedMenu, collapsedMenuStyle, self;
	    self = this;
	    body = this.body;
	    collapsedMenu = this.collapsedMenu;
	    collapsedMenuStyle = this.collapsedMenuStyle;
	    if (!this.button.hasClass('fbq-closed')) {
	      this.button.addClass('fbq-closed');
	      this.button.children().addClass('fbq-p-bg-contrast-bg');
	    }
	    if (!this.element.hasClass('opened')) {
	      this.element.addClass('opened');
	    }
	    if (!this.transformElement.hasClass('fbq-no-transform')) {
	      this.transformElement.addClass('fbq-no-transform');
	    }
	    return setTimeout(function() {
	      var offset;
	      if (!collapsedMenu.hasClass('active')) {
	        collapsedMenu.addClass('active');
	        if (collapsedMenuStyle === 'classic') {
	          offset = 0;
	          if ($(window).width() > FabriqueApp.mobileScreenWidth && !FabriqueApp.isHeaderOnFrame) {
	            offset += FabriqueApp.frameWidth;
	          }
	          self.element.velocity('scroll', {
	            duration: 500,
	            easing: 'easeOut',
	            offset: offset
	          });
	          return collapsedMenu.slideDown(500);
	        } else if (collapsedMenuStyle === 'full') {
	          if (!body.hasClass('fbq-unscrollable')) {
	            return body.addClass('fbq-unscrollable');
	          }
	        } else if ((collapsedMenuStyle === 'minimal') || (collapsedMenuStyle === 'offcanvas')) {
	          if (!body.hasClass('fbq-unscrollable--horizontal')) {
	            body.addClass('fbq-unscrollable--horizontal');
	          }
	          if (!body.hasClass('sidenav-opened')) {
	            body.addClass('nav-opened');
	          }
	          if (self.offCanvasOverlay && !self.offCanvasOverlay.hasClass('active')) {
	            return self.offCanvasOverlay.addClass('active');
	          }
	        }
	      }
	    }, this.collapsedDelayTime);
	  }
	});

	$.widget.bridge('fbqCollapsedMenu', $.fabrique.collapsedMenu);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 549:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.comment', {
	  options: {
	    likeDislikeWrapper: '.comment-like-dislike',
	    likeDislikeButton: '.comment-like-dislike-button',
	    likeDislikeCounter: '.comment-like-dislike-number'
	  },
	  _create: function() {
	    var obj;
	    this.rating = this.element.find('#rating');
	    return this._on(this.element, (
	      obj = {
	        'click .js-comment-form-rating a': $.proxy(this._ratingClicked, this)
	      },
	      obj["click " + this.options.likeDislikeButton] = $.proxy(this._likeDislikeClicked, this),
	      obj
	    ));
	  },
	  _ratingClicked: function(e) {
	    var el;
	    e.preventDefault();
	    el = $(e.currentTarget);
	    el.siblings().removeClass('active');
	    if (!el.hasClass('active')) {
	      el.addClass('active');
	      return this.rating.val(el.text());
	    }
	  },
	  _likeDislikeClicked: function(e) {
	    var clicked, commentId, countNumber, counter, el, newCount, self, type, userIp;
	    e.preventDefault();
	    self = this;
	    el = $(e.currentTarget);
	    commentId = el.data('comment');
	    type = el.data('type');
	    userIp = el.data('user');
	    clicked = el.data('clicked');
	    counter = el.siblings(this.options.likeDislikeCounter);
	    countNumber = counter.html();
	    newCount = parseInt(countNumber) + 1;
	    if (clicked) {

	    } else {
	      return $.ajax({
	        type: 'post',
	        url: FabriqueApp.ajaxUrl,
	        data: {
	          comment: commentId,
	          action: 'comment_like_dislike',
	          type: type,
	          _wpnonce: FabriqueApp.ajaxNonce,
	          user: userIp
	        },
	        beforeSend: function(xhr) {
	          return counter.html(newCount);
	        },
	        success: function(res) {
	          var latestCount;
	          res = $.parseJSON(res);
	          if (res.success) {
	            self.buttonClicked = true;
	            el.closest(self.options.likeDislikeWrapper).find(self.options.likeDislikeButton).data('clicked', 1);
	            latestCount = res.latest_count;
	            return counter.html(latestCount);
	          }
	        }
	      });
	    }
	  }
	});

	$.widget.bridge('fbqComment', $.fabrique.comment);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 550:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.countdown', {
	  options: {
	    timestamp: 0
	  },
	  _create: function() {
	    var result, self, style;
	    self = this;
	    result = this.element.attr('class').match(/fbq-countdown--(\S+)/);
	    style = result ? result[1] : 'group';
	    if (style === 'group') {
	      this.digitClass = 'digit';
	    } else {
	      this.digitClass = 'digit fbq-s-text-bg';
	    }
	    this.timestamp = this.element.data('timestamp') || this.options.timestamp;
	    return setInterval(function() {
	      return self._tick();
	    }, 300);
	  },
	  _tick: function() {
	    var d, h, left, m, w;
	    w = 7 * 24 * 60 * 60;
	    d = 24 * 60 * 60;
	    h = 60 * 60;
	    m = 60;
	    left = Math.floor((this.timestamp - Date.now()) / 1000);
	    if (left < 0) {
	      left = 0;
	      return;
	    }
	    if (this.element.find(".fbq-countdown-item[data-label='week']").length) {
	      this.week = Math.floor(left / w);
	      left -= this.week * w;
	      this._updateTimer('week', this.week);
	    }
	    if (this.element.find(".fbq-countdown-item[data-label='day']").length) {
	      this.day = Math.floor(left / d);
	      left -= this.day * d;
	      this._updateTimer('day', this.day);
	    }
	    this.hour = Math.floor(left / h);
	    left -= this.hour * h;
	    this._updateTimer('hour', this.hour);
	    this.minute = Math.floor(left / m);
	    left -= this.minute * m;
	    this._updateTimer('minute', this.minute);
	    this.second = left;
	    return this._updateTimer('second', this.second);
	  },
	  _updateTimer: function(label, value) {
	    var digits;
	    digits = String(value).split('');
	    if (digits.length < 2) {
	      digits.unshift('0');
	      return this._updateDigit(digits, label);
	    } else {
	      return this._updateDigit(digits, label);
	    }
	  },
	  _updateDigit: function(digits, label) {
	    var digitClass, el, length, number, self;
	    self = this;
	    el = this.element.find(".fbq-countdown-item[data-label=" + label + "]");
	    number = el.find('.fbq-countdown-number');
	    if (el.find('.digit').length === 0) {
	      digitClass = this.digitClass;
	      $.each(digits, function(key, value) {
	        var digit;
	        digit = "<span class=\"digit-container\">\n   <span class=\"" + digitClass + "\" data-digit=\"" + value + "\">" + value + "</span>\n</span>";
	        return $(digit).appendTo(number);
	      });
	    } else {
	      length = digits.length;
	      if (el.find('.digit').length > digits.length) {
	        el.find('.digit-container').eq(0).remove();
	      }
	      $.each(digits, function(key, value) {
	        var digit;
	        digit = el.find('.digit-container').eq(key).find('.digit');
	        value = parseInt(value);
	        if (value === digit.data('digit')) {
	          return;
	        }
	        digit.data('digit', value);
	        return digit.text(value);
	      });
	    }
	    if (this.element.attr('data-background-color')) {
	      this.element.find('.digit').css('background-color', this.element.data('background-color'));
	    }
	    if (this.element.attr('data-border-radius')) {
	      return this.element.find('.digit').css('border-radius', this.element.data('border-radius') + 'px');
	    }
	  }
	});

	$.widget.bridge('fbqCountdown', $.fabrique.countdown);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 551:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.counter', {
	  options: {
	    startAt: 0,
	    easing: 'swing',
	    duration: 2000
	  },
	  _create: function() {
	    this.startAt = this.element.data('start') || this.options.startAt;
	    return this._animate();
	  },
	  _animate: function() {
	    var decimal, decimalLength, el, elString, number, prefix, result, self, suffix, text;
	    self = this;
	    el = this.element;
	    elString = el.text().toString();
	    if (elString.indexOf(',') >= 0) {
	      number = elString.replace(/[^0-9,]/g, '');
	      result = parseInt(number.replace(/,/g, ''), 10);
	      text = elString.split(number);
	      prefix = text[0] || "";
	      suffix = text[1] || "";
	      if (number.length && text.length > 1) {
	        el.text(prefix + this.startAt + suffix);
	        el.prop('counter', this.startAt);
	        return el.animate({
	          counter: result
	        }, {
	          duration: this.options.duration,
	          easing: this.options.easing,
	          step: function() {
	            return el.text(self._commaSeparateNumber(Math.round(this.counter), prefix, suffix));
	          },
	          complete: function() {
	            return el.text(prefix + self._commaSeparateNumber(Math.round(result)) + suffix);
	          }
	        });
	      }
	    } else {
	      number = elString.replace(/[^0-9.]/g, '');
	      decimal = number.split('.')[1] ? number.split('.')[1] : 0;
	      decimalLength = decimal ? decimal.toString().length : 0;
	      result = parseFloat(number).toFixed(decimalLength);
	      text = elString.split(number);
	      prefix = text[0] || "";
	      suffix = text[1] || "";
	      if (number.length) {
	        el.prop('counter', this.startAt);
	        return el.animate({
	          counter: result
	        }, {
	          duration: this.options.duration,
	          easing: this.options.easing,
	          step: function(now) {
	            return el.text(prefix + parseFloat(now).toFixed(decimalLength) + suffix);
	          },
	          complete: function() {
	            return el.text(prefix + result + suffix);
	          }
	        });
	      }
	    }
	  },
	  _commaSeparateNumber: function(val, prefix, suffix) {
	    var value;
	    while (/(\d+)(\d{3})/.test(val.toString())) {
	      value = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
	      if (!prefix && !suffix) {
	        return value;
	      } else if (prefix && suffix) {
	        return prefix + value + suffix;
	      } else if (prefix) {
	        return prefix + value;
	      } else if (suffix) {
	        return value + suffix;
	      }
	    }
	  }
	});

	$.widget.bridge('fbqCounter', $.fabrique.counter);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 552:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.deepLink', {
	  options: {
	    target: '',
	    targetType: '',
	    targetIndex: 1,
	    forceOpen: false,
	    duration: 800,
	    offset: 0
	  },
	  _create: function() {
	    var collapsedNav, embedTarget, result, self, target, targetArgs, targetEl, targetIndex, targetLength, targetType;
	    self = this;
	    this.clicked = false;
	    this.mobileScreenWidth = FabriqueApp.mobileScreenWidth;
	    this.tabletScreenWidth = FabriqueApp.tabletScreenWidth;
	    this.isHorizontalScroll = FabriqueApp.isHorizontalScroll;
	    this.isVerticalScroll = FabriqueApp.isVerticalScroll;
	    this.isHalfPageScroll = FabriqueApp.isHalfPageScroll;
	    this.isResponsive = FabriqueApp.isResponsive;
	    this.isMobileOrTablet = FabriqueApp.isMobileOrTablet;
	    if (this.options.forceOpen) {
	      if (this.options.targetType === 'modal') {
	        this.initializeModal(this.element);
	      } else {
	        this.initializeDeepLink(this.element, this.options.targetType, this.options.targetIndex);
	      }
	    } else {
	      target = this.element.attr('href');
	      if (!target) {
	        return;
	      }
	      if (target.length <= 1) {
	        return;
	      }
	      if (target.charAt(0) === '#') {
	        if (target === '#js-close-all') {
	          targetEl = this.element.closest('.js-close-all');
	          this.element.on('click', function(e) {
	            e.preventDefault();
	            return self.closeAll(targetEl);
	          });
	        } else if ((result = target.match(/^#embed\((\S+)\)/))) {
	          embedTarget = result[1];
	          if (embedTarget.indexOf('.png') >= 0 || embedTarget.indexOf('.jpg') >= 0 || embedTarget.indexOf('.gif') >= 0 || embedTarget.indexOf('.tif') >= 0 || embedTarget.indexOf('.svg') >= 0) {
	            this.imageModal(embedTarget);
	            return;
	          } else {
	            this.embedModal(embedTarget);
	            return;
	          }
	        } else {
	          targetType = '';
	          targetIndex = this.options.targetIndex;
	          targetArgs = target.slice(1).split('-');
	          targetLength = targetArgs.length;
	          if (targetLength > 1) {
	            targetType = targetArgs[0];
	            if (targetLength > 2 && (targetType === 'tab' || targetType === 'accordion' || targetType === 'entries' || targetType === 'slider' || targetType === 'select')) {
	              targetEl = "#" + targetArgs[0] + "-" + targetArgs[1];
	              targetIndex = target.replace(targetEl + "-", '');
	              targetEl = $(targetEl);
	            } else {
	              targetEl = $(target);
	            }
	          } else {
	            targetEl = $(target);
	          }
	          if (targetEl.length) {
	            if (targetType === 'modal') {
	              this.element.on('click', function(e) {
	                e.preventDefault();
	                return self.initializeModal(targetEl);
	              });
	            } else {
	              collapsedNav = this.element.closest('nav');
	              this.element.on('click', function(e) {
	                e.preventDefault();
	                self.initializeDeepLink(targetEl, targetType, targetIndex);
	                if (collapsedNav.length) {
	                  return collapsedNav.trigger('closeCollapsedMenu.fbq');
	                }
	              });
	              this.anchorLink(targetEl);
	            }
	          }
	        }
	      } else {

	      }
	    }
	  },
	  initializeModal: function(targetEl) {
	    return targetEl.trigger('modalOpen.fbq');
	  },
	  initializeDeepLink: function(targetEl, targetType, targetIndex) {
	    if (targetEl.length) {
	      if (targetType === 'interactive') {
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	        targetEl.toggleClass('interactive-active');
	      } else if (targetType === 'tab') {
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	        targetEl.trigger('tabOpen.fbq', targetIndex);
	      } else if (targetType === 'accordion') {
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	        targetEl.trigger('accordionOpen.fbq', targetIndex);
	      } else if (targetType === 'entries') {
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	        targetEl.trigger('filterClicked.fbq', targetIndex);
	      } else if (targetType === 'slider') {
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	        targetEl.slick('slickGoTo', targetIndex - 1);
	      } else if (targetType === 'select') {
	        targetEl.val(targetIndex);
	        if (!this.scrolling) {
	          this.scrollTo(targetEl, this.options.duration);
	        }
	      } else if (!this.scrolling) {
	        this.scrollTo(targetEl, this.options.duration);
	      }
	      if (targetEl.closest('.fbq-modal').length) {
	        return targetEl.closest('.fbq-modal').trigger('modalOpen.fbq');
	      } else if (targetEl.closest('.fbq-interactive').length) {
	        targetEl.closest('.fbq-interactive').toggleClass('interactive-active');
	        if (!this.scrolling) {
	          return this.scrollTo(targetEl, this.options.duration);
	        }
	      } else if (targetEl.closest('.fbq-tab').length) {
	        targetEl.closest('.fbq-tab').trigger('tabOpen.fbq', targetEl.closest('.fbq-tab-content').data('index'));
	        if (!this.scrolling) {
	          return this.scrollTo(targetEl, this.options.duration);
	        }
	      } else if (targetEl.closest('.fbq-accordion').length) {
	        targetEl.closest('.fbq-accordion').trigger('accordionOpen.fbq', targetEl.closest('.fbq-accordion-body').data('index'));
	        if (!this.scrolling) {
	          return this.scrollTo(targetEl, this.options.duration);
	        }
	      }
	    }
	  },
	  scrollTo: function(targetEl, duration) {
	    var boxIndex, colIndex, currentBox, currentSection, firstContainer, firstIndex, firstRow, lastContainer, lastIndex, mainNavbar, mainNavbarMobile, mainRow, offset, self, slides, windowWidth;
	    self = this;
	    this.scrolling = true;
	    setTimeout(function() {
	      return self.scrolling = false;
	    }, duration);
	    windowWidth = $(window).width();
	    if (!this.isMobileOrTablet && (this.isHorizontalScroll || this.isVerticalScroll) && (!this.isResponsive || (this.isResponsive && windowWidth > this.tabletScreenWidth))) {
	      currentSection = targetEl.hasClass('fbq-section') && targetEl.hasClass('slick-slide') ? targetEl : targetEl.closest('.fbq-section.slick-slide');
	      if (!currentSection.hasClass('slick-active')) {
	        return setTimeout(function() {
	          return $('.fbq-main-wrapper').slick('slickGoTo', currentSection.data('index'));
	        }, 200);
	      }
	    } else if (!this.isMobileOrTablet && this.isHalfPageScroll && (!this.isResponsive || (this.isResponsive && windowWidth > this.tabletScreenWidth))) {
	      firstRow = $('.fbq-main-wrapper').find('.fbq-row').first();
	      mainRow = firstRow.children();
	      if (mainRow.length !== 2) {
	        return;
	      }
	      firstContainer = mainRow.first();
	      lastContainer = mainRow.last();
	      slides = lastContainer.find('.fbq-box.slick-slide').length;
	      currentBox = targetEl.hasClass('fbq-box') && targetEl.hasClass('slick-slide') ? targetEl : targetEl.closest('.fbq-box.slick-slide');
	      colIndex = currentBox.closest('div[class^=fbq-col-]').prevAll().length;
	      boxIndex = currentBox.prevAll().length;
	      if (!currentBox.hasClass('slick-active')) {
	        if (colIndex === 0) {
	          firstIndex = boxIndex;
	          lastIndex = slides - boxIndex - 1;
	        } else {
	          firstIndex = slides - boxIndex - 1;
	          lastIndex = boxIndex;
	        }
	        return setTimeout(function() {
	          firstContainer.slick('slickGoTo', firstIndex);
	          return lastContainer.slick('slickGoTo', lastIndex);
	        }, 200);
	      }
	    } else {
	      duration = duration ? duration : this.options.duration;
	      mainNavbar = FabriqueApp.mainNavbar;
	      mainNavbarMobile = FabriqueApp.mainNavbarMobile;
	      offset = this.getScrollOffset(windowWidth);
	      targetEl.velocity('scroll', {
	        duration: duration,
	        easing: 'easeOut',
	        offset: -offset + 1
	      });
	      return setTimeout(function() {
	        if (mainNavbar.data('autohide')) {
	          mainNavbar.css('top', '');
	          mainNavbar.css('transform', '');
	        }
	        if (mainNavbarMobile.data('autohide')) {
	          mainNavbarMobile.css('top', '');
	          return mainNavbarMobile.css('transform', '');
	        }
	      }, duration);
	    }
	  },
	  anchorLink: function(targetEl) {
	    var currentSlide, isNavbarMobile, menuItem, menuParents, offset, scene, self, windowWidth;
	    this.menu = this.element.closest('.fbq-menu');
	    if (!this.menu.length) {
	      return;
	    }
	    self = this;
	    isNavbarMobile = this.menu.closest('.fbq-navbar--mobile').length ? true : false;
	    windowWidth = $(window).width();
	    if (!this.isMobileOrTablet && !isNavbarMobile && (this.isHorizontalScroll || this.isVerticalScroll || this.isHalfPageScroll) && (!this.isResponsive || (this.isResponsive && windowWidth > this.tabletScreenWidth))) {
	      if (this.isHalfPageScroll) {
	        currentSlide = targetEl.closest('.fbq-box.slick-slide');
	      } else {
	        currentSlide = targetEl.closest('.fbq-section.slick-slide');
	      }
	      menuItem = this.element.parent();
	      menuParents = menuItem.parents('.menu-item');
	      if (currentSlide.hasClass('slick-active')) {
	        menuItem.addClass('current-menu-item');
	        if (menuParents.length > 0) {
	          menuParents.addClass('current-menu-parent');
	        }
	      }
	      return $(window).on('slidePageChanged.fbq', function(e, obj) {
	        var nextParent, nextParents, nextTarget, nextTargetMenu;
	        nextTarget = obj.nextSlide.attr('id');
	        if (nextTarget) {
	          menuItem.removeClass('current-menu-item');
	          if (menuParents.length > 0) {
	            menuParents.removeClass('current-menu-parent');
	          }
	          nextTargetMenu = self.menu.find("a[href='#" + nextTarget + "']");
	          if (nextTargetMenu.length > 0) {
	            nextParent = nextTargetMenu.parent();
	            nextParent.addClass('current-menu-item');
	            nextParents = nextParent.parents('.menu-item');
	            if (nextParents.length > 0) {
	              return nextParents.addClass('current-menu-parent');
	            }
	          }
	        }
	      });
	    } else {
	      offset = this.getScrollOffset(windowWidth);
	      scene = new ScrollMagic.Scene({
	        triggerElement: targetEl[0],
	        triggerHook: 'onLeave',
	        duration: targetEl.outerHeight(),
	        offset: -offset
	      });
	      scene.setClassToggle(this.element.parent()[0], 'current-menu-item').addTo(FabriqueApp.smController);
	      return $(window).on('resize', function(e) {
	        clearTimeout(self.resizeTimer);
	        return self.resizeTimer = setTimeout(function() {
	          return self.updateScrollScene(targetEl, scene);
	        }, 500);
	      });
	    }
	  },
	  updateScrollScene: function(targetEl, scene) {
	    var duration, offset;
	    duration = targetEl.outerHeight();
	    scene.duration(duration);
	    offset = this.getScrollOffset($(window).width());
	    return scene.offset(-offset);
	  },
	  getScrollOffset: function(windowWidth) {
	    var mainNavbar, mainNavbarMobile, offset;
	    mainNavbar = FabriqueApp.mainNavbar;
	    mainNavbarMobile = FabriqueApp.mainNavbarMobile;
	    offset = 0;
	    if (windowWidth > this.mobileScreenWidth && !FabriqueApp.isHeaderOnFrame) {
	      offset += FabriqueApp.frameWidth;
	    }
	    if (windowWidth > this.tabletScreenWidth && mainNavbar.data('fixed') && !mainNavbar.hasClass('fixed-transparent')) {
	      if (mainNavbar.data('transition') !== 'default' && mainNavbar.data('height_fixed')) {
	        offset += mainNavbar.data('height_fixed');
	      } else if (mainNavbar.attr('data-stacked_menu_height')) {
	        offset += mainNavbar.data('stacked_menu_height');
	      } else {
	        offset += mainNavbar.outerHeight();
	      }
	    } else if (windowWidth <= this.tabletScreenWidth && mainNavbarMobile.data('fixed') && !mainNavbarMobile.hasClass('fixed-transparent')) {
	      offset += mainNavbarMobile.outerHeight();
	    }
	    return offset;
	  },
	  closeAll: function(targetEl) {
	    return targetEl.fadeOut(function() {
	      return $(this).remove();
	    });
	  },
	  embedModal: function(target) {
	    return this.element.fbqPhotoSwipe({
	      type: 'iframe',
	      target: target
	    });
	  },
	  imageModal: function(target) {
	    return this.element.fbqPhotoSwipe({
	      type: 'image',
	      target: target
	    });
	  }
	});

	$.widget.bridge('fbqDeepLink', $.fabrique.deepLink);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 553:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.dynamicMenuColor', {
	  options: {
	    mobile: false,
	    isSidenav: false,
	    refPosition: 'left'
	  },
	  _create: function() {
	    var allSchemes, controller, defaultScheme, element, frameWidth, isMobileNavbar, isSidenav, navbarClass, navbarHeight, offset, refPosition, section, transition;
	    element = this.element;
	    isSidenav = this.options.isSidenav;
	    isMobileNavbar = this.options.mobile;
	    defaultScheme = FabriqueApp.defaultScheme;
	    controller = FabriqueApp.smController;
	    frameWidth = FabriqueApp.frameWidth;
	    allSchemes = [];
	    navbarClass = 'navbar-';
	    if ((FabriqueApp.isHorizontalScroll || FabriqueApp.isVerticalScroll) && !isMobileNavbar) {
	      section = $('.js-dynamic-navbar').filter(':visible');
	      section.each(function(index, el) {
	        var currentScheme;
	        currentScheme = $(el).data('scheme');
	        if (currentScheme) {
	          return allSchemes.push(currentScheme);
	        } else {
	          return allSchemes.push(defaultScheme);
	        }
	      });
	      element.addClass("fbq-" + navbarClass + "-" + allSchemes[0]);
	      return $(window).on('slidePageChanged.fbq', function(e, obj) {
	        return element.removeClass("fbq-" + navbarClass + "-dark fbq-" + navbarClass + "-light").addClass("fbq-" + navbarClass + "-" + allSchemes[obj.nextIndex]);
	      });
	    } else if (FabriqueApp.isHalfPageScroll && !isMobileNavbar) {
	      refPosition = this.options.refPosition;
	      $(window).on('doneSetHalfSlide.fbq', function(e, obj) {
	        if (refPosition === 'right') {
	          section = obj.rightBoxes;
	          section.each(function(index, el) {
	            var currentScheme;
	            currentScheme = $(el).data('scheme');
	            if (currentScheme) {
	              return allSchemes.push(currentScheme);
	            } else {
	              return allSchemes.push(defaultScheme);
	            }
	          });
	          element.addClass("fbq-" + navbarClass + "-" + allSchemes[allSchemes.length - 1]);
	        } else {
	          section = obj.leftBoxes;
	          section.each(function(index, el) {
	            var currentScheme;
	            currentScheme = $(el).data('scheme');
	            if (currentScheme) {
	              return allSchemes.push(currentScheme);
	            } else {
	              return allSchemes.push(defaultScheme);
	            }
	          });
	          element.addClass("fbq-" + navbarClass + "-" + allSchemes[0]);
	        }
	        return $(window).off('doneSetHalfSlide.fbq');
	      });
	      return $(window).on('slidePageChanged.fbq', function(e, object) {
	        if (object.position === refPosition) {
	          return element.removeClass("fbq-" + navbarClass + "-dark fbq-" + navbarClass + "-light").addClass("fbq-" + navbarClass + "-" + allSchemes[object.nextIndex]);
	        }
	      });
	    } else {
	      section = $('.js-dynamic-navbar').filter(':visible');
	      if (!isMobileNavbar) {
	        if (!isSidenav) {
	          if (this.element.attr('data-fixed')) {
	            transition = this.element.data('transition');
	            navbarHeight = transition === 'default' ? this.element.outerHeight() : this.element.data('height_fixed');
	            offset = -navbarHeight / 2 - frameWidth;
	          } else {
	            offset = -this.element.outerHeight() / 2 - frameWidth;
	          }
	        } else {
	          offset = -frameWidth - 40;
	        }
	      } else {
	        offset = -30;
	      }
	      return section.each(function(index, el) {
	        var currentScheme, currentSection, scene;
	        currentSection = $(el);
	        currentScheme = currentSection.data('scheme');
	        if (currentScheme) {
	          allSchemes.push(currentScheme);
	        } else {
	          allSchemes.push(defaultScheme);
	        }
	        scene = new ScrollMagic.Scene({
	          triggerElement: currentSection[0],
	          triggerHook: 'onLeave',
	          offset: offset
	        });
	        scene.addTo(controller);
	        scene.on('enter', function() {
	          return element.removeClass("fbq-" + navbarClass + "-dark fbq-" + navbarClass + "-light").addClass("fbq-" + navbarClass + "-" + allSchemes[index]);
	        });
	        return scene.on('leave', function() {
	          if (index !== 0) {
	            return element.removeClass("fbq-" + navbarClass + "-dark fbq-" + navbarClass + "-light").addClass("fbq-" + navbarClass + "-" + allSchemes[index - 1]);
	          } else {
	            return element.removeClass("fbq-" + navbarClass + "-dark fbq-" + navbarClass + "-light");
	          }
	        });
	      });
	    }
	  }
	});

	$.widget.bridge('fbqDynamicMenuColor', $.fabrique.dynamicMenuColor);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 554:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.entries', {
	  options: {
	    filter: null,
	    entryClass: '.fbq-entry',
	    entryInnerClass: '.fbq-entry-inner',
	    isotopeOptions: {
	      itemSelector: '.fbq-entry',
	      hiddenStyle: {
	        opacity: 0,
	        transform: 'scale(0.1)'
	      },
	      visibleStyle: {
	        opacity: 1,
	        transform: 'scale(1)'
	      }
	    }
	  },
	  _create: function() {
	    var filterSorting, initialActiveSelector, self;
	    self = this;
	    this.style = this.element.data('layout') ? this.element.data('layout') : 'grid';
	    this.filterBar = this.element.find('.fbq-filter-bar');
	    this.hasFilter = this.filterBar.length ? true : false;
	    this.initial_entry = this.element.find(this.options.entryClass);
	    this.isAnimatedItem = this.element.find(this.options.entryInnerClass).hasClass('anmt-item');
	    this.content = this.element.find('.fbq-entries-content');
	    filterSorting = this.content.data('filter_sorting');
	    this.filterSorting = filterSorting ? filterSorting : 'default';
	    this.currentFilter = 'all';
	    if (this.style === 'carousel') {
	      return this.content.fbqCarousel();
	    } else {
	      this.isotopeOptions = this.options.isotopeOptions;
	      this.pagination = this.element.find('.js-load-more');
	      this.paginationInput = this.pagination.find('input[type=hidden]');
	      if (this.hasFilter) {
	        initialActiveSelector = this.element.find('.js-filter-list.active');
	        if (initialActiveSelector.data('filter') !== 'all') {
	          this.filter = initialActiveSelector.data('filter');
	        }
	      }
	      this._runIsotope();
	      $(window).on('resize', function() {
	        if (self.style === 'masonry') {
	          return self._masonryIsotopeUpdate();
	        } else {
	          return self.content.isotope();
	        }
	      });
	      this.element.on('hiddenOpen.fbq', function() {
	        if (self.style === 'masonry') {
	          return self._masonryIsotopeUpdate();
	        } else {
	          return self.content.isotope();
	        }
	      });
	      if (this.pagination.length) {
	        this.pagination.fbqPaginate({
	          action: "fabrique_entries"
	        });
	        if (this.hasFilter) {
	          this.currentCat = [];
	          this.filterBar.find('.js-filter-list').each(function(index, el) {
	            return self.currentCat.push($(this).data('filter'));
	          });
	        }
	        this.initial_entry.addClass('loaded');
	        return this.pagination.on('load.fbqpagination', $.proxy(this._paginationLoaded, this));
	      }
	    }
	  },
	  _paginationLoaded: function(e, data) {
	    var els, filterCat, items, lazyLoadImages, newCat, newEntry, self;
	    if (!data.result) {
	      this.pagination.find('.btnx-text').text('error');
	      return this.pagination.addClass('error');
	    } else {
	      self = this;
	      items = $(data.result.content);
	      els = [];
	      newCat = [];
	      filterCat = [];
	      items.each(function(index, el) {
	        if (el.nodeType === 1) {
	          els.push(el);
	          if (self.hasFilter) {
	            return newCat.push($(this).data('filter'));
	          }
	        }
	      });
	      if (this.hasFilter) {
	        $.each(newCat, function(i, value) {
	          var eachCat;
	          if (value) {
	            if (value.indexOf(',') > -1) {
	              eachCat = value.split(', ');
	            } else {
	              eachCat = [value];
	            }
	            return filterCat = filterCat.concat(eachCat);
	          }
	        });
	      }
	      this.content.isotope('insert', els);
	      this.content.isotope('layout');
	      setTimeout(function() {
	        return self._animateItems();
	      }, 200);
	      if (this.hasFilter) {
	        this._addMoreFilters($.unique(filterCat));
	      }
	      newEntry = this.element.find('.fbq-entry:not(.loaded)');
	      newEntry.addClass('loaded');
	      lazyLoadImages = newEntry.find('.image-lazy-load');
	      if (lazyLoadImages.length > 0) {
	        lazyLoadImages.each(function(index, el) {
	          return $(el).fbqImage();
	        });
	      }
	      return $(window).resize();
	    }
	  },
	  _animateItems: function() {
	    if (this.isAnimatedItem) {
	      if (!this.element.hasClass('container-animated')) {
	        return this.element.fbqAnimated({
	          offset: 0.9
	        });
	      } else {
	        return this.element.fbqAnimated('initializeAnimation', this.element);
	      }
	    }
	  },
	  _addMoreFilters: function(justAddedCat) {
	    var diff, self;
	    self = this;
	    diff = $(justAddedCat).not(this.currentCat).get();
	    if (diff.length) {
	      if (this.filterSorting === 'default') {
	        $.each(diff, function(index, value) {
	          var dataFilter;
	          if (value !== '') {
	            dataFilter = typeof value === 'string' ? value.toLowerCase() : value;
	            return self.filterBar.append("<li class=\"fbq-filter-list\">\n   <a href=\"#\" class=\"js-filter-list fbq-p-text-color\" data-filter=\"" + dataFilter + "\">" + value + "</a>\n</li>");
	          }
	        });
	        return this.currentCat = this.currentCat.concat(diff);
	      } else {
	        this.currentCat = this.currentCat.concat(diff).sort();
	        if (this.filterSorting === 'char_desc') {
	          this.currentCat = this.currentCat.reverse();
	        }
	        this.filterBar.find('.fbq-filter-list:not(.fbq-filter-list--all)').remove();
	        $.each(this.currentCat, function(index, value) {
	          var dataFilter;
	          if ((value !== '') && (value !== 'all')) {
	            dataFilter = typeof value === 'string' ? value.toLowerCase() : value;
	            return self.filterBar.append("<li class=\"fbq-filter-list\">\n   <a href=\"#\" class=\"js-filter-list fbq-p-text-color\" data-filter=\"" + dataFilter + "\">" + value + "</a>\n</li>");
	          }
	        });
	        return this.filterBar.find('.js-filter-list').removeClass('active').filter('[data-filter=' + this.currentFilter + ']').addClass('active');
	      }
	    }
	  },
	  _runIsotope: function() {
	    var self;
	    self = this;
	    this.isotopeOptions.filter = $.proxy(this._isotopeFilter, this);
	    if (this.style === 'masonry') {
	      this.isotopeOptions.layoutMode = 'masonry';
	      this.isotopeOptions.masonry = {
	        columnWidth: this.content.width() / 60
	      };
	      this._setSize();
	    } else if (this.style === 'grid') {
	      this.isotopeOptions.layoutMode = 'fitRows';
	    }
	    this.content.isotope(self.isotopeOptions);
	    this._on(this.element, {
	      'click .js-filter-list': '_filterClicked'
	    });
	    return this.element.on('filterClicked.fbq', function(e, filter) {
	      return self._filterClicked(e, filter);
	    });
	  },
	  _masonryIsotopeUpdate: function() {
	    var self;
	    self = this;
	    this._clearSize();
	    clearTimeout(this.resizeTimer);
	    return this.resizeTimer = setTimeout(function() {
	      self._setSize();
	      return self.content.isotope({
	        masonry: {
	          columnWidth: self.content.width() / 60
	        }
	      });
	    }, 100);
	  },
	  _setSize: function() {
	    var entry;
	    entry = this.element.find(this.options.isotopeOptions.itemSelector);
	    return entry.each(function(index, el) {
	      $(this).css('width', $(this).outerWidth() + 'px');
	      return $(this).css('height', $(this).outerHeight() + 'px');
	    });
	  },
	  _clearSize: function() {
	    return this.element.find(this.options.isotopeOptions.itemSelector).css({
	      'width': '',
	      'height': ''
	    });
	  },
	  _filterClicked: function(e, filter) {
	    var el;
	    e.preventDefault();
	    el = $(e.currentTarget);
	    if (!el.hasClass('js-filter-list')) {
	      el = el.find('.js-filter-list').filter("[data-filter=" + filter + "]");
	    }
	    filter = filter ? filter : el.data('filter');
	    this.filter = filter !== 'all' ? filter : false;
	    this.filterBar.find('.js-filter-list').removeClass('active');
	    this.currentFilter = filter;
	    el.addClass('active');
	    if (this.style === 'masonry') {
	      this._masonryIsotopeUpdate();
	    } else {
	      this.content.isotope();
	    }
	    return $(window).resize();
	  },
	  _isotopeFilter: function(index, element) {
	    var filter;
	    if (this.filter) {
	      filter = $(element).attr('data-filter') ? $(element).data('filter').toString().split(', ') : '';
	      return $.inArray(this.filter, filter) !== -1;
	    } else {
	      return true;
	    }
	  }
	});

	$.widget.bridge('fbqEntries', $.fabrique.entries);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 555:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.featuredPost', {
	  _create: function() {
	    var fitHeightOptions;
	    this.element.find('.fbq-featuredpost-content').fbqCarousel({
	      speed: 800,
	      cssEase: 'ease-in'
	    });
	    if (this.element.hasClass('fbq-featuredpost--fit-height')) {
	      fitHeightOptions = {
	        itemWrapper: '.fbq-entry-body'
	      };
	      if (this.element.data('screen_percent')) {
	        fitHeightOptions.screenPercent = this.element.data('screen_percent');
	      }
	      if (this.element.data('screen_offset')) {
	        fitHeightOptions.screenOffset = this.element.data('screen_offset');
	      }
	      return this.element.find('.fbq-entry-inner').each(function(index, el) {
	        return $(el).fbqSetSize(fitHeightOptions);
	      });
	    }
	  }
	});

	$.widget.bridge('fbqFeaturedPost', $.fabrique.featuredPost);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 556:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.footerParallax', {
	  _create: function() {
	    var self;
	    self = this;
	    this.wrapper = this.element;
	    this.footer = this.element.find('.fbq-footer');
	    self._setFooterHeight();
	    return this._on($(window), {
	      'resize': $.proxy(this._setFooterHeight)
	    });
	  },
	  _setFooterHeight: function() {
	    var self;
	    self = this;
	    return setTimeout(function() {
	      if ($(window).width() > FabriqueApp.mobileScreenWidth) {
	        return self.wrapper.css('padding-bottom', self.footer.outerHeight() + 'px');
	      } else {
	        return self.wrapper.css('padding-bottom', '');
	      }
	    }, 100);
	  }
	});

	$.widget.bridge('fbqFooterParallax', $.fabrique.footerParallax);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 557:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.gallery', {
	  options: {
	    filter: null,
	    entryClass: '.fbq-gallery-item',
	    mediaClass: '.fbq-gallery-media',
	    isotopeOptions: {
	      itemSelector: '.fbq-gallery-item',
	      hiddenStyle: {
	        opacity: 0,
	        transform: 'scale(0.1)'
	      },
	      visibleStyle: {
	        opacity: 1,
	        transform: 'scale(1)'
	      }
	    }
	  },
	  _create: function() {
	    var filterSorting, initialActiveSelector, self;
	    self = this;
	    this.style = this.element.data('style') ? this.element.data('style') : 'grid';
	    this.imageAction = this.element.data('action');
	    this.popup = this.imageAction === 'image' || this.imageAction === 'content' || this.imageAction === 'both' || this.imageAction === 'lightbox' ? true : false;
	    this.content = this.element.find('.fbq-gallery-content');
	    this.initialEntry = this.element.find(this.options.entryClass);
	    this.isAnimatedItem = this.element.find('.fbq-gallery-body').hasClass('anmt-item');
	    this.filterBar = this.element.find('.fbq-filter-bar');
	    this.hasFilter = this.filterBar.length ? true : false;
	    filterSorting = this.content.data('filter_sorting');
	    this.filterSorting = filterSorting ? filterSorting : 'default';
	    this.currentFilter = 'all';
	    if (this.style === 'carousel') {
	      this._initializeCarouselStyle();
	    } else if (this.style === 'grid' || this.style === 'masonry') {
	      this.isotopeOptions = this.options.isotopeOptions;
	      if (this.hasFilter) {
	        initialActiveSelector = this.element.find('.js-filter-list.active');
	        if (initialActiveSelector.data('filter') !== 'all') {
	          this.filter = initialActiveSelector.data('filter');
	        }
	      }
	      this._runIsotope();
	      $(window).on('resize', function() {
	        if (self.style === 'masonry') {
	          return self._masonryIsotopeUpdate();
	        } else {
	          return self.content.isotope();
	        }
	      });
	      this.element.on('hiddenOpen.fbq', function() {
	        if (self.style === 'masonry') {
	          return self._masonryIsotopeUpdate();
	        } else {
	          return self.content.isotope();
	        }
	      });
	      this.pagination = this.element.find('.js-load-more');
	      this.paginationInput = this.pagination.find('input[type=hidden]');
	      if (this.pagination.length) {
	        this.pagination.fbqPaginate({
	          action: 'fabrique_gallery_entries'
	        });
	        if (this.hasFilter) {
	          this.currentCat = [];
	          this.filterBar.find('.js-filter-list').each(function(index, el) {
	            return self.currentCat.push($(this).data('filter'));
	          });
	        }
	        this.initialEntry.addClass('loaded');
	        this.pagination.on('load.fbqpagination', $.proxy(this._paginationLoaded, this));
	      }
	    }
	    if (this.popup) {
	      return this._createPopup();
	    }
	  },
	  _createPopup: function() {
	    return this.element.fbqPhotoSwipe({
	      gallery: true,
	      gallerySelector: this.options.mediaClass,
	      type: this.imageAction
	    });
	  },
	  _runIsotope: function() {
	    var self;
	    self = this;
	    this.isotopeOptions.filter = $.proxy(this._isotopeFilter, this);
	    if (this.style === 'masonry') {
	      this.isotopeOptions.layoutMode = 'masonry';
	      this.isotopeOptions.masonry = {
	        columnWidth: this.content.width() / 60
	      };
	      this._setSize();
	    } else if (this.style === 'grid') {
	      this.isotopeOptions.layoutMode = 'fitRows';
	    }
	    this.content.isotope(self.isotopeOptions);
	    this._on(this.element, {
	      'click .js-filter-list': '_filterClicked'
	    });
	    return this.element.on('filterClicked.fbq', function(e, filter) {
	      return self._filterClicked(e, filter);
	    });
	  },
	  _setSize: function() {
	    var entry;
	    entry = this.element.find(this.options.isotopeOptions.itemSelector);
	    return entry.each(function(index, el) {
	      $(this).css('width', $(this).outerWidth() + 'px');
	      return $(this).css('height', $(this).outerHeight() + 'px');
	    });
	  },
	  _clearSize: function() {
	    return this.element.find(this.options.isotopeOptions.itemSelector).css({
	      'width': '',
	      'height': ''
	    });
	  },
	  _filterClicked: function(e, filter) {
	    var el;
	    e.preventDefault();
	    el = $(e.currentTarget);
	    filter = filter ? filter : el.data('filter');
	    this.filter = filter !== 'all' ? filter : false;
	    this.filterBar.find('.js-filter-list').removeClass('active');
	    this.currentFilter = filter;
	    el.addClass('active');
	    if (this.style === 'masonry') {
	      return this._masonryIsotopeUpdate();
	    } else {
	      return this.content.isotope();
	    }
	  },
	  _masonryIsotopeUpdate: function() {
	    var self;
	    self = this;
	    this._clearSize();
	    clearTimeout(this.resizeTimer);
	    return this.resizeTimer = setTimeout(function() {
	      self._setSize();
	      return self.content.isotope({
	        masonry: {
	          columnWidth: self.content.width() / 60
	        }
	      });
	    }, 100);
	  },
	  _initializeCarouselStyle: function() {
	    var centerMode, newClass, randomNo, result, slideShow, thumbnail, thumbnailPosition, thumbnailVertical, totalImages;
	    thumbnail = this.element.find('.fbq-gallery-thumbnail');
	    randomNo = Date.now().toString();
	    newClass = 'js-gallery-carousel-' + randomNo.substr(randomNo.length - 3);
	    this.element.addClass(newClass);
	    if (thumbnail.length) {
	      result = thumbnail.attr('class').match(/fbq-gallery-thumbnail--(\S+)/);
	      thumbnailPosition = result ? result[1] : 'bottom';
	      totalImages = this.element.find(this.options.isotopeOptions.itemSelector).length;
	      if (thumbnailPosition !== 'bottom') {
	        thumbnailVertical = true;
	      }
	      this.content.fbqCarousel({
	        fade: true,
	        asNavFor: "." + newClass + " .fbq-gallery-thumbnail"
	      });
	      slideShow = thumbnail.data('thumbnail');
	      if (slideShow >= totalImages) {
	        centerMode = false;
	      } else {
	        centerMode = true;
	      }
	      thumbnail.fbqCarousel({
	        slidesToShow: slideShow,
	        vertical: thumbnailVertical,
	        asNavFor: "." + newClass + " .fbq-gallery-content",
	        focusOnSelect: true,
	        centerMode: centerMode,
	        centerPadding: 0,
	        arrows: false
	      });
	      if (slideShow >= totalImages) {
	        return this.content.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
	          return thumbnail.find('.fbq-gallery-thumbnail-item').removeClass('slick-current').eq(nextSlide).addClass('slick-current');
	        });
	      }
	    } else {
	      return this.element.find('.fbq-gallery-content').fbqCarousel();
	    }
	  },
	  _paginationLoaded: function(e, data) {
	    var els, filterCat, items, lazyLoadImages, newCat, newEntry, self;
	    if (!data.result) {
	      this.pagination.find('.btnx-text').text('error');
	      return this.pagination.addClass('error');
	    } else {
	      self = this;
	      items = $(data.result.content);
	      els = [];
	      newCat = [];
	      filterCat = [];
	      items.each(function(index, el) {
	        var media;
	        if (el.nodeType === 1) {
	          els.push(el);
	          if (self.popup) {
	            media = $(el).find(self.options.mediaClass);
	            self.element.fbqPhotoSwipe('pushPopupItem', media, self.imageAction);
	          }
	          if (self.hasFilter) {
	            return newCat.push($(this).data('filter'));
	          }
	        }
	      });
	      if (this.hasFilter) {
	        $.each(newCat, function(i, value) {
	          var eachCat;
	          if (value) {
	            if (value.indexOf(',') > -1) {
	              eachCat = value.split(', ');
	            } else {
	              eachCat = [value];
	            }
	            return filterCat = filterCat.concat(eachCat);
	          }
	        });
	      }
	      this.content.isotope('insert', els);
	      this.content.isotope('layout');
	      setTimeout(function() {
	        return self._animateItems();
	      }, 200);
	      if (this.hasFilter) {
	        this._addMoreFilters($.unique(filterCat));
	      }
	      newEntry = this.element.find(this.options.isotopeOptions.itemSelector).filter(':not(.loaded)');
	      newEntry.addClass('loaded');
	      lazyLoadImages = newEntry.find('.image-lazy-load');
	      if (lazyLoadImages.length > 0) {
	        lazyLoadImages.each(function(index, el) {
	          return $(el).fbqImage();
	        });
	      }
	      return $(window).resize();
	    }
	  },
	  _animateItems: function() {
	    if (this.isAnimatedItem) {
	      if (!this.element.hasClass('container-animated')) {
	        return this.element.fbqAnimated({
	          offset: 0.9
	        });
	      } else {
	        return this.element.fbqAnimated('initializeAnimation', this.element);
	      }
	    }
	  },
	  _addMoreFilters: function(justAddedCat) {
	    var diff, self;
	    self = this;
	    diff = $(justAddedCat).not(this.currentCat).get();
	    if (diff.length) {
	      if (this.filterSorting === 'default') {
	        $.each(diff, function(index, value) {
	          var dataFilter;
	          if (value !== '') {
	            dataFilter = typeof value === 'string' ? value.toLowerCase() : value;
	            return self.filterBar.append("<li class=\"fbq-filter-list\">\n   <a href=\"#\" class=\"js-filter-list fbq-p-text-color\" data-filter=\"" + dataFilter + "\">" + value + "</a>\n</li>");
	          }
	        });
	        return this.currentCat = this.currentCat.concat(diff);
	      } else {
	        this.currentCat = this.currentCat.concat(diff).sort();
	        if (this.filterSorting === 'char_desc') {
	          this.currentCat = this.currentCat.reverse();
	        }
	        this.filterBar.find('.fbq-filter-list:not(.fbq-filter-list--all)').remove();
	        $.each(this.currentCat, function(index, value) {
	          var dataFilter;
	          if ((value !== '') && (value !== 'all')) {
	            dataFilter = typeof value === 'string' ? value.toLowerCase() : value;
	            return self.filterBar.append("<li class=\"fbq-filter-list\">\n   <a href=\"#\" class=\"js-filter-list fbq-p-text-color\" data-filter=\"" + dataFilter + "\">" + value + "</a>\n</li>");
	          }
	        });
	        return this.filterBar.find('.js-filter-list').removeClass('active').filter('[data-filter="' + this.currentFilter + '"]').addClass('active');
	      }
	    }
	  },
	  _isotopeFilter: function(index, element) {
	    var filter;
	    if (this.filter) {
	      filter = $(element).attr('data-filter') ? $(element).data('filter').toString().split(', ') : '';
	      return $.inArray(this.filter, filter) !== -1;
	    } else {
	      return true;
	    }
	  }
	});

	$.widget.bridge('fbqGallery', $.fabrique.gallery);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 558:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.image', {
	  options: {
	    offset: 0.8
	  },
	  _create: function() {
	    var parentItem, self;
	    self = this;
	    this.loaded = false;
	    if ((FabriqueApp.isHorizontalScroll || FabriqueApp.isVerticalScroll || FabriqueApp.isHalfPageScroll) && FabriqueApp.isResponsive && ($(window).width() > FabriqueApp.tabletScreenWidth)) {
	      if (this.element.is(':visible')) {
	        if (this.element.closest('.slick-active').length > 0) {
	          this.addSource();
	        } else {
	          return $(window).on('slidePageChanged.fbq', function(e, obj) {
	            if (obj.nextSlide.has(self.element).length > 0) {
	              self.addSource();
	            }
	          });
	        }
	      } else {
	        parentItem = this.element.closest('.fbq-item');
	        if (parentItem.length) {
	          return parentItem.on('hiddenOpen.fbq', function() {
	            self.addSource();
	          });
	        }
	      }
	    } else if (this.element.is(':visible') && ($(window).scrollTop() + $(window).height() * this.options.offset > this.element.offset().top)) {
	      this.addSource();
	    } else {
	      $(window).on('scroll', function() {
	        if (!self.loaded && ($(window).scrollTop() + $(window).height() * self.options.offset > self.element.offset().top)) {
	          self.addSource();
	        }
	      });
	      return $(window).on('resize', function() {
	        if (!self.loaded && ($(window).scrollTop() + $(window).height() * self.options.offset > self.element.offset().top)) {
	          clearTimeout(self.resizeTimer);
	          self.resizeTimer = setTimeout(function() {
	            return self.addSource();
	          }, 300);
	        }
	      });
	    }
	  },
	  addSource: function() {
	    var element, self, sizes, source, sourceSet, wrapper;
	    if (this.element.is(':visible')) {
	      self = this;
	      element = this.element;
	      wrapper = this.element.closest('.fbq-media-wrapper');
	      this.loaded = true;
	      sizes = this.element.data('sizes');
	      source = this.element.data('src');
	      sourceSet = this.element.data('srcset');
	      return this.element.imagesLoaded((function(_this) {
	        return function() {
	          if (sizes) {
	            element.removeAttr('data-sizes');
	            element.attr('sizes', sizes);
	          }
	          if (sourceSet) {
	            element.removeAttr('data-srcset');
	            element.attr('srcset', sourceSet);
	          }
	          if (source) {
	            element.removeAttr('data-src');
	            element.attr('src', source);
	          }
	          return wrapper.addClass('loaded');
	        };
	      })(this));
	    }
	  }
	});

	$.widget.bridge('fbqImage', $.fabrique.image);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 559:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.menuMobile', {
	  options: {
	    submenuClass: '.sub-menu',
	    megamenuClass: '.fbq-mega-menu'
	  },
	  _create: function() {
	    var hiddenMenu, self;
	    self = this;
	    hiddenMenu = this.element.find(this.options.submenuClass + ", " + this.options.megamenuClass);
	    hiddenMenu.hide();
	    return hiddenMenu.each(function(index, submenu) {
	      submenu = $(submenu);
	      return submenu.prev().on('click', function(e) {
	        var currentTarget, fontSize, offsetR, paddingR;
	        currentTarget = $(e.currentTarget);
	        currentTarget = currentTarget.is('a') ? currentTarget : currentTarget.find('a');
	        if (currentTarget) {
	          fontSize = parseInt(currentTarget.css('font-size'));
	          paddingR = parseInt(currentTarget.css('padding-right'));
	          offsetR = paddingR > 0 ? paddingR : fontSize;
	          if ((e.offsetX > e.target.clientWidth - offsetR - 10) || currentTarget.attr('href') === '#') {
	            e.preventDefault();
	            return self._menuClicked(currentTarget, submenu);
	          }
	        }
	      });
	    });
	  },
	  _menuClicked: function(currentTarget, menu) {
	    var submenu;
	    currentTarget.toggleClass('active');
	    menu.toggleClass('toggle-active').slideToggle(300);
	    if (menu.hasClass('toggle-active')) {
	      submenu = currentTarget.closest('li').siblings().find('.sub-menu, .fbq-mega-menu');
	    } else {
	      submenu = menu.find('.sub-menu, .fbq-mega-menu');
	    }
	    if (submenu.length > 0) {
	      return this._closeChildrenMenu(submenu);
	    }
	  },
	  _closeChildrenMenu: function(menu) {
	    return menu.each(function(index, element) {
	      var collapsedLink, downLevelMenu;
	      downLevelMenu = $(element);
	      collapsedLink = downLevelMenu.prev();
	      collapsedLink = collapsedLink.is('a') ? collapsedLink : collapsedLink.find('a');
	      if (collapsedLink && downLevelMenu.hasClass('toggle-active')) {
	        collapsedLink.removeClass('active');
	        return downLevelMenu.slideUp(300).removeClass('toggle-active');
	      }
	    });
	  }
	});

	$.widget.bridge('fbqMenuMobile', $.fabrique.menuMobile);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 560:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.milestone', {
	  _create: function() {
	    var element, self;
	    self = this;
	    element = this.element;
	    if (element.attr('data-counter-animation')) {
	      if (element.is(':visible')) {
	        if (FabriqueApp.hasPageLoad) {
	          return $(window).load(function() {
	            return self._animateNumber(element);
	          });
	        } else {
	          return this._animateNumber(element);
	        }
	      } else {
	        return element.on('hiddenOpen.fbq', function() {
	          element.find('.fbq-milestone-item').each(function(index, el) {
	            return element.find('.fbq-milestone-number').fbqCounter();
	          });
	          return element.off('hiddenOpen.fbq');
	        });
	      }
	    }
	  },
	  _animateNumber: function(el) {
	    var item, number, scene;
	    item = el.find('.fbq-milestone-item');
	    number = el.find('.fbq-milestone-number');
	    if (item.hasClass('anmt-item')) {
	      return item.each(function(index, element) {
	        var milestoneItem;
	        milestoneItem = $(element);
	        return milestoneItem.on('fbq.itemAnimated', function() {
	          number.fbqCounter();
	          return milestoneItem.off('fbq.itemAnimated');
	        });
	      });
	    } else {
	      scene = new ScrollMagic.Scene({
	        triggerElement: el[0],
	        triggerHook: 'onEnter'
	      });
	      scene.addTo(FabriqueApp.smController);
	      return scene.on('enter', function() {
	        number.fbqCounter();
	        return scene.destroy();
	      });
	    }
	  }
	});

	$.widget.bridge('fbqMilestone', $.fabrique.milestone);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 561:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var Cookies;

	Cookies = __webpack_require__(535);

	$.widget('fabrique.modal', {
	  options: {
	    visited: false,
	    expire: 3
	  },
	  _create: function() {
	    var delayTime, expire, modalId, self, viewed;
	    self = this;
	    this.body = FabriqueApp.body;
	    this.items = this.element.find('.fbq-item');
	    this.screenContent = FabriqueApp.content;
	    if (this.element.data('splash')) {
	      modalId = this.element.attr('id');
	      modalId = modalId ? modalId : 'splash-screen';
	      if (Cookies.get(modalId)) {
	        viewed = Cookies.get(modalId);
	      } else {
	        viewed = false;
	        delayTime = parseInt(this.element.data('delay'));
	        expire = parseInt(this.element.data('expire')) || this.options.expire;
	        Cookies.set(modalId, 'viewed', {
	          expires: expire
	        });
	      }
	      if (viewed !== 'viewed') {
	        $(window).load(function() {
	          return setTimeout(function() {
	            return self._modalOpen();
	          }, delayTime);
	        });
	      }
	    }
	    this._on(this.element, {
	      'click .js-close': '_modalClose'
	    });
	    $(document).on('keyup', function(e) {
	      if (e.keyCode === 27 && self.element.hasClass('active')) {
	        return self._modalClose(e);
	      }
	    });
	    return this.element.on('modalOpen.fbq', function(e) {
	      return self._modalOpen();
	    });
	  },
	  _modalOpen: function() {
	    var element;
	    element = this.element;
	    this.element.insertBefore(FabriqueApp.pswpElement);
	    element.show();
	    setTimeout(function() {
	      return element.addClass('active');
	    }, 300);
	    this.body.addClass('fbq-unscrollable');
	    this.items.trigger('hiddenOpen.fbq');
	    return $(window).resize();
	  },
	  _modalClose: function(e) {
	    var element;
	    e.preventDefault();
	    element = this.element;
	    element.removeClass('active');
	    setTimeout(function() {
	      return element.hide();
	    }, 500);
	    this.body.removeClass('fbq-unscrollable');
	    return this.items.trigger('hiddenClose.fbq');
	  }
	});

	$.widget.bridge('fbqModal', $.fabrique.modal);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 562:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.navbar', {
	  options: {
	    mobile: false,
	    autohide: false,
	    transition: 'default',
	    delta: 150,
	    submenuRightSpacing: 25
	  },
	  _create: function() {
	    var mainMenu, self, submenu;
	    self = this;
	    this.isItem = false;
	    this.isSafari = FabriqueApp.isSafari;
	    this.autoHidePoint = 0;
	    this.frameWidth = this.options.mobile ? 0 : FabriqueApp.frameWidth;
	    this.header = this.element.parent();
	    this.topbar = this.element.siblings('.fbq-topbar');
	    this.headerWidgetButton = this.element.find('.js-header-headerwidget-btn');
	    this.navbarStyle = this.element.data('style') ? this.element.data('style') : 'standard';
	    this.collapsedMenuStyle = this.element.data('collapsed_style') ? this.element.data('collapsed_style') : false;
	    this.menuPosition = this.element.data('position') ? this.element.data('position') : 'top';
	    if (this.options.mobile) {
	      this.element.fbqCollapsedMenu();
	      this.element.find('.fbq-nav-menu').fbqMenuMobile();
	    } else {
	      if ((this.navbarStyle === 'minimal') || (this.navbarStyle === 'split')) {
	        this.element.fbqCollapsedMenu();
	      }
	      if (this.collapsedMenuStyle === 'full') {
	        this.element.find('.fbq-nav-menu').fbqMenuMobile();
	      } else if (this.collapsedMenuStyle === 'offcanvas') {
	        this.element.siblings('.fbq-collapsed-menu').find('.fbq-nav-menu').fbqMenuMobile();
	      } else {
	        mainMenu = this.element.find('.fbq-nav-menu');
	        submenu = mainMenu.children('.menu-item').children('.sub-menu');
	        setTimeout(function() {
	          return self.setSubmenuPosition(submenu);
	        }, 500);
	        if (this.element.data('highlight') === 'underline') {
	          setTimeout(function() {
	            return self.initiateUnderlineHighlight(mainMenu, true);
	          }, 2000);
	          $(window).on('resize', function() {
	            return self.initiateUnderlineHighlight(mainMenu, false);
	          });
	        }
	      }
	    }
	    this.element.fbqSearch();
	    if (this.headerWidgetButton.length) {
	      this.headerWidgets = this.element.find('.fbq-header-widgets');
	      this.headerWidgetButton.on('click', function(e) {
	        e.preventDefault();
	        return self.headerWidgets.toggleClass('active').slideToggle(500);
	      });
	    }
	    if (this.element.hasClass('transparent') || this.element.hasClass('fixed-transparent')) {
	      this.element.fbqDynamicMenuColor({
	        mobile: self.options.mobile
	      });
	    }
	    if (this.element.data('fixed')) {
	      this.transitionStyle = this.element.data('transition') ? this.element.data('transition') : 'default';
	      return this._initializeFixed();
	    }
	  },
	  setSubmenuPosition: function(submenu) {
	    var submenuRightSpacing;
	    submenuRightSpacing = this.options.submenuRightSpacing;
	    return submenu.each(function(index, menu) {
	      var grandChildMenu, lastmenu;
	      grandChildMenu = $(this).find('.sub-menu');
	      if (grandChildMenu.length) {
	        lastmenu = grandChildMenu.eq(grandChildMenu.length - 1);
	        $(this).css('display', 'block').removeClass('sub-menu--left');
	        grandChildMenu.css('display', 'block');
	        if (lastmenu.offset().left + lastmenu.width() + submenuRightSpacing > $(window).width()) {
	          $(this).addClass('sub-menu--left');
	        }
	        $(this).css('display', '');
	        return grandChildMenu.css('display', '');
	      } else {
	        $(this).css('display', 'block').removeClass('sub-menu--left');
	        if ($(this).offset().left + $(this).width() > $(window).width()) {
	          $(this).addClass('sub-menu--left');
	        }
	        return $(this).css('display', '');
	      }
	    });
	  },
	  initiateUnderlineHighlight: function(menu, init) {
	    var activeLeft, activeWidth, hasActiveState, line, menuChild;
	    if (init) {
	      menu.after("<div id=\"fbq-navbar-highlight-line\" class=\"fbq-navbar-highlight-line fbq-p-brand-bg\"></div>");
	    }
	    line = menu.siblings('.fbq-navbar-highlight-line');
	    if (line.length) {
	      activeWidth = 0;
	      activeLeft = 0;
	      hasActiveState = false;
	      menuChild = menu.children();
	      return menuChild.each(function(index, menuItem) {
	        var item, itemLink, itemPosition, itemWidth;
	        item = $(menuItem);
	        itemLink = item.children('a');
	        itemWidth = itemLink.outerWidth();
	        itemPosition = item.position().left;
	        if ((item.hasClass('current-menu-item') || item.hasClass('current-menu-ancestor')) && !line.hasClass('active')) {
	          hasActiveState = true;
	          activeWidth += itemWidth;
	          activeLeft += itemPosition;
	          line.addClass('active').css({
	            'width': activeWidth,
	            'left': activeLeft
	          });
	        }
	        if (init) {
	          item.on('hover', function(e) {
	            if (e.type === 'mouseenter') {
	              if (!line.hasClass('active')) {
	                line.addClass('active');
	              }
	              return line.css({
	                'width': itemWidth,
	                'left': itemPosition
	              });
	            } else {
	              return line.css({
	                'width': activeWidth,
	                'left': activeLeft
	              });
	            }
	          });
	          if ((index === menuChild.length - 1) && !hasActiveState) {
	            return menu.on('hover', function(e) {
	              if (e.type === 'mouseleave') {
	                return line.removeClass('active');
	              }
	            });
	          }
	        }
	      });
	    }
	  },
	  _initializeFixed: function() {
	    var alternateClassScene, fixedClassScene, fixedPosition, navbarHeight, self, showingPosition, showingScene, stopElement, topbarHeight, transitionPoint;
	    self = this;
	    navbarHeight = this.element.outerHeight();
	    transitionPoint = this.element.data('transition_point') ? this.element.data('transition_point') : false;
	    if (this.options.mobile) {
	      topbarHeight = this.topbar.length && this.topbar.data('mobile') ? this.topbar.data('height') : 0;
	    } else {
	      topbarHeight = this.topbar.length ? this.topbar.data('height') : 0;
	    }
	    if (this.transitionStyle === 'custom-show') {
	      fixedPosition = topbarHeight - this.frameWidth + navbarHeight;
	      fixedClassScene = this.generateNavScene(fixedPosition);
	      this.navbarScroll(fixedClassScene, 'fbq-navbar--fixed fbq-navbar--alternate', 'fbq-no-transition', 'hide');
	      showingPosition = transitionPoint && transitionPoint > fixedPosition ? transitionPoint : fixedPosition + 30;
	      showingScene = this.generateNavScene(showingPosition);
	      this.navbarScroll(showingScene, 'show', false, 'show');
	      if (this.element.data('autohide')) {
	        this.autoHidePoint = showingPosition + 300;
	      }
	    } else if (this.transitionStyle === 'custom-change') {
	      fixedPosition = topbarHeight - this.frameWidth;
	      if (this.navbarStyle === 'stacked') {
	        fixedPosition += this.element.find('.fbq-navbar-header').outerHeight(true);
	      }
	      if (transitionPoint && transitionPoint > fixedPosition) {
	        fixedClassScene = this.generateNavScene(fixedPosition);
	        this.navbarScroll(fixedClassScene, 'fbq-navbar--fixed show');
	        alternateClassScene = this.generateNavScene(transitionPoint);
	        this.navbarScroll(alternateClassScene, 'fbq-navbar--alternate');
	      } else {
	        fixedClassScene = this.generateNavScene(fixedPosition);
	        this.navbarScroll(fixedClassScene, 'fbq-navbar--fixed fbq-navbar--alternate show');
	      }
	    } else {
	      this.autoHidePoint += navbarHeight;
	      fixedPosition = topbarHeight - this.frameWidth;
	      if (this.navbarStyle === 'stacked') {
	        fixedPosition += this.element.find('.fbq-navbar-header').outerHeight(true);
	      }
	      fixedClassScene = this.generateNavScene(fixedPosition);
	      this.navbarScroll(fixedClassScene, 'fbq-navbar--fixed show');
	    }
	    if (this.element.data('autohide')) {
	      this._initializeAutoHide();
	    }
	    this.item = this.element.closest('.fbq-item');
	    this.isItem = this.item.length;
	    if (this.isItem) {
	      this.fixedLeft = this.item.offset().left;
	      this.fixedWidth = this.item.outerWidth();
	      if (this.item.data('stop')) {
	        stopElement = $(this.item.data('stop'));
	        if (stopElement.offset().top > this.element.offset().top) {
	          fixedClassScene.duration(stopElement.offset().top - this.element.offset().top - navbarHeight);
	        }
	      }
	      return $(window).on('resize', function(e) {
	        self.fixedLeft = self.item.offset().left;
	        self.fixedWidth = self.item.outerWidth();
	        if (self.element.hasClass('fbq-navbar--fixed')) {
	          self.element.css({
	            'left': self.fixedLeft + 'px',
	            'width': self.fixedWidth + 'px'
	          });
	        }
	        if (stopElement && (stopElement.offset().top > self.element.offset().top)) {
	          return fixedClassScene.duration(stopElement.offset().top - self.element.offset().top - navbarHeight);
	        }
	      });
	    }
	  },
	  _initializeAutoHide: function() {
	    var el, lst, self;
	    self = this;
	    el = this.element;
	    lst = $(window).scrollTop();
	    return $(window).on('scroll', function(e) {
	      var st;
	      st = $(window).scrollTop();
	      if (st > self.autoHidePoint) {
	        if (Math.abs(lst - st) < self.options.delta) {
	          return;
	        }
	        if (st > lst) {
	          el.removeClass('show');
	          if (!self.isSafari) {
	            el.css('top', (self.frameWidth - el.outerHeight()) + "px");
	          } else {
	            el.css({
	              'transform': 'translateY(-100%)'
	            });
	          }
	          if (self.headerWidgets && self.headerWidgets.hasClass('active')) {
	            self.headerWidgets.removeClass('active').slideUp(300);
	          }
	        } else {
	          if (!el.hasClass('show')) {
	            el.addClass('show');
	            el.css({
	              'top': '',
	              'transform': ''
	            });
	          }
	        }
	      } else if (!el.hasClass('show') && self.transitionStyle === 'default') {
	        el.addClass('show');
	        el.css({
	          'top': '',
	          'transform': ''
	        });
	      }
	      return lst = st;
	    });
	  },
	  generateNavScene: function(offset) {
	    var scene;
	    scene = new ScrollMagic.Scene({
	      triggerElement: this.header[0],
	      triggerHook: 'onLeave',
	      offset: offset
	    });
	    return scene;
	  },
	  navbarScroll: function(scene, extraClass, flashClass, display) {
	    var el, self;
	    self = this;
	    el = this.element;
	    scene.addTo(FabriqueApp.smController);
	    scene.on('enter', function() {
	      if (display === 'show') {
	        el.css({
	          'display': '',
	          'top': '',
	          'transform': ''
	        });
	      } else if (display === 'hide') {
	        if (!self.isSafari) {
	          el.css({
	            'display': 'none',
	            'top': (self.frameWidth - el.outerHeight()) + "px"
	          });
	        } else {
	          el.css({
	            'display': 'none',
	            'transform': 'translateY(-100%)'
	          });
	        }
	        setTimeout(function() {
	          return el.css('display', '');
	        }, 5);
	      }
	      if (flashClass) {
	        el.addClass(flashClass).addClass(extraClass).removeClass(flashClass);
	      } else {
	        el.addClass(extraClass);
	      }
	      if (self.isItem) {
	        return el.css({
	          'left': self.fixedLeft + 'px',
	          'right': 'auto',
	          'width': self.fixedWidth + 'px'
	        });
	      }
	    });
	    return scene.on('leave', function() {
	      el.removeClass(extraClass);
	      if (self.isItem) {
	        el.css({
	          'left': '',
	          'right': '',
	          'width': ''
	        });
	      }
	      if (display === 'show') {
	        if (!self.isSafari) {
	          return el.css('top', (self.frameWidth - el.outerHeight()) + "px");
	        } else {
	          return el.css({
	            'transform': 'translateY(-100%)'
	          });
	        }
	      } else if (display === 'hide') {
	        return el.css({
	          'top': '',
	          'transform': ''
	        });
	      }
	    });
	  }
	});

	$.widget.bridge('fbqNavbar', $.fabrique.navbar);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 563:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.onePageScroll', {
	  options: {
	    slickOptions: {
	      slidesToScroll: 1,
	      slidesToShow: 1,
	      vertical: true,
	      dots: true,
	      dotsClass: 'slick-dots slidepage-dots',
	      infinite: false,
	      arrows: false,
	      swipe: false
	    }
	  },
	  _create: function() {
	    var firstRow, main, self, viewportHeight;
	    self = this;
	    this.body = FabriqueApp.body;
	    this.isResponsive = FabriqueApp.isResponsive;
	    this.isMobileOrTablet = FabriqueApp.isMobileOrTablet;
	    this.tabletScreenWidth = FabriqueApp.tabletScreenWidth;
	    this.isHorizontalScroll = FabriqueApp.isHorizontalScroll;
	    this.isVerticalScroll = FabriqueApp.isVerticalScroll;
	    this.isHalfPageScroll = FabriqueApp.isHalfPageScroll;
	    if (this.isMobileOrTablet && this.isResponsive) {
	      return this._initializeMobileDevice();
	    } else {
	      this.lastAnimation = 0;
	      viewportHeight = $(window).height();
	      this.windowWidth = $(window).width();
	      this.slickOptions = this.options.slickOptions;
	      if (this.isHorizontalScroll || this.isVerticalScroll) {
	        this.slickOptions.vertical = this.isVerticalScroll ? true : false;
	        this.element.find('.fbq-section').each(function(index, el) {
	          return $(el).fbqSetSize({
	            type: 'header',
	            fluid: false
	          });
	        });
	      } else if (this.isHalfPageScroll) {
	        firstRow = this.element.find('.fbq-row').first();
	        main = firstRow.children();
	        if (main.length !== 2) {
	          return;
	        }
	        this.firstContainer = main.first();
	        this.lastContainer = main.last();
	        this.firstContainerBoxes = this.firstContainer.children('.fbq-box');
	        this.lastContainerBoxes = this.lastContainer.children('.fbq-box');
	        this.firstContainerSlides = this.firstContainerBoxes.length;
	        this.lastContainerSlides = this.lastContainerBoxes.length;
	        if (this.firstContainerSlides !== this.lastContainerSlides) {
	          return;
	        }
	        this.firstContainerBoxes.children('.fbq-box-inner').each(function(index, el) {
	          var pairBox;
	          pairBox = $(self.lastContainerBoxes.get(index));
	          return $(el).fbqSetSize({
	            type: 'header',
	            pair: pairBox.children('.fbq-box-inner'),
	            fluid: false
	          });
	        });
	      }
	      if (this.isResponsive) {
	        if (this.windowWidth > this.tabletScreenWidth) {
	          this._setSlide(true);
	        } else {
	          this.init = true;
	        }
	        return this._on($(window), {
	          'resize': '_windowResize'
	        });
	      } else {
	        return this._setSlide(true);
	      }
	    }
	  },
	  _windowResize: function() {
	    var viewportWidth;
	    viewportWidth = $(window).width();
	    if (viewportWidth > this.tabletScreenWidth && this.windowWidth <= this.tabletScreenWidth) {
	      this._setSlide(this.init);
	      this.init = false;
	    } else if (viewportWidth <= this.tabletScreenWidth && this.windowWidth > this.tabletScreenWidth) {
	      this._unsetSlide();
	    } else if (viewportWidth > this.tabletScreenWidth) {
	      this._setSlide('resize');
	    }
	    return this.windowWidth = viewportWidth;
	  },
	  _initializeMobileDevice: function() {
	    var boxes, boxesLength, columns, i, j, length, ndBox, ref, results, row, self, stBox, type;
	    self = this;
	    if (this.isHorizontalScroll || this.isVerticalScroll) {
	      return this.element.find('.fbq-section').each(function(index, el) {
	        var type;
	        type = index === 0 ? 'header' : 'full';
	        return $(el).fbqSetSize({
	          type: type,
	          fluid: true
	        });
	      });
	    } else if (this.isHalfPageScroll) {
	      row = this.element.find('.fbq-section').first().find('.fbq-row--main').first();
	      if (row.length !== 1) {
	        return false;
	      }
	      columns = row.children();
	      if (columns.length !== 2) {
	        return false;
	      }
	      boxes = columns.children('.fbq-box');
	      boxesLength = boxes.length;
	      if (!boxesLength || (boxesLength % 2 !== 0)) {
	        return false;
	      }
	      if ($(window).width() < FabriqueApp.mobileScreenWidth) {
	        this._rearrangeSection(columns, boxes);
	        return boxes.children('.fbq-box-inner').each(function(index, el) {
	          var type;
	          type = index === 0 ? 'header' : 'full';
	          return $(el).fbqSetSize({
	            type: type
	          });
	        });
	      } else {
	        length = boxesLength / 2;
	        results = [];
	        for (i = j = 0, ref = length; 0 <= ref ? j < ref : j > ref; i = 0 <= ref ? ++j : --j) {
	          stBox = $(boxes.get(i));
	          ndBox = $(boxes.get(i + length));
	          type = i === 0 ? 'header' : 'full';
	          results.push(stBox.children('.fbq-box-inner').fbqSetSize({
	            type: type,
	            pair: ndBox.children('.fbq-box-inner')
	          }));
	        }
	        return results;
	      }
	    }
	  },
	  _rearrangeSection: function(columns, boxes) {
	    var i, index, j, length, ndBox, ndCol, ref, results, stBox, stCol;
	    stCol = $(columns.get(0));
	    ndCol = $(columns.get(1));
	    index = 0;
	    length = boxes.length / 2;
	    boxes.detach();
	    results = [];
	    for (i = j = 0, ref = length; 0 <= ref ? j < ref : j > ref; i = 0 <= ref ? ++j : --j) {
	      stBox = $(boxes.get(i));
	      ndBox = $(boxes.get(i + length));
	      stBox.data('halfcol', index++);
	      ndBox.data('halfcol', index++);
	      if (stCol.length < length) {
	        stCol.append(stBox);
	        results.push(stCol.append(ndBox));
	      } else {
	        ndCol.append(stBox);
	        results.push(ndCol.append(ndBox));
	      }
	    }
	    return results;
	  },
	  _setSlide: function(init) {
	    var firstContainerOptions, initScheme, lastContainerOptions, rightBoxes, self, slickDots, slickOptions;
	    self = this;
	    slickOptions = this.slickOptions;
	    slickOptions.isFullSlide = true;
	    if (!this.body.hasClass('pc-device-slide')) {
	      this.body.addClass('pc-device-slide');
	    }
	    if (this.isHorizontalScroll || this.isVerticalScroll) {
	      if (init === true) {
	        this.element.fbqCarousel(slickOptions);
	      } else if (init === 'resize') {
	        this.element.fbqCarousel('reposition');
	      } else {
	        this.element.fbqCarousel('initializeCarousel', slickOptions);
	      }
	      slickDots = this.element.children('.slick-dots');
	      initScheme = this.element.find('.slick-active').first().data('scheme');
	      initScheme = initScheme ? initScheme : FabriqueApp.defaultScheme;
	      slickDots.addClass(initScheme);
	      $(window).on('slidePageChanged.fbq', function(e, obj) {
	        var nextScheme;
	        nextScheme = obj.nextSlide.data('scheme');
	        nextScheme = nextScheme ? nextScheme : FabriqueApp.defaultScheme;
	        return slickDots.removeClass("dark light").addClass("" + nextScheme);
	      });
	    } else if (this.isHalfPageScroll) {
	      this._sortElements(this.lastContainer);
	      slickOptions.accessibility = false;
	      firstContainerOptions = slickOptions;
	      firstContainerOptions.isHalfSlide = true;
	      firstContainerOptions.halfSlidePosition = 'left';
	      lastContainerOptions = {
	        accessibility: false,
	        initialSlide: this.lastContainerSlides - 1,
	        slidesToScroll: 1,
	        slidesToShow: 1,
	        vertical: true,
	        dots: false,
	        dotsClass: 'slick-dots slidepage-dots',
	        infinite: false,
	        arrows: false,
	        swipe: false,
	        isHalfSlide: true,
	        halfSlidePosition: 'right'
	      };
	      if (init === true) {
	        rightBoxes = this.lastContainer.children('.fbq-box');
	        this.firstContainer.fbqCarousel(firstContainerOptions);
	        this.lastContainer.fbqCarousel(lastContainerOptions);
	        $(window).trigger('doneSetHalfSlide.fbq', {
	          leftBoxes: this.firstContainerBoxes,
	          rightBoxes: rightBoxes
	        });
	      } else if (init === 'resize') {
	        this.firstContainer.fbqCarousel('reposition');
	        this.lastContainer.fbqCarousel('reposition');
	      } else {
	        this.firstContainer.fbqCarousel('initializeCarousel', firstContainerOptions);
	        this.lastContainer.fbqCarousel('initializeCarousel', lastContainerOptions);
	      }
	      slickDots = this.firstContainer.children('.slick-dots');
	      initScheme = this.lastContainer.find('.slick-active').first().data('scheme');
	      initScheme = initScheme ? initScheme : FabriqueApp.defaultScheme;
	      slickDots.addClass(initScheme);
	      slickDots.find('li').click(function() {
	        return self.lastContainer.slick('slickGoTo', self.lastContainerSlides - $(this).index() - 1);
	      });
	      $(window).on('slidePageChanged.fbq', function(e, obj) {
	        var nextScheme;
	        if (obj.position === 'right') {
	          nextScheme = obj.nextSlide.data('scheme');
	          nextScheme = nextScheme ? nextScheme : FabriqueApp.defaultScheme;
	          return slickDots.removeClass("dark light").addClass("" + nextScheme);
	        }
	      });
	    }
	    $(document).mousewheel(function(e) {
	      return self._scroll(e);
	    });
	    return this._on($(document), {
	      'keydown': '_keyboardPressed'
	    });
	  },
	  _unsetSlide: function() {
	    this.body.removeClass('pc-device-slide');
	    if (this.isHorizontalScroll || this.isVerticalScroll) {
	      this.element.slick('unslick');
	    } else if (this.isHalfPageScroll) {
	      this.firstContainer.slick('unslick');
	      this.lastContainer.slick('unslick');
	      this._sortElements(this.lastContainer);
	    }
	    $(document).off('mousewheel');
	    $(document).off('keydown');
	    return this.element.find('.slick-slider').trigger('resetScrollPage.fbq');
	  },
	  _sortElements: function(container) {
	    return container.children().each(function(index, box) {
	      return container.prepend(box);
	    });
	  },
	  _scroll: function(e) {
	    var delta, timeNow;
	    if ($(e.target).closest('.js-item-modal').length < 1) {
	      e.preventDefault();
	      if (this.isHorizontalScroll) {
	        delta = e.deltaX === 0 ? e.deltaY : -e.deltaX;
	      } else {
	        delta = e.deltaY;
	      }
	      timeNow = (new Date).getTime();
	      if (timeNow - this.lastAnimation < 1500) {
	        return;
	      }
	      if (delta < 0) {
	        this._moveDown();
	      } else if (delta > 0) {
	        this._moveUp();
	      }
	      return this.lastAnimation = timeNow;
	    }
	  },
	  _keyboardPressed: function(e) {
	    var $el, next, previous, tag;
	    $el = $(e.target);
	    tag = $el.prop('tagName').toLowerCase();
	    if (this.isHorizontalScroll) {
	      previous = 37;
	      next = 39;
	    } else {
	      previous = 38;
	      next = 40;
	    }
	    switch (e.which) {
	      case previous:
	        if (tag !== 'input' && tag !== 'textarea') {
	          return this._moveUp();
	        }
	        break;
	      case next:
	        if (tag !== 'input' && tag !== 'textarea') {
	          return this._moveDown();
	        }
	        break;
	      case 32:
	        if (tag !== 'input' && tag !== 'textarea') {
	          return this._moveDown();
	        }
	        break;
	      case 33:
	        if (tag !== 'input' && tag !== 'textarea') {
	          return this._moveUp();
	        }
	        break;
	      case 34:
	        if (tag !== 'input' && tag !== 'textarea') {
	          return this._moveDown();
	        }
	        break;
	    }
	  },
	  _moveUp: function() {
	    if (this.isHorizontalScroll || this.isVerticalScroll) {
	      return this.element.slick('slickPrev');
	    } else if (this.isHalfPageScroll) {
	      this.firstContainer.slick('slickPrev');
	      return this.lastContainer.slick('slickNext');
	    }
	  },
	  _moveDown: function() {
	    if (this.isHorizontalScroll || this.isVerticalScroll) {
	      return this.element.slick('slickNext');
	    } else if (this.isHalfPageScroll) {
	      this.firstContainer.slick('slickNext');
	      return this.lastContainer.slick('slickPrev');
	    }
	  }
	});

	$.widget.bridge('fbqOnePageScroll', $.fabrique.onePageScroll);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 564:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.paginate', {
	  options: {
	    style: 'click',
	    action: 'fabrique_entries'
	  },
	  _create: function() {
	    var result, self;
	    result = this.element.attr('class').match(/fbq-pagination--(\S+)/);
	    this.style = result ? result[1] : 'click';
	    this.buttonText = this.element.find('.btnx-text');
	    this.loadMoreMessage = this.buttonText.data('label') ? this.buttonText.data('label') : 'Load More';
	    this.loadingMessage = this.buttonText.data('loading_label') ? this.buttonText.data('loading_label') : 'Loading';
	    this.optionInput = this.element.find('input[type=hidden]');
	    this.allPosts = this.optionInput.data('posts');
	    this.index = 1;
	    this.paginateOptions = JSON.parse(this.optionInput.val());
	    this.postToFind = this.paginateOptions.query_args.posts_per_page || 10;
	    this.windowLoaded = false;
	    this.scrollReached = false;
	    this.loading = false;
	    this.windowLoadedOff = false;
	    this.allLoaded = false;
	    self = this;
	    if (this.style === 'click') {
	      self._on(self.element, {
	        'click a': '_buttonClicked'
	      });
	    } else if (this.style === 'scroll') {
	      this.scene = new ScrollMagic.Scene({
	        triggerElement: this.element[0],
	        triggerHook: 'onEnter'
	      });
	      this.scene.addTo(FabriqueApp.smController);
	      this.scene.on('enter', function(e) {
	        return self._scrollReached();
	      });
	    }
	    return $(window).load(function() {
	      return self._windowLoaded();
	    });
	  },
	  _buttonClicked: function(e) {
	    e.preventDefault();
	    if (this.windowLoaded && !this.loading) {
	      return this._loadMore();
	    }
	  },
	  _scrollReached: function() {
	    var self;
	    self = this;
	    if (this.windowLoaded) {
	      if (!this.loading) {
	        return this._loadMore();
	      }
	    } else {
	      return this.element.on('windowLoaded.fbq', function() {
	        return self._loadMore();
	      });
	    }
	  },
	  _windowLoaded: function() {
	    this.windowLoaded = true;
	    return this.element.trigger('windowLoaded.fbq');
	  },
	  _loadMore: function() {
	    var btnText, data, el, scene, self, style;
	    self = this;
	    scene = this.scene;
	    style = this.style;
	    el = this.element;
	    btnText = this.buttonText;
	    this.loading = true;
	    this.element.off('windowLoaded.fbq');
	    el.toggleClass('loading');
	    btnText.text(this.loadingMessage);
	    data = $.extend({}, {
	      action: this.options.action,
	      pagination_index: this.index
	    }, this.paginateOptions);
	    this.index++;
	    return $.post(FabriqueApp.ajaxUrl, data).done(function(response) {
	      el.trigger('load.fbqpagination', response.data);
	      setTimeout(function() {
	        el.toggleClass('loading');
	        btnText.text(self.loadMoreMessage);
	        self.loading = false;
	        if (style === 'scroll' && ($(window).scrollTop() + $(window).height() >= el.offset().top) && !self.allLoaded) {
	          self._loadMore();
	        }
	        if (!self.windowLoadedOff) {
	          el.off('windowLoaded.fbq');
	          return self.windowLoadedOff = true;
	        }
	      }, 500);
	      if (self.postToFind * self.index >= self.allPosts) {
	        el.remove();
	        self.allLoaded = true;
	        if (style === 'scroll') {
	          return scene.destroy();
	        } else if (style === 'click') {
	          return el.off('click');
	        }
	      }
	    }).fail(function(response) {
	      btnText.text('error');
	      return el.addClass('error');
	    });
	  }
	});

	$.widget.bridge('fbqPaginate', $.fabrique.paginate);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 565:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.parallaxContent', {
	  options: {
	    items: '',
	    speed: 0.5,
	    offset: 200
	  },
	  _create: function() {
	    var itemLength, offset, self, speed;
	    itemLength = this.options.items.length;
	    if (FabriqueApp.isMobileOrTablet || FabriqueApp.isHorizontalScroll || FabriqueApp.isVerticalScroll || FabriqueApp.isHalfPageScroll || !itemLength) {
	      return;
	    }
	    self = this;
	    this.tabletScreenWidth = FabriqueApp.tabletScreenWidth;
	    this.windowWidth = $(window).width();
	    speed = this.element.data('parallaxspeed');
	    this.parallaxSpeed = speed ? parseInt(speed) * 0.1 : this.options.speed;
	    offset = this.element.data('parallaxoffset');
	    this.parallaxOffset = offset ? offset : this.options.offset;
	    this._doParallaxContent();
	    $(window).on('resize', function(e) {
	      clearTimeout(self.resizeTimer);
	      return self.resizeTimer = setTimeout(function() {
	        return self._doParallaxContent();
	      }, 200);
	    });
	    return $(window).on('scroll', function() {
	      return self._doParallaxContent();
	    });
	  },
	  _doParallaxContent: function() {
	    var parallaxOffset, parallaxSpeed, scrollTop, windowH;
	    parallaxSpeed = this.parallaxSpeed;
	    parallaxOffset = this.parallaxOffset;
	    windowH = $(window).height();
	    scrollTop = $(window).scrollTop();
	    return this.options.items.each(function(index, el) {
	      var height, item, offsetTop, remainHeight;
	      item = $(el);
	      height = item.outerHeight();
	      offsetTop = item.offset().top;
	      remainHeight = offsetTop + height - scrollTop;
	      if (scrollTop + windowH <= offsetTop || scrollTop >= offsetTop + height) {
	        return;
	      }
	      if (remainHeight < parallaxOffset) {
	        return item.css({
	          'transform': "translateY(-" + ((parallaxOffset - remainHeight) * parallaxSpeed) + "px)",
	          'opacity': remainHeight * 3 / parallaxOffset / 4
	        });
	      } else {
	        return item.css({
	          'transform': '',
	          'opacity': ''
	        });
	      }
	    });
	  }
	});

	$.widget.bridge('fbqParallaxContent', $.fabrique.parallaxContent);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 566:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var PhotoSwipe, PhotoSwipeUiDefault, PlaceHolder;

	PhotoSwipe = __webpack_require__(537);

	PhotoSwipeUiDefault = __webpack_require__(538);

	PlaceHolder = __webpack_require__(567);

	$.widget('fabrique.photoSwipe', {
	  options: {
	    type: 'image',
	    iframeType: 'video',
	    galley: false,
	    gallerySelector: 'a',
	    target: '',
	    index: 0
	  },
	  _create: function() {
	    var self;
	    self = this;
	    this.pswpEl = FabriqueApp.pswpElement;
	    this.items = [];
	    this.images = [];
	    this.iframeType = this.options.iframeType;
	    if (!this.pswpEl.length) {
	      return;
	    }
	    this.pswpOptions = {
	      history: false,
	      shareEl: false,
	      bgOpacity: 0.85
	    };
	    if (this.options.gallery) {
	      return this._initializeGalleryPopup();
	    } else {
	      return this._initializeImagePopup(this.options.type);
	    }
	  },
	  _initializeImagePopup: function(type) {
	    var self;
	    self = this;
	    this.pushPopupItem(this.element, type);
	    if (this.options.type === 'image') {
	      this._addZoomInAnimation();
	    }
	    return this.element.on('click', function(e) {
	      e.preventDefault();
	      return self._openPhotoSwipe();
	    });
	  },
	  _initializeGalleryPopup: function() {
	    var imageParents, obj, self;
	    self = this;
	    imageParents = this.element.find(this.options.gallerySelector);
	    if (imageParents.length > 0) {
	      imageParents.each(function(i, imageParent) {
	        var imageEl;
	        imageEl = $(imageParent);
	        if (!imageEl.closest('.slick-cloned').length) {
	          return self.pushPopupItem(imageEl, self.options.type);
	        }
	      });
	      if (self.options.type === 'image') {
	        this._addZoomInAnimation();
	      }
	      this._on(this.element, (
	        obj = {},
	        obj["click " + this.options.gallerySelector] = '_galleryImageClicked',
	        obj
	      ));
	      return this.element.on('imageLinkChanged.fbq', function(e, value) {
	        return self.updateImageSrc(value.index, value.src);
	      });
	    }
	  },
	  _galleryImageClicked: function(e) {
	    var imageLink, index;
	    e.preventDefault();
	    imageLink = $(e.currentTarget);
	    index = imageLink.data('index');
	    return this._openPhotoSwipe(index);
	  },
	  _addZoomInAnimation: function() {
	    var images;
	    images = this.images;
	    if (images.length > 0) {
	      return this.pswpOptions.getThumbBoundsFn = function(index) {
	        var image, imageW, imageX, imageY;
	        image = images[index];
	        image = image.is(':visible') ? image : image.parent();
	        imageX = image.offset().left;
	        imageY = image.offset().top;
	        imageW = image.width();
	        if (!isNaN(imageX) && !isNaN(imageY) && !isNaN(imageW)) {
	          return {
	            x: imageX,
	            y: imageY,
	            w: imageW
	          };
	        } else {

	        }
	      };
	    }
	  },
	  pushPopupItem: function(imageParent, type) {
	    var content, contentEl, embedSrc, image, imageH, imageW, msrc, src, title;
	    src = this.options.target.length ? this.options.target : imageParent.attr('href');
	    contentEl = imageParent.siblings('.fbq-content-modal');
	    if (type === 'iframe') {
	      embedSrc = this.getEmbedSrc(src);
	      if (this.iframeType === 'mp4') {
	        content = "<video width=\"1280\" height=\"720\" src=\"" + embedSrc + "\" controls autoplay=\"autoplay\"></video>";
	      } else {
	        content = "<iframe src=\"" + embedSrc + "\" width=\"1280\" height=\"720\"></iframe>";
	      }
	      return this.items.push({
	        html: "<div class=\"fbq-modal-embed\">\n  <div class=\"fbq-modal-embed-inner\">\n    <div class=\"fbq-modal-embed-placeholder\"></div>\n    " + content + "\n  </div>\n</div>"
	      });
	    } else if (type === 'content' && contentEl.length) {
	      return this.items.push({
	        html: contentEl[0].outerHTML
	      });
	    } else {
	      image = imageParent.find('img');
	      msrc = image.attr('src');
	      msrc = msrc ? msrc : PlaceHolder;
	      title = image.attr('title');
	      title = title ? title : this.element.data('title');
	      if (image.length > 0) {
	        this.images.push(image);
	      }
	      imageW = image.data('full-width');
	      imageH = image.data('full-height');
	      return this.items.push({
	        src: src,
	        w: imageW ? imageW : 0,
	        h: imageH ? imageH : 0,
	        title: title,
	        msrc: msrc
	      });
	    }
	  },
	  updateImageSrc: function(index, imageSrc, imageW, imageH) {
	    this.items[index].src = imageSrc;
	    this.items[index].msrc = imageSrc;
	    this.items[index].w = imageW ? imageW : 0;
	    return this.items[index].h = imageH ? imageH : 0;
	  },
	  getEmbedSrc: function(embedSrc) {
	    var patterns;
	    if (embedSrc.indexOf('youtube.com') >= 0 || embedSrc.indexOf('vimeo.com') >= 0) {
	      this.iframeType = 'video';
	      patterns = {
	        youtube: {
	          index: 'youtube.com',
	          id: 'v=',
	          src: '//www.youtube-nocookie.com/embed/%id%?autoplay=1'
	        },
	        vimeo: {
	          index: 'vimeo.com/',
	          id: '/',
	          src: '//player.vimeo.com/video/%id%?autoplay=1'
	        }
	      };
	      $.each(patterns, function() {
	        if (embedSrc.indexOf(this.index) > -1) {
	          embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id) + this.id.length, embedSrc.length);
	          return embedSrc = this.src.replace('%id%', embedSrc);
	        }
	      });
	    } else if (embedSrc.indexOf('maps.google') >= 0 || embedSrc.indexOf('google.com/maps') >= 0) {
	      this.iframeType = 'map';
	      if (embedSrc.indexOf('//maps.google.') > -1) {
	        embedSrc = '%id%&output=embed'.replace('%id%', embedSrc);
	      }
	    } else if (embedSrc.indexOf('w.soundcloud.com') >= 0 || embedSrc.indexOf('mixcloud.com/widget/') >= 0) {
	      this.iframeType = 'audio';
	    } else if (embedSrc.indexOf('.mp4') > -1) {
	      this.iframeType = 'mp4';
	    }
	    return embedSrc;
	  },
	  _openPhotoSwipe: function(index) {
	    var pswpPopup, self;
	    self = this;
	    this.pswpOptions.index = index;
	    if (this.options.type === 'content') {
	      this.pswpOptions.closeOnScroll = false;
	    }
	    pswpPopup = new PhotoSwipe(this.pswpEl[0], PhotoSwipeUiDefault, this.items, this.pswpOptions);
	    pswpPopup.listen('gettingData', function(index, item) {
	      var img;
	      if (typeof item.src !== 'undefined') {
	        if (item.w < 1 || item.h < 1) {
	          img = new Image;
	          img.onload = function() {
	            item.w = this.width;
	            item.h = this.height;
	            pswpPopup.invalidateCurrItems();
	            return pswpPopup.updateSize(true);
	          };
	          return img.src = item.src;
	        }
	      }
	    });
	    pswpPopup.listen('close', function() {
	      self.pswpEl.find('iframe').attr('src', '');
	      return self.pswpEl.find('video').attr('src', '');
	    });
	    return pswpPopup.init();
	  }
	});

	$.widget.bridge('fbqPhotoSwipe', $.fabrique.photoSwipe);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 567:
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__.p + "images/fabrique-placeholder.png"

/***/ },

/***/ 568:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.pickerform', {
	  options: {
	    defaultPickerObject: {
	      enableBranches: false,
	      branchSelector: '.js-picker-branch',
	      dateSelector: '.js-picker-date',
	      timeSelector: '.js-picker-time',
	      dateFormat: 'mmmm d, yyyy',
	      timeFormat: 'h:i A',
	      scheduleOpen: [
	        {
	          weekdays: {
	            'monday': '1',
	            'tuesday': '1',
	            'wednesday': '1',
	            'thursday': '1',
	            'friday': '1',
	            'saturday': '1',
	            'sunday': '1'
	          }
	        }
	      ],
	      scheduleClose: [],
	      disableDates: [],
	      earlyBooking: true,
	      lateBooking: '',
	      timeInterval: '30',
	      firstDay: '0',
	      allowPast: true
	    }
	  },
	  _create: function() {
	    return this.init();
	  },
	  init: function() {
	    var branchSelector, initialBranch, pickerObjEl, pickerObjVal, self;
	    self = this;
	    pickerObjEl = this.element.find('.js-picker-object');
	    if (pickerObjEl) {
	      pickerObjVal = pickerObjEl.val();
	      if (typeof pickerObjVal !== 'undefined' && pickerObjVal !== '') {
	        this.pickerObject = JSON.parse(pickerObjVal);
	      } else {
	        this.pickerObject = this.options.defaultPickerObject;
	      }
	    } else {
	      this.pickerObject = this.options.defaultPickerObject;
	    }
	    this.pickerObject.enableBranches = this.pickerObject.enableBranches === 'true' ? true : false;
	    this.pickerObject.allowPast = this.pickerObject.allowPast === 'true' ? true : false;
	    if (this.pickerObject.enableBranches) {
	      branchSelector = this.element.find(this.pickerObject.branchSelector);
	      if (branchSelector.length) {
	        initialBranch = branchSelector.val();
	        this.updateDatepickerRange(this.pickerObject.scheduleOpen[initialBranch], this.pickerObject.scheduleClose[initialBranch], this.pickerObject.disableDates[initialBranch]);
	        return branchSelector.on('change', function(e) {
	          var branch;
	          branch = $(e.currentTarget).val();
	          return self.updateDatepickerRange(self.pickerObject.scheduleOpen[branch], self.pickerObject.scheduleClose[branch], self.pickerObject.disableDates[branch]);
	        });
	      } else {
	        return this.updateDatepickerRange(this.pickerObject.scheduleOpen, this.pickerObject.scheduleClose, this.pickerObject.disableDates);
	      }
	    } else {
	      return this.updateDatepickerRange(this.pickerObject.scheduleOpen, this.pickerObject.scheduleClose, this.pickerObject.disableDates);
	    }
	  },
	  updateDatepickerRange: function(scheduleOpen, scheduleClose, disableDates) {
	    var filteredDisableDates, firstDay, self, today, weekdayNo;
	    self = this;
	    this.dateSelector = this.element.find(this.pickerObject.dateSelector);
	    if (!this.dateSelector.length) {
	      return;
	    }
	    today = new Date;
	    firstDay = parseInt(this.pickerObject.firstDay);
	    if (typeof this.datepicker !== 'undefined') {
	      this.datepicker.set('enable', false);
	      this.datepicker.set('disable', false);
	    }
	    this.datepicker = this.dateSelector.pickadate({
	      min: !self.pickerObject.allowPast,
	      firstDay: firstDay,
	      format: self.pickerObject.dateFormat,
	      formatSubmit: 'yyyy/mm/dd',
	      hiddenName: true,
	      container: 'body',
	      enable: false,
	      disable: false,
	      onStart: function() {
	        var date;
	        if (self.dateSelector.val() !== '') {
	          date = new Date(self.dateSelector.val());
	          if (Object.prototype.toString.call(date) === '[object Date]') {
	            return this.set('select', date);
	          }
	        }
	      }
	    }).pickadate('picker');
	    if ((!this.pickerObject.earlyBooking) || (this.pickerObject.earlyBooking === 'true')) {
	      this.datepicker.set('max', false);
	    } else {
	      this.datepicker.set('max', new Date(today.getTime() + parseInt(self.pickerObject.earlyBooking) * 24 * 60 * 60 * 1000));
	    }
	    if ((typeof disableDates !== 'undefined') && disableDates.length) {
	      filteredDisableDates = $.extend(true, [], disableDates);
	      weekdayNo = 0;
	      $.each(disableDates.settings, function(disableKey, disableValue) {
	        if (typeof disableValue === 'number') {
	          weekdayNo = disableValue - firstDay;
	          if (weekdayNo < 1) {
	            weekdayNo = 7;
	          }
	          return filteredDisableDates[disableKey] = weekdayNo;
	        }
	      });
	      this.datepicker.set('disable', filteredDisableDates);
	    }
	    if (this.pickerObject.lateBooking) {
	      if (this.pickerObject.lateBooking === 'sameday') {
	        this.datepicker.set('min', 1);
	      } else {
	        this.pickerObject.lateBooking = parseInt(this.pickerObject.lateBooking, 10);
	        if (this.pickerObject.lateBooking >= 1440) {
	          this.datepicker.set('min', Math.floor(this.pickerObject.lateBooking / 1440));
	        }
	      }
	    }
	    if (this.dateSelector.val() === '') {
	      this.datepicker.set('select', new Date);
	    }
	    this.timeSelector = this.element.find(this.pickerObject.timeSelector);
	    if (!this.timeSelector.length) {
	      return;
	    }
	    this.timepicker = this.timeSelector.pickatime({
	      interval: parseInt(self.pickerObject.timeInterval, 10),
	      format: self.pickerObject.timeFormat,
	      formatSubmit: 'h:i A',
	      hiddenName: true,
	      container: 'body',
	      onStart: function() {
	        var time, todayDate;
	        if (self.timeSelector.val() !== '') {
	          today = new Date;
	          todayDate = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
	          time = new Date(todayDate + ' ' + self.timeSelector.val());
	          if (Object.prototype.toString.call(time) === '[object Date]') {
	            return this.set('select', time);
	          }
	        }
	      }
	    }).pickatime('picker');
	    this.updateTimepickerRange(scheduleOpen, scheduleClose, disableDates);
	    this.datepicker.on('close', function(e) {
	      $(document.activeElement).blur();
	      return self.updateTimepickerRange(scheduleOpen, scheduleClose, disableDates);
	    });
	    return this.timepicker.on('close', function(e) {
	      return $(document.activeElement).blur();
	    });
	  },
	  updateTimepickerRange: function(scheduleOpen, scheduleClose, disableDates) {
	    var currentDay, dayEnd, dayEndFrom, dayEndTo, disableTimes, exceptionDate, exceptionEndTime, exceptionStartTime, ruleEndTime, ruleStartTime, selectDay, selectDayDate, selectDayMonth, selectDayYear, selectWeekday, self, weekdays;
	    self = this;
	    this.timepicker.set('enable', false);
	    this.timepicker.set('disable', false);
	    if (this.datepicker.get() === '') {
	      this.timepicker.set('disable', [true]);
	      return;
	    }
	    currentDay = new Date;
	    selectDay = new Date(this.datepicker.get('select', 'yyyy/mm/dd'));
	    selectDayYear = selectDay.getFullYear();
	    selectDayMonth = selectDay.getMonth();
	    selectDayDate = selectDay.getDate();
	    dayEnd = this.getDayEndTime();
	    disableTimes = [dayEnd];
	    dayEndFrom = dayEnd.from;
	    dayEndTo = dayEnd.to;
	    if (typeof scheduleClose !== 'undefined') {
	      exceptionDate = [];
	      exceptionStartTime = [];
	      exceptionEndTime = [];
	      $.each(scheduleClose, function(closedKey, closedDay) {
	        var isDayEndForm, isDayEndTo, undefinedTime;
	        exceptionDate = new Date(closedDay.date);
	        if ((exceptionDate.getFullYear() === selectDayYear) && (exceptionDate.getMonth() === selectDayMonth) && (exceptionDate.getDate() === selectDayDate)) {
	          exceptionStartTime = dayEndFrom;
	          exceptionEndTime = dayEndTo;
	          undefinedTime = false;
	          if (typeof closedDay.time === 'undefined') {
	            undefinedTime = true;
	            exceptionStartTime = self.getEarliestTime(exceptionStartTime, selectDay, currentDay);
	            if (exceptionStartTime === dayEndFrom) {
	              self.timepicker.set('disable', [true]);
	              return;
	            }
	          } else {
	            if (typeof closedDay.time.start !== 'undefined') {
	              exceptionStartTime = self.convertTo24Hour(closedDay.time.start);
	              exceptionStartTime = self.getEarliestTime(exceptionStartTime, selectDay, currentDay);
	            }
	            if (typeof closedDay.time.end !== 'undefined') {
	              exceptionEndTime = self.convertTo24Hour(closedDay.time.end);
	            }
	          }
	          isDayEndForm = (exceptionStartTime[0] === dayEndFrom[0]) && (exceptionStartTime[1] === dayEndFrom[1]);
	          isDayEndTo = (exceptionEndTime[0] === dayEndTo[0]) && (exceptionEndTime[1] === dayEndTo[1]);
	          if (!undefinedTime && (!isDayEndForm || !isDayEndTo)) {
	            return disableTimes.push({
	              from: exceptionStartTime,
	              to: exceptionEndTime,
	              inverted: true
	            });
	          }
	        }
	      });
	      if (disableTimes.length > 1) {
	        this.timepicker.set('disable', disableTimes);
	        return;
	      }
	    }
	    if (typeof scheduleOpen !== 'undefined') {
	      selectWeekday = selectDay.getDay();
	      weekdays = {
	        sunday: 0,
	        monday: 1,
	        tuesday: 2,
	        wednesday: 3,
	        thursday: 4,
	        friday: 5,
	        saturday: 6
	      };
	      ruleStartTime = [];
	      ruleEndTime = [];
	      $.each(scheduleOpen, function(openKey, openDay) {
	        if (typeof openDay.weekdays !== 'undefined') {
	          return $.each(openDay.weekdays, function(weekdayKey, openWeekday) {
	            var isDayEndForm, isDayEndTo, undefinedTime;
	            if (weekdays[weekdayKey] === selectWeekday) {
	              ruleStartTime = dayEndFrom;
	              ruleEndTime = dayEndTo;
	              undefinedTime = false;
	              if (typeof openDay.time === 'undefined') {
	                undefinedTime = true;
	                ruleStartTime = self.getEarliestTime(ruleStartTime, selectDay, currentDay);
	                if (ruleStartTime === dayEndFrom) {
	                  self.timepicker.set('disable', [true]);
	                  return;
	                }
	              } else {
	                if (typeof openDay.time.start !== 'undefined') {
	                  ruleStartTime = self.convertTo24Hour(openDay.time.start);
	                  ruleStartTime = self.getEarliestTime(ruleStartTime, selectDay, currentDay);
	                }
	                if (typeof openDay.time.end !== 'undefined') {
	                  ruleEndTime = self.convertTo24Hour(openDay.time.end);
	                }
	              }
	              isDayEndForm = (ruleStartTime[0] === dayEndFrom[0]) && (ruleStartTime[1] === dayEndFrom[1]);
	              isDayEndTo = (ruleEndTime[0] === dayEndTo[0]) && (ruleEndTime[1] === dayEndTo[1]);
	              if (!undefinedTime && (!isDayEndForm || !isDayEndTo)) {
	                return disableTimes.push({
	                  from: ruleStartTime,
	                  to: ruleEndTime,
	                  inverted: true
	                });
	              }
	            }
	          });
	        }
	      });
	      if (disableTimes.length > 1) {
	        this.timepicker.set('disable', disableTimes);
	        return;
	      }
	    }
	    this.timepicker.set('enable', true);
	    return this.timepicker.set('disable', false);
	  },
	  getDayEndTime: function() {
	    var hour, interval;
	    interval = this.pickerObject.timeInterval;
	    hour = 24;
	    while (interval >= 60) {
	      hour--;
	      interval -= 60;
	    }
	    if (interval > 0) {
	      hour--;
	      interval = 60 - interval;
	    }
	    return {
	      from: [0, 0],
	      to: [hour, interval]
	    };
	  },
	  convertTo24Hour: function(timeStr) {
	    var hours, meridian, minutes, time;
	    time = timeStr.match(/(\d+):(\d+) (\w)/);
	    hours = Number(time[1]);
	    minutes = Number(time[2]);
	    meridian = time[3].toLowerCase();
	    if (meridian === 'p' && hours < 12) {
	      hours = hours + 12;
	    } else if (meridian === 'a' && hours === 12) {
	      hours = hours - 12;
	    }
	    return [hours, minutes];
	  },
	  getEarliestTime: function(startTime, selectDay, currentDay) {
	    var currentMinute, lateMinute, startMinute;
	    if ((selectDay.getDate() === currentDay.getDate()) && !this.pickerObject.allowPast) {
	      startMinute = startTime[0] * 60 + startTime[1];
	      currentMinute = currentDay.getHours() * 60 + currentDay.getMinutes();
	      startMinute = startMinute > currentMinute ? startMinute : currentMinute;
	      if ((typeof this.pickerObject.lateBooking === 'number') && (this.pickerObject.lateBooking % 1 === 0)) {
	        lateMinute = currentMinute + this.pickerObject.lateBooking;
	        if (lateMinute > startMinute) {
	          startMinute = lateMinute;
	        }
	      }
	      startTime = [Math.floor(startMinute / 60), startMinute % 60];
	    }
	    return startTime;
	  }
	});

	$.widget.bridge('fbqPickerForm', $.fabrique.pickerform);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 569:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.pinned', {
	  options: {
	    initialOffset: -20,
	    navbarStackHeight: 56,
	    duration: 0,
	    showIndicators: true,
	    parentElement: '.fbq-row',
	    referenceElement: ''
	  },
	  _create: function() {
	    var navbar, navbarHeight, relatedId, self, setOffset, transition;
	    this.windowWidth = $(window).width();
	    this.isResponsive = FabriqueApp.isResponsive;
	    this.mobileScreenWidth = FabriqueApp.mobileScreenWidth;
	    if (FabriqueApp.isMobileOrTablet && this.isResponsive && this.windowWidth <= this.mobileScreenWidth) {

	    } else {
	      this.duration = this.options.duration;
	      this.pinned = true;
	      self = this;
	      if (this.element.attr('data-pinned') || this.options.referenceElement.length) {
	        relatedId = this.options.referenceElement ? this.options.referenceElement : this.element.data('pinned');
	        this.relatedElement = this.element.closest(this.options.parentElement).find(relatedId);
	        if (this.relatedElement.length) {
	          setOffset = this.element.data('pinned_offset');
	          if (setOffset || setOffset === 0) {
	            this.offset = -parseInt(setOffset);
	          } else {
	            this.offset = this.options.initialOffset;
	            navbar = FabriqueApp.mainNavbar;
	            if (navbar.attr('data-fixed')) {
	              transition = navbar.data('transition');
	              if (transition === 'default') {
	                if (!navbar.hasClass('fbq-navbar--stacked')) {
	                  navbarHeight = navbar.outerHeight();
	                } else if (navbar.attr('data-stacked_menu_height')) {
	                  navbarHeight = navbar.data('stacked_menu_height');
	                } else {
	                  navbarHeight = this.options.navbarStackHeight;
	                }
	              } else {
	                navbarHeight = navbar.data('height_fixed');
	              }
	              this.offset -= navbarHeight;
	            }
	          }
	          this.scene = new ScrollMagic.Scene({
	            triggerElement: this.element[0],
	            triggerHook: 'onLeave',
	            duration: this.duration,
	            offset: this.offset
	          });
	          this.scene.addTo(FabriqueApp.smController);
	          if (this.isResponsive) {
	            if (this.windowWidth > this.mobileScreenWidth) {
	              setTimeout(function() {
	                return self._setPin();
	              }, 1000);
	            } else {
	              this.pinned = false;
	            }
	          } else {
	            setTimeout(function() {
	              return self._setPin();
	            }, 1000);
	          }
	          return $(window).on('resize', function(e) {
	            clearTimeout(self.resizeTimer);
	            return self.resizeTimer = setTimeout(function() {
	              return self._windowResize();
	            }, 500);
	          });
	        }
	      }
	    }
	  },
	  calculateHeight: function() {
	    var elementHeight, relatedHeight;
	    relatedHeight = this.relatedElement.outerHeight();
	    elementHeight = this.element.outerHeight();
	    if (this.isResponsive) {
	      if (relatedHeight < elementHeight) {
	        return this._removePin();
	      } else {
	        return this.duration = relatedHeight - elementHeight;
	      }
	    } else {
	      return this.duration = relatedHeight - elementHeight;
	    }
	  },
	  updateDuration: function() {
	    var positionTop;
	    this.calculateHeight();
	    this.scene.duration(this.duration);
	    return positionTop = this.element.css('top');
	  },
	  _windowResize: function() {
	    var viewportWidth;
	    viewportWidth = $(window).width();
	    if (this.isResponsive) {
	      if (viewportWidth > this.mobileScreenWidth) {
	        this.updateDuration();
	        if (this.windowWidth <= this.mobileScreenWidth && !this.pinned) {
	          this._setPin();
	        }
	      } else if (viewportWidth <= this.mobileScreenWidth && this.windowWidth > this.mobileScreenWidth) {
	        this._removePin();
	      }
	    } else {
	      this.updateDuration();
	    }
	    return this.windowWidth = viewportWidth;
	  },
	  _setPin: function() {
	    this.scene.setPin(this.element[0]);
	    this.updateDuration();
	    return this.pinned = true;
	  },
	  _removePin: function() {
	    this.scene.removePin(true);
	    return this.pinned = false;
	  }
	});

	$.widget.bridge('fbqPinned', $.fabrique.pinned);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 570:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.productGallery', {
	  _create: function() {
	    var action;
	    action = this.element.data('action');
	    this.element.fbqGallery();
	    if (action === 'zoom' || action === 'both') {
	      return this._on(this.element, {
	        'mousemove .fbq-gallery-item': '_mouseMoveZoom'
	      });
	    }
	  },
	  _mouseMoveZoom: function(e) {
	    var coordLeft, coordTop, el, normalHeight, normalWidth, ratioX, ratioY, wrapLeft, wrapTop, zoomImage, zoomWidth, zoomheight;
	    el = $(e.currentTarget);
	    zoomImage = el.find('img:last-child');
	    wrapLeft = el.offset().left;
	    wrapTop = el.offset().top;
	    normalWidth = el.width();
	    normalHeight = el.height();
	    zoomWidth = zoomImage.width();
	    zoomheight = zoomImage.height();
	    ratioX = zoomWidth / normalWidth - 1;
	    ratioY = zoomheight / normalHeight - 1;
	    if (zoomImage.length > 0) {
	      coordLeft = (e.pageX - wrapLeft) * ratioX;
	      if (coordLeft < 0) {
	        coordLeft = 0;
	      }
	      if (coordLeft > zoomWidth) {
	        coordLeft = zoomWidth;
	      }
	      coordTop = (e.pageY - wrapTop) * ratioY;
	      if (coordTop < 0) {
	        coordTop = 0;
	      }
	      if (coordTop > zoomheight) {
	        coordTop = zoomheight;
	      }
	      return zoomImage.css({
	        'left': -coordLeft,
	        'top': -coordTop
	      });
	    }
	  }
	});

	$.widget.bridge('fbqProductGallery', $.fabrique.productGallery);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 571:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.row', {
	  options: {
	    isMobileOrTablet: false,
	    isResponsive: true
	  },
	  _create: function() {
	    var equalHeightBoxes, equalHeightGroup, self;
	    this.windowWidth = $(window).width();
	    this.isResponsive = FabriqueApp.isResponsive;
	    this.mobileScreenWidth = FabriqueApp.mobileScreenWidth;
	    if (FabriqueApp.isMobileOrTablet && this.isResponsive && (this.windowWidth < this.mobileScreenWidth || this.windowWidth === this.mobileScreenWidth)) {

	    } else {
	      equalHeightBoxes = this.element.children().children('.js-box-fitted');
	      if (equalHeightBoxes.length > 1) {
	        self = this;
	        equalHeightGroup = {};
	        equalHeightBoxes.each(function(i, el) {
	          var element, group;
	          element = $(el);
	          group = element.data('group');
	          if (equalHeightGroup.hasOwnProperty(group)) {
	            return equalHeightGroup[group].push(element);
	          } else {
	            return equalHeightGroup[group] = [element];
	          }
	        });
	        self._doEqualHeight(equalHeightGroup);
	        return $(window).on('resize', function(e) {
	          return self._windowResize(equalHeightGroup);
	        });
	      }
	    }
	  },
	  _doEqualHeight: function(groups, state) {
	    var self;
	    self = this;
	    return $.each(groups, function(key, value) {
	      if (value.length <= 1) {

	      } else {
	        if (state === 'unset') {
	          return self._unsetEqualHeight(value);
	        } else if ((self.isResponsive && self.windowWidth > self.mobileScreenWidth) || !self.isResponsive) {
	          return self._setEqualHeight(value);
	        }
	      }
	    });
	  },
	  _windowResize: function(groups) {
	    var self, viewportWidth;
	    self = this;
	    viewportWidth = $(window).width();
	    if (viewportWidth <= this.mobileScreenWidth && this.windowWidth > this.mobileScreenWidth) {
	      this._doEqualHeight(groups, 'unset');
	    } else {
	      clearTimeout(self.resizeTimer);
	      self.resizeTimer = setTimeout(function() {
	        return self._doEqualHeight(groups);
	      }, 200);
	    }
	    return this.windowWidth = viewportWidth;
	  },
	  _setEqualHeight: function(items) {
	    var borderHeight, maxHeight;
	    maxHeight = 0;
	    borderHeight = [];
	    $.each(items, function(i, el) {
	      var outerHeight;
	      el.children('.fbq-box-inner').css({
	        'height': '',
	        'line-height': ''
	      });
	      outerHeight = el.outerHeight();
	      borderHeight[i] = outerHeight - el.height();
	      return maxHeight = outerHeight > maxHeight ? outerHeight : maxHeight;
	    });
	    return $.each(items, function(i, el) {
	      var height;
	      height = maxHeight - borderHeight[i];
	      return el.children('.fbq-box-inner').css({
	        'height': height + 'px',
	        'line-height': height + 'px'
	      });
	    });
	  },
	  _unsetEqualHeight: function(items) {
	    return $.each(items, function(i, el) {
	      var boxInner, height;
	      boxInner = el.children('.fbq-box-inner');
	      boxInner.css({
	        'height': '',
	        'line-height': ''
	      });
	      height = boxInner.data('height' || '');
	      height = $.isNumeric(height) ? height + "px" : height;
	      return boxInner.css({
	        'height': height,
	        'line-height': height
	      });
	    });
	  }
	});

	$.widget.bridge('fbqRow', $.fabrique.row);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 572:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.search', {
	  _create: function() {
	    var searchBar, searchForm;
	    this.searchButton = this.element.find('.js-menu-search');
	    this.searchCloseButton = this.element.find('.js-menu-search');
	    if (this.searchButton.length) {
	      searchBar = this.element.find('.fbq-navbar-search');
	      if (searchBar.length) {
	        this.searchButton.on('click', function(e) {
	          e.preventDefault();
	          searchBar.toggleClass('active').slideToggle(300);
	          if (searchBar.hasClass('active')) {
	            return setTimeout(function() {
	              return searchBar.find('input[type="text"]').focus();
	            }, 500);
	          }
	        });
	        return this.element.find('.js-search-close').on('click', function(e) {
	          e.preventDefault();
	          return searchBar.removeClass('active').slideUp(300);
	        });
	      } else {
	        searchForm = this.searchButton.siblings('.fbq-search-form');
	        this.searchButton.on('click', function(e) {
	          e.preventDefault();
	          searchForm.toggleClass('active');
	          if (searchForm.hasClass('active')) {
	            return setTimeout(function() {
	              return searchForm.find('input[type="text"]').focus();
	            }, 500);
	          }
	        });
	        return this.element.find('.js-search-close').on('click', function(e) {
	          e.preventDefault();
	          return searchForm.removeClass('active');
	        });
	      }
	    }
	  }
	});

	$.widget.bridge('fbqSearch', $.fabrique.search);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 573:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.setSize', {
	  options: {
	    type: 'full',
	    itemWrapper: '',
	    pair: '',
	    addLineHeight: true,
	    mobileNavbarHeight: 60,
	    screenPercent: 100,
	    screenOffset: 0,
	    fluid: true
	  },
	  _create: function() {
	    var header, screenOffset;
	    this.type = this.options.type;
	    this.hasPair = this.options.pair.length;
	    if (this.options.itemWrapper.length) {
	      this.itemWrapper = this.element.find(this.options.itemWrapper);
	    } else {
	      this.itemWrapper = this.element;
	    }
	    if (!this.element.length) {
	      return;
	    }
	    header = FabriqueApp.header;
	    this.tabletScreenWidth = FabriqueApp.tabletScreenWidth;
	    this.mobileScreenWidth = FabriqueApp.mobileScreenWidth;
	    if (header.length) {
	      this.hasHeader = true;
	      this.isNavbarTransparent = header.data('transparent');
	      this.headerHeight = this.isNavbarTransparent ? 0 : header.outerHeight();
	    } else {
	      this.hasHeader = false;
	      this.headerHeight = 0;
	    }
	    this.screenPercent = this.element.data('screen_percent') ? this.element.data('screen_percent') / 100 : this.options.screenPercent / 100;
	    screenOffset = this.element.data('screen_offset') ? this.element.data('screen_offset') : this.options.screenOffset;
	    if (screenOffset === 'header') {
	      this.type = 'header';
	      this.offset = 0;
	    } else {
	      this.offset = parseInt(screenOffset);
	    }
	    this._setFullHeight();
	    return this._on($(window), {
	      'resize': $.proxy(this._setFullHeight)
	    });
	  },
	  _setFullHeight: function() {
	    var frameWidth, height, outerHeight, pairHeight, pairSetHeight, pairWrapper, setHeight;
	    this.windowWidth = $(window).width();
	    frameWidth = this.windowWidth > this.tabletScreenWidth ? FabriqueApp.frameWidth : 0;
	    height = (($(window).height() - (2 * frameWidth)) * this.screenPercent) - this.offset;
	    if (this.type === 'header') {
	      height = height - this._calculateHeaderHeight();
	    }
	    if (!this.options.fluid && this.windowWidth > this.tabletScreenWidth) {
	      setHeight = height + "px";
	    } else {
	      this.element.css({
	        'height': 'auto',
	        'line-height': 'inherit'
	      });
	      this.itemWrapper.css('display', 'block');
	      if (this.hasPair) {
	        this.options.pair.css({
	          'height': 'auto',
	          'line-height': 'inherit'
	        });
	        if (this.options.itemWrapper.length) {
	          pairWrapper = this.options.pair.find(this.options.itemWrapper);
	        } else {
	          pairWrapper = this.options.pair;
	        }
	        pairWrapper.css('display', 'block');
	        pairHeight = this.options.pair.outerHeight();
	        if (this.windowWidth > this.mobileScreenWidth) {
	          outerHeight = Math.max(this.element.outerHeight(), pairHeight);
	        } else {
	          outerHeight = this.element.outerHeight();
	        }
	        pairWrapper.css('display', '');
	      } else {
	        outerHeight = this.element.outerHeight();
	      }
	      this.itemWrapper.css('display', '');
	      setHeight = (Math.max(outerHeight, height)) + "px";
	    }
	    this.element.css('height', setHeight);
	    if (this.options.addLineHeight) {
	      this.element.css('line-height', setHeight);
	    } else {
	      this.element.css('line-height', '');
	    }
	    if (this.hasPair) {
	      if (this.windowWidth > this.mobileScreenWidth) {
	        pairSetHeight = setHeight;
	      } else {
	        pairSetHeight = (Math.max(pairHeight, height)) + "px";
	      }
	      this.options.pair.css('height', pairSetHeight);
	      if (this.options.addLineHeight) {
	        return this.options.pair.css('line-height', pairSetHeight);
	      } else {
	        return this.options.pair.css('line-height', '');
	      }
	    }
	  },
	  _calculateHeaderHeight: function() {
	    var mobileNavbarHeight, output;
	    if (FabriqueApp.isResponsive && this.hasHeader) {
	      mobileNavbarHeight = this.isNavbarTransparent ? 0 : this.options.mobileNavbarHeight;
	      output = this.windowWidth > this.tabletScreenWidth ? this.headerHeight : mobileNavbarHeight;
	    } else {
	      output = this.headerHeight;
	    }
	    return output;
	  }
	});

	$.widget.bridge('fbqSetSize', $.fabrique.setSize);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 574:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.shopDropdown', {
	  _create: function() {
	    var defaultText, defaultValue, dropdown, element, menu, options, selected, title;
	    element = this.element;
	    element.prepend('<div class="fbq-dropdown"></div>');
	    dropdown = element.find('.fbq-dropdown');
	    selected = element.find('option[selected]');
	    options = element.find('option');
	    if (selected.length) {
	      defaultText = selected.text();
	      defaultValue = selected.val();
	    } else {
	      defaultText = options.first().text();
	      defaultValue = options.first().val();
	    }
	    title = "<button class=\"fbq-dropdown-display fbq-p-text-color fbq-p-bg-bg fbq-p-border-border\">\n  <span>" + defaultText + "</span>\n  <i class=\"twf twf-caret-down\"></i>\n</button>";
	    menu = '<ul class="fbq-dropdown-menu fbq-p-bg-bg fbq-p-border-border"></ul>';
	    dropdown.append(title + menu);
	    options.each(function() {
	      var active;
	      if ($(this).val() === defaultValue) {
	        active = ' class="active"';
	      } else {
	        active = '';
	      }
	      return element.find('.fbq-dropdown-menu').append("<li" + active + "><a class=\"fbq-p-text-color\" href=\"#\" data-value=\"" + ($(this).val()) + "\">" + ($(this).text()) + "</a></li>");
	    });
	    element.find('.fbq-dropdown-menu').hide();
	    return this._on(this.element, {
	      'click button': '_buttonClicked',
	      'click a': '_dropdownClicked'
	    });
	  },
	  _buttonClicked: function(e) {
	    var dropdownMenu, element;
	    e.preventDefault();
	    element = this.element;
	    dropdownMenu = this.element.find('.fbq-dropdown-menu');
	    dropdownMenu.toggle();
	    return $(window).on('click', function(event) {
	      var eventTarget;
	      eventTarget = $(event.target);
	      if (!element.is(eventTarget.closest(".fbq-dropdown").parent())) {
	        return dropdownMenu.hide();
	      }
	    });
	  },
	  _dropdownClicked: function(e) {
	    var $el, parent, text, value;
	    e.preventDefault();
	    $el = $(e.currentTarget);
	    parent = $el.parent();
	    value = $el.data('value');
	    if (parent.hasClass('active')) {
	      return;
	    } else {
	      parent.addClass('active');
	      parent.siblings().removeClass('active');
	    }
	    text = $el.html();
	    this.element.find('button span').html(text);
	    this.element.find('.fbq-dropdown-menu').hide();
	    this.element.find('select').val(value);
	    return this.element.find('select').change();
	  }
	});

	$.widget.bridge('fbqShopDropdown', $.fabrique.shopDropdown);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 575:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.sideNavbar', {
	  _create: function() {
	    var position, self;
	    self = this;
	    this.element.fbqCollapsedMenu();
	    this.element.find('.fbq-nav-menu').fbqMenuMobile();
	    this.element.fbqSearch();
	    if (this.element.hasClass('fbq-side-navbar--minimal')) {
	      position = this.element.data('position');
	      return this.element.fbqDynamicMenuColor({
	        isSidenav: true,
	        refPosition: position
	      });
	    }
	  }
	});

	$.widget.bridge('fbqSideNavbar', $.fabrique.sideNavbar);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 576:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	var ScrollMagic;

	ScrollMagic = __webpack_require__(533);

	$.widget('fabrique.skill', {
	  options: {
	    axis: 'horizontal',
	    size: 110,
	    color: '#363636',
	    title: '',
	    percent: 80,
	    trackColor: '#f2f2f2',
	    thickness: 4
	  },
	  _create: function() {
	    var items, options, result;
	    result = this.element.attr('class').match(/fbq-skill--(\S+)/);
	    this.style = result ? result[1] : 'bar';
	    items = this.element.find('.fbq-skill-item');
	    this.length = items.length;
	    options = this.options;
	    return items.each((function(_this) {
	      return function(index, el) {
	        var data, properties, scene, self;
	        el = $(el);
	        data = el.data();
	        properties = {};
	        properties.axis = data.axis || options.axis;
	        properties.size = data.size || options.size;
	        properties.color = data.color || options.color;
	        properties.percent = data.percent || options.percent;
	        properties.baseColor = data.base || options.trackColor;
	        properties.thickness = data.thickness || options.thickness;
	        if (_this.style === 'circle') {
	          _this._circle(el, properties);
	        }
	        self = _this;
	        scene = new ScrollMagic.Scene({
	          triggerElement: el[0],
	          triggerHook: 'onEnter',
	          offset: 30
	        });
	        if (el.is(':visible')) {
	          scene.addTo(FabriqueApp.smController);
	          if (!el.hasClass('updated')) {
	            return scene.on('enter', function() {
	              return self._updateSkill(el, properties, index, scene);
	            });
	          }
	        } else {
	          return _this.element.on('hiddenOpen.fbq', function() {
	            self._updateSkill(el, properties, index, scene);
	            return self.element.off('hiddenOpen.fbq');
	          });
	        }
	      };
	    })(this));
	  },
	  _circle: function(el, properties) {
	    return el.find('.easyPieChart').easyPieChart({
	      size: properties.size,
	      barColor: properties.color,
	      scaleColor: false,
	      lineCap: 'square',
	      lineWidth: parseInt(properties.thickness),
	      trackColor: properties.baseColor
	    });
	  },
	  _updateSkill: function(el, properties, index, scene) {
	    var self;
	    self = this;
	    el.addClass('updated');
	    if (this.style === 'bar') {
	      if (properties.axis === 'horizontal') {
	        setTimeout(function() {
	          return el.find('.fbq-skill-progress').css('width', properties.percent + "%");
	        }, 100);
	      } else {
	        setTimeout(function() {
	          return el.find('.fbq-skill-progress').css('height', (100 - properties.percent) + "%");
	        }, 100);
	      }
	    } else {
	      el.find('.easyPieChart').data('easyPieChart').update(properties.percent);
	    }
	    scene.destroy();
	    if (index === this.length - 1) {
	      return this.element.off('hiddenOpen.fbq');
	    }
	  }
	});

	$.widget.bridge('fbqSkill', $.fabrique.skill);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 577:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.slider', {
	  _create: function() {
	    var fitHeightOptions, initScheme, self;
	    this.element.fbqCarousel({
	      speed: 600,
	      cssEase: 'ease-in'
	    });
	    this.slickDots = this.element.find('.slick-dots');
	    initScheme = this.element.find('.slick-active').first().data('scheme');
	    initScheme = initScheme ? initScheme : FabriqueApp.defaultScheme;
	    this.slickDots.addClass(initScheme);
	    if (this.element.hasClass('fbq-slider--fit-height')) {
	      fitHeightOptions = {
	        itemWrapper: '.fbq-slider-content',
	        addLineHeight: false
	      };
	      if (this.element.data('screen_percent')) {
	        fitHeightOptions.screenPercent = this.element.data('screen_percent');
	      }
	      if (this.element.data('screen_offset')) {
	        fitHeightOptions.screenOffset = this.element.data('screen_offset');
	      }
	      this.element.find('.fbq-slider-item').each(function(index, el) {
	        return $(el).fbqSetSize(fitHeightOptions);
	      });
	    }
	    self = this;
	    this.element.on('afterChange', function(event, slick, nextIndex) {
	      var colorScheme, nextSlide, nextSlideBg, otherSlideBg;
	      nextSlide = self.element.find(".slick-slide[data-slick-index='" + nextIndex + "']");
	      nextSlideBg = nextSlide.find('.fbq-background--zoom-in, .fbq-background--zoom-out');
	      otherSlideBg = nextSlide.siblings().find('.fbq-background--zoom-in, .fbq-background--zoom-out');
	      if (otherSlideBg) {
	        otherSlideBg.removeClass('animated');
	      }
	      if (nextSlideBg && !nextSlideBg.hasClass('animated')) {
	        nextSlideBg.addClass('animated');
	      }
	      colorScheme = nextSlide.data('scheme');
	      if (colorScheme) {
	        self.slickDots.removeClass('light dark').addClass(colorScheme);
	        return self.element.removeClass('fbq-slider-light-scheme fbq-slider-dark-scheme').addClass("fbq-slider-" + colorScheme + "-scheme");
	      } else {
	        self.element.removeClass('fbq-slider-light-scheme fbq-slider-dark-scheme');
	        return self.slickDots.removeClass('light dark').addClass(FabriqueApp.defaultScheme);
	      }
	    });
	    return this.element.on('beforeChange', function(event, slick, prevIndex, nextIndex) {
	      var nextSlide, nextSlideBg;
	      nextSlide = self.element.find(".slick-slide[data-slick-index='" + nextIndex + "']");
	      nextSlideBg = nextSlide.find('.fbq-background--zoom-in, .fbq-background--zoom-out');
	      return nextSlideBg.removeClass('animated');
	    });
	  }
	});

	$.widget.bridge('fbqSlider', $.fabrique.slider);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 578:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.tab', {
	  _create: function() {
	    var self;
	    self = this;
	    this.body = this.element.children('.fbq-tab-body').children('.fbq-tab-wrapper');
	    this._on(this.element.children('.fbq-tab-nav'), {
	      'click li': $.proxy(this._tabClicked, this)
	    });
	    return this.element.on('tabOpen.fbq', function(e, index) {
	      return self.tabOpen(index);
	    });
	  },
	  _tabClicked: function(e) {
	    var currentIndex, el;
	    e.preventDefault();
	    el = $(e.currentTarget);
	    currentIndex = el.data('index');
	    return this.tabOpen(currentIndex);
	  },
	  tabOpen: function(index) {
	    var currentElement, list, previousElement;
	    currentElement = this.body.children(".fbq-tab-content[data-index=" + index + "]");
	    if (!index || !currentElement) {
	      return;
	    }
	    previousElement = this.body.children('.fbq-tab-content.active');
	    if (!currentElement.hasClass('active')) {
	      previousElement.removeClass('active');
	      previousElement.find('.fbq-item').trigger('hiddenClose.fbq');
	      currentElement.addClass('active');
	      setTimeout(function() {
	        return currentElement.find('.fbq-item').trigger('hiddenOpen.fbq');
	      }, 500);
	      list = this.element.find('.fbq-tab-nav-list');
	      return list.removeClass('active').filter("[data-index=" + index + "]").addClass('active');
	    }
	  }
	});

	$.widget.bridge('fbqTab', $.fabrique.tab);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 579:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.variableProductImage', {
	  _create: function() {
	    var element, isZoom, noOfImages, originalFullSrc, originalSrc, originalSrcset, originalThumbnailSrc, originalThumbnailSrcset, productGallery, repImage, repMedia, repSlide, repThumbnailImage, repThumbnailSlide;
	    element = this.element;
	    productGallery = element.parent('.summary').siblings('.fbq-product-gallery');
	    noOfImages = productGallery.find('.fbq-gallery-item').length;
	    repSlide = productGallery.find('.fbq-gallery-content').find('.slick-slide').first();
	    repMedia = repSlide.find('.fbq-gallery-media');
	    repImage = repSlide.find('img');
	    isZoom = repMedia.hasClass('fbq-gallery-media--zoom') ? true : false;
	    originalSrc = repImage.attr('src');
	    originalSrcset = repImage.attr('srcset');
	    originalSrcset = originalSrcset ? originalSrcset : '';
	    originalFullSrc = repMedia.attr('href');
	    originalFullSrc = originalFullSrc ? originalFullSrc : '';
	    repThumbnailSlide = productGallery.find('.fbq-gallery-thumbnail').find('.slick-slide').filter("[data-slick-index=0],[data-slick-index=" + (0 - noOfImages) + "],[data-slick-index=" + (0 + noOfImages) + "]");
	    repThumbnailImage = repThumbnailSlide.find('img');
	    originalThumbnailSrc = repThumbnailImage.attr('src');
	    originalThumbnailSrcset = repThumbnailImage.attr('srcset');
	    originalThumbnailSrcset = originalThumbnailSrcset ? originalThumbnailSrcset : '';
	    element.on('change', function(e) {
	      if ((e.target.type === 'select-one') && !e.target.value.length) {
	        repImage.attr({
	          'src': originalSrc,
	          'srcset': originalSrcset
	        });
	        repThumbnailImage.attr({
	          'src': originalThumbnailSrc,
	          'srcset': originalThumbnailSrcset
	        });
	        if (!isZoom) {
	          productGallery.trigger('imageLinkChanged.fbq', {
	            index: 0,
	            src: originalFullSrc
	          });
	          return repMedia.attr('href', originalFullSrc);
	        }
	      }
	    });
	    return element.find('.single_variation_wrap').on('show_variation', function(e, variation) {
	      var existingImage, newFullSrc, newSrc, newSrcset, newThumbnailSrc, newThumbnailSrcset;
	      if (variation.image_id) {
	        existingImage = productGallery.find(".fbq-gallery-item[data-id=" + variation.image_id + "]");
	        if (existingImage.length) {
	          productGallery.children().slick('slickGoTo', existingImage.data('slick-index'));
	          return;
	        } else if (variation.image && variation.image.url) {
	          productGallery.children().slick('slickGoTo', 0);
	          newFullSrc = variation.image.url;
	          newSrc = variation.image.src;
	          newSrcset = variation.image.srcset;
	          newThumbnailSrc = variation.image.thumb_src;
	          newThumbnailSrcset = newSrcset;
	        }
	      } else {
	        newFullSrc = originalSrc;
	        newSrc = originalSrc;
	        newSrcset = originalSrcset;
	        newThumbnailSrc = originalThumbnailSrc;
	        newThumbnailSrcset = originalThumbnailSrcset;
	      }
	      newSrcset = newSrcset ? newSrcset : '';
	      newThumbnailSrcset = newThumbnailSrcset ? newThumbnailSrcset : '';
	      repImage.attr({
	        'src': newSrc,
	        'srcset': newSrcset
	      });
	      repThumbnailImage.attr({
	        'src': newThumbnailSrc,
	        'srcset': newThumbnailSrcset
	      });
	      if (!isZoom) {
	        productGallery.trigger('imageLinkChanged.fbq', {
	          index: 0,
	          src: newFullSrc
	        });
	        return repMedia.attr('href', newFullSrc);
	      }
	    });
	  }
	});

	$.widget.bridge('fbqVariableProductImage', $.fabrique.variableProductImage);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 580:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.variationRadio', {
	  _create: function() {
	    var element, variationForm, variationName, variations;
	    element = this.element;
	    variations = element.find('.variations-radio-input');
	    variations.on('click', function(e) {
	      var currentButton, select, value;
	      currentButton = $(e.currentTarget);
	      if (!currentButton.attr('disabled')) {
	        value = currentButton.attr('value');
	        select = element.siblings('select');
	        value = select.find('option[value="' + value + '"]').length ? value : '';
	        select.val(value);
	        return select.change();
	      }
	    });
	    variationForm = element.closest('form.variations_form');
	    if (variationForm.length) {
	      variationName = element.attr('name');
	      return variationForm.on('woocommerce_update_variation_values', function(e) {
	        var availableOptions, options;
	        options = variationForm.find("select#" + variationName + " option");
	        availableOptions = [];
	        options.each((function(_this) {
	          return function(index, option) {
	            return availableOptions.push($(option).val());
	          };
	        })(this));
	        return variations.each((function(_this) {
	          return function(index, variation) {
	            var variationInput, variationValue;
	            variationInput = $(variation);
	            variationValue = variationInput.val();
	            if (availableOptions.indexOf(variationValue) < 0) {
	              return variationInput.attr('disabled', true);
	            } else {
	              return variationInput.attr('disabled', false);
	            }
	          };
	        })(this));
	      });
	    }
	  }
	});

	$.widget.bridge('fbqVariationRadio', $.fabrique.variationRadio);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 581:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function($) {'use strict';

	$.widget('fabrique.video', {
	  options: {
	    autoplay: false
	  },
	  _create: function() {
	    var dataAutoplay, self, videoURL;
	    self = this;
	    this.video = this.element.find('video');
	    this.videoIframe = this.element.find('iframe');
	    dataAutoplay = this.element.data('autoplay');
	    this.isAutoPlay = dataAutoplay ? dataAutoplay : this.options.autoplay;
	    if (this.video.length > 0 && this.video.is(':visible') && this.isAutoPlay) {
	      setTimeout(function() {
	        if (self.video[0].paused) {
	          return self.video[0].play();
	        }
	      }, 150);
	    } else if (this.videoIframe.length > 0 && !this.videoIframe.is(':visible') && this.isAutoPlay) {
	      videoURL = this.videoIframe.prop('src').replace('&autoplay=1', '');
	      this.videoIframe.prop('src', '');
	      this.videoIframe.prop('src', videoURL);
	    }
	    this.element.on('hiddenOpen.fbq', function() {
	      return setTimeout(function() {
	        return self.startPlayingVideo();
	      }, 500);
	    });
	    return this.element.on('hiddenClose.fbq', function() {
	      return self.stopPlayingVideo();
	    });
	  },
	  startPlayingVideo: function() {
	    var videoURL;
	    if (this.isAutoPlay) {
	      if (this.video.length) {
	        return this.video[0].play();
	      } else if (this.videoIframe.length) {
	        videoURL = this.videoIframe.prop('src').replace('&autoplay=1', '');
	        videoURL += "&autoplay=1";
	        return this.videoIframe.prop('src', videoURL);
	      }
	    }
	  },
	  stopPlayingVideo: function() {
	    var videoURL;
	    if (this.video.length) {
	      this.video[0].pause();
	    }
	    if (this.isAutoPlay && this.videoIframe.length) {
	      videoURL = this.videoIframe.prop('src').replace('&autoplay=1', '');
	      this.videoIframe.prop('src', '');
	      return this.videoIframe.prop('src', videoURL);
	    }
	  }
	});

	$.widget.bridge('fbqVideo', $.fabrique.video);

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(6)))

/***/ },

/***/ 582:
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__.p + "images/fabrique-admin.png"

/***/ }

});