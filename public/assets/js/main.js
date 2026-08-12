;(function () {
	
	'use strict';

	$('.dropdown-toggle').click(function(e) {
		if ($(document).width() > 768) {
		  e.preventDefault();
	  
		  var url = $(this).attr('href');
	  
			 
		  if (url !== '#') {
		  
			window.location.href = url;
		  }
	  
		}
	});

	// iPad and iPod detection	
	var isiPad = function(){
		return (navigator.platform.indexOf("iPad") != -1);
	};

	var isiPhone = function(){
	    return (
			(navigator.platform.indexOf("iPhone") != -1) || 
			(navigator.platform.indexOf("iPod") != -1)
	    );
	};

	// Go to next section
	var gotToNextSection = function(){
		var el = $('.pms-learn-more'),
			w = el.width(),
			divide = -w/2;
		el.css('margin-left', divide);
	};

	// Loading page
	var loaderPage = function() {
		$(".pms-loader").fadeOut("slow");
	};

	// FullHeight
	var fullHeight = function() {
		if ( !isiPad() && !isiPhone() ) {
			$('.js-fullheight').css('height', $(window).height() - 49);
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height() - 49);
			})
		}
	};

	var toggleBtnColor = function() {

	
		if ( $('#pms-welcome').length > 0 ) {	
			$('#pms-welcome').waypoint( function( direction ) {
				if( direction === 'down' ) {
					$('.pms-nav-toggle').addClass('dark');
				}
			} , { offset: - $('#pms-welcome').height() } );

			$('#pms-welcome').waypoint( function( direction ) {
				if( direction === 'up' ) {
					$('.pms-nav-toggle').removeClass('dark');
				}
			} , { 
				offset:  function() { return -$(this.element).height() + 0; }
			} );
		}



	};
	
	function active_vessel() {
		if ($(".active_vessel").length) {
		  $(".active_vessel").owlCarousel({
			rtl: false,
			loop: true,
			margin: 20,
			items: 5,
			nav: true,
			autoplay: 2500,
			smartSpeed: 1500,
			dots: false,
			responsiveClass: true,
			thumbs: true,
			thumbsPrerendered: true,
			autoWidth:true,
			navText: ["", "<img src='images/p-prev.png'>"],
			responsive: {
			  0: {
				items: 1,
				margin: 0
			  },
			  991: {
				items: 2,
				margin: 30
			  },
			  1200: {
				items: 3,
				margin: 30
			  }
			}
		  });
		}
	  }
	  active_vessel();
	  
	function docks() {
		if ($(".docks").length) {
		  $(".docks").owlCarousel({
			rtl: false,
			loop: true,
			margin: 0,
			items: 6,
			nav: true,
			autoplay: 2500,
			smartSpeed: 1500,
			dots: false,
			responsiveClass: true,
			thumbs: true,
			thumbsPrerendered: true,
			autoWidth:true,
			navText: ["", "<img src='images/p-prev.png'>"],
			responsive: {
			  0: {
				items: 1,
				margin: 0
			  },
			  991: {
				items: 2,
				margin: 30
			  },
			  1200: {
				items: 3,
				margin: 30
			  }
			}
		  });
		}
	  }
	  docks();
	  
	  function affiliate() {
		if ($(".affiliate").length) {
		  $(".affiliate").owlCarousel({
			rtl: false,
			loop: true,
			margin: 20,
			items: 6,
			nav: true,
			autoplay: 2500,
			smartSpeed: 1500,
			dots: false,
			responsiveClass: true,
			thumbs: true,
			thumbsPrerendered: true,
			autoWidth:true,
			navText: ["<img src='images/aff-prev.png'>", "<img src='images/aff-next.png'>"],
			responsive: {
			  480: {
				items: 3,
				margin: 0
			  },
			  991: {
				items: 6,
				margin: 30
			  },
			  1200: {
				items: 6,
				margin: 30
			  }
			}
		  });
		}
	  }
	  affiliate();
	  
	  function newsslides() {
		if ($(".newsslides").length) {
		  $(".newsslides").owlCarousel({
			rtl: false,
			loop: true,
			margin: 0,
			items: 12,
			nav: true,
			autoplay: 2500,
			smartSpeed: 1500,
			dots: false,
			responsiveClass: true,
			thumbs: true,
			thumbsPrerendered: true,
			autoWidth:true,
			navText: ["<img src='images/arrow-left.png' width='40'>", "<img src='images/arrow-right.png' width='40'>"],
			responsive: {
			  0: {
				items: 1,
				margin: 0
			  },
			  991: {
				items: 2,
				margin: 30
			  },
			  1200: {
				items: 2,
				margin: 50
			  }
			}
		  });
		}
	  }
	  newsslides();


	// Scroll Next
	var ScrollNext = function() {
		$('body').on('click', '.scroll-btn', function(e){
			e.preventDefault();

			$('html, body').animate({
				scrollTop: $( $(this).closest('[data-next="yes"]').next()).offset().top
			}, 1000, 'easeInOutExpo');
			return false;
		});
	};
	
	
	$('.docks').magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery:{
			enabled:true
		},
		image: {
			titleSrc: function(item) {
			  var markup = '';
			  if (item.el[0].hasAttribute("data-title")) {
				markup += '<div class=biry36>' + item.el.attr('data-title') + '</div>';
			  }
	  
			  if (item.el[0].hasAttribute("data-caption")) {
				markup += '<p class=fbold>' + item.el.attr('data-caption') + '</p>';
			  }
			  return markup
			}
		},
		zoom: {
			enabled: true,
			duration: 300,
			easing: 'ease-in-out',
			opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	  });

	// Click outside of offcanvass
	var mobileMenuOutsideClick = function() {

		$(document).click(function (e) {
	    var container = $("#pms-offcanvas, .js-pms-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {

	    	if ( $('body').hasClass('offcanvas-visible') ) {

    			$('body').removeClass('offcanvas-visible');
    			$('.js-pms-nav-toggle').removeClass('active');
				
	    	}
	    
	    	
	    }
		});

	};


	// Offcanvas
	var offcanvasMenu = function() {
		$('body').prepend('<div id="pms-offcanvas" />');
		$('#pms-offcanvas').prepend('<ul id="pms-side-links">');
		$('body').prepend('<a href="#" class="js-pms-nav-toggle pms-nav-toggle"><i></i></a>');

		$('.left-menu li, .right-menu li').each(function(){

			var $this = $(this);

			$('#pms-offcanvas ul').append($this.clone());

		});
	};

	// Burger Menu
	var burgerMenu = function() {

		$('body').on('click', '.js-pms-nav-toggle', function(event){
			var $this = $(this);

			$('body').toggleClass('pms-overflow offcanvas-visible');
			$this.toggleClass('active');
			event.preventDefault();

		});

		$(window).resize(function() {
			if ( $('body').hasClass('offcanvas-visible') ) {
		   	$('body').removeClass('offcanvas-visible');
		   	$('.js-pms-nav-toggle').removeClass('active');
		   }
		});

		$(window).scroll(function(){
			if ( $('body').hasClass('offcanvas-visible') ) {
		   	$('body').removeClass('offcanvas-visible');
		   	$('.js-pms-nav-toggle').removeClass('active');
		   }
		});

	};


	var testimonialFlexslider = function() {
		var $flexslider = $('.flexslider');
		$flexslider.flexslider({
		  animation: "fade",
		  manualControls: ".flex-control-nav li",
		  directionNav: false,
		  smoothHeight: true,
		  useCSS: false /* Chrome fix*/
		});
	}


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500);
			
			return false;
		});
	
	};



	// Animations

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	
	

	// Document on load.
	$(function(){
		gotToNextSection();
		loaderPage();
		fullHeight();
		toggleBtnColor();
		ScrollNext();
		mobileMenuOutsideClick();
		offcanvasMenu();
		burgerMenu();
		testimonialFlexslider();
		goToTop();

		// Animate
		contentWayPoint();

	});


}());