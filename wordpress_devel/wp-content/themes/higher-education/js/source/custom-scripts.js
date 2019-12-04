jQuery(document).ready(function($) {
	//Header Video
	$( document ).on( 'wp-custom-header-video-loaded', function() {
        $( 'body' ).addClass( 'has-header-video' );
    });

	//Fit vids
	if ( jQuery.isFunction( jQuery.fn.fitVids ) ) {
		jQuery('.hentry, .widget').fitVids();
	}

	/*Search and Social Container*/
	$('.toggle-top').on('click', function(e){
		$(this).toggleClass('toggled-on');
	});

	$('#search-toggle').on('click', function(){
		$('.menu-social-container, #share-toggle').removeClass('toggled-on');
		$('.search-container').toggleClass('toggled-on');
	});

	$('#share-toggle').on('click', function(e){
		e.stopPropagation();
		$('.search-container, #search-toggle').removeClass('toggled-on');
		$('.menu-social-container').toggleClass('toggled-on');

	});

	/*Our Professors height adjustment on load */
	if ($(window).width() < 568) {

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 14;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});


	} else if($(window).width() < 768){

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 29;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});


	} else if($(window).width() < 1024){

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 43;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});

	} else {

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 48;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});

	}

	/*Our Professors height adjustment on resize*/
	$(window).on('resize', function () {

		if ($(window).width() < 568) {

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 14;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});


	} else if($(window).width() < 768){

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 29;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});


	} else if($(window).width() < 1024){

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 43;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});

	} else {

		$('#our-professors-section .hentry').hover(function(){
			var smallHeight = $(this).find('.entry-header').height() + 48;
			$(this).find('.entry-summary').css({'bottom': smallHeight, 'opacity': '1'});
		}, function(){
			$(this).find('.entry-summary').css({'bottom': -350, 'opacity': '0'});
		});

	}

	});
});
