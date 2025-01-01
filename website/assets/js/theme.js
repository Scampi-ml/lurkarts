(function ($) {
	"use strict";

// Preloader
$(window).on('load', function () {
	$('.lds-ellipsis').fadeOut(); // will first fade out the loading animation
	$('.preloader').delay(1).fadeOut('fast'); // will fade out the white DIV that covers the website.
	$('body').delay(1);
});


// Header Sticky
$(window).on('scroll',function() {
	var stickytop = $('#header.sticky-top .bg-transparent');
	var stickytopslide = $('#header.sticky-top-slide');
	
	if ($(this).scrollTop() > 1){  
		stickytop.addClass("sticky-on-top");
		stickytop.find(".logo img").attr('src',stickytop.find('.logo img').data('sticky-logo'));
	}
	else {
		stickytop.removeClass("sticky-on-top");
		stickytop.find(".logo img").attr('src',stickytop.find('.logo img').data('default-logo'));
	}
	
	if ($(this).scrollTop() > 180){  
		stickytopslide.find(".primary-menu").addClass("sticky-on");
		stickytopslide.find(".logo img").attr('src',stickytopslide.find('.logo img').data('sticky-logo'));
	}
	else{
		stickytopslide.find(".primary-menu").removeClass("sticky-on");
		stickytopslide.find(".logo img").attr('src',stickytopslide.find('.logo img').data('default-logo'));
	}
});

/*---------------------------------------------------
    Primary Menu
----------------------------------------------------- */
// Dropdown show on hover
$('.primary-menu ul.navbar-nav li.dropdown').on("mouseover", function() {
	if ($(window).width() > 991) {
		$(this).find('> .dropdown-menu').stop().slideDown('fast');
		$(this).bind('mouseleave', function() {
		$(this).find('> .dropdown-menu').stop().css('display', 'none'); 
		});
		
	// When dropdown going off to the out of the screen.
	$('.primary-menu ul.navbar-nav > li.dropdown > .dropdown-menu').each(function() {
		var menu = $('#header .primary-menu > div').offset();
		var dropdown = $(this).parent().offset();
		if ($("html").attr("dir") == 'rtl') {
			var rd = ($(window).width() - (dropdown.left + $(this).parent().outerWidth()));
			var i = (rd + $(this).outerWidth()) - (menu.left + $('#header .primary-menu > div').outerWidth());
		}else{
			var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#header .primary-menu > div').outerWidth());
		}
		if (i > 0) {
			if ($("html").attr("dir") == 'rtl') {
				$(this).css('margin-right', '-' + (i) + 'px');
			}else{
				$(this).css('margin-left', '-' + (i) + 'px');
			}
		}
	});
		
	}
});

$(function () {
    $(".dropdown li").on('mouseenter mouseleave', function (e) {
		if ($(window).width() > 991) {
			if ($('.dropdown-menu', this).length) {
				var elm = $('.dropdown-menu', this);
				var off = elm.offset();
				var l = off.left;
				var w = elm.width();
				var docW = $(window).width();
				var lr = ($(window).width() - (off.left + elm.outerWidth())); //offset right
				if ($("html").attr("dir") == 'rtl') {
					var isEntirelyVisible = (lr + w + 30 <= docW);
				}else{
					var isEntirelyVisible = (l + w + 30 <= docW);
				}
				if (!isEntirelyVisible) {
					$(elm).addClass('dropdown-menu-end');
					$(elm).parents('.dropdown:first').find('> a.dropdown-toggle > .arrow').addClass('arrow-end');
				} else {
					$(elm).removeClass('dropdown-menu-end');
					$(elm).parents('.dropdown:first').find('> a.dropdown-toggle > .arrow').removeClass('arrow-end');
				}
			}
		}
    });
});

// DropDown Arrow
$('.primary-menu').find('a.dropdown-toggle').append($('<i />').addClass('arrow'));

// Mobile Collapse Nav
$('.primary-menu .dropdown-toggle[href="#"], .primary-menu .dropdown-toggle[href!="#"] .arrow').on('click', function(e) {
	if ($(window).width() < 991) {
        e.preventDefault();
        var $parentli = $(this).closest('li');
        $parentli.siblings('li').find('.dropdown-menu:visible').slideUp();
        $parentli.find('> .dropdown-menu').stop().slideToggle();
        $parentli.siblings('li').find('a .arrow.open').toggleClass('open');
		$parentli.find('> a .arrow').toggleClass('open');
	}
	});

// Mobile Menu
$('.navbar-toggler').on('click', function() {
	$(this).toggleClass('show');
});
$(".navbar-nav a:not(.dropdown-toggle)").on('click', function() {
    $(".navbar-collapse, .navbar-toggler").removeClass("show");
});

// Overlay Menu & Side Open Menu
$('.navbar-side-open .collapse, .navbar-overlay .collapse').on('show.bs.collapse hide.bs.collapse', function(e) {
    e.preventDefault();
}),
$('.navbar-side-open [data-bs-toggle="collapse"], .navbar-overlay [data-bs-toggle="collapse"]').on('click', function(e) {
   e.preventDefault();
   $($(this).data('bs-target')).toggleClass('show');
})

// Scroll to top
$(function () {
		$(window).on('scroll', function(){
			if ($(this).scrollTop() > 400) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		});

$('#back-to-top').on("click", function() {
	$('html, body').animate({scrollTop:0}, 'slow');
	return false;
});

})(jQuery)