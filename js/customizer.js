/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */


jQuery( document ).ready( function( $ ) {
	wp.customize( 'f2_theme_options[color_scheme]', function( setval ) {
		setval.bind( function( opt ) {
			$('body').removeClass('color-scheme-blue');
			$('body').removeClass('color-scheme-brown');
			$('body').removeClass('color-scheme-green');
			$('body').removeClass('color-scheme-dark');
			$('body').addClass('color-scheme-'+opt);
		});
	});
	wp.customize( 'f2_theme_options[sidebar_width]', function( setval ) {
		setval.bind( function( opt ) {
			$('body').removeClass('narrow-sidebar');
			$('body').removeClass('medium-sidebar');
			$('body').removeClass('wide-sidebar');
			$('body').addClass(opt+'-sidebar');
		});
	});
	wp.customize( 'f2_theme_options[sidebar_font_size]', function( setval ) {
		setval.bind( function( opt ) {
			$('body').removeClass('smaller-font-sidebar');
			$('body').removeClass('small-font-sidebar');
			$('body').removeClass('medium-font-sidebar');
			$('body').removeClass('large-font-sidebar');
			$('body').removeClass('larger-font-sidebar');
			$('body').addClass(opt+'-font-sidebar');
		});
	});
	wp.customize( 'f2_theme_options[content_font_size]', function( setval ) {
		setval.bind( function( opt ) {
			$('body').removeClass('smaller-font-content');
			$('body').removeClass('small-font-content');
			$('body').removeClass('medium-font-content');
			$('body').removeClass('large-font-content');
			$('body').removeClass('larger-font-content');
			$('body').addClass(opt+'-font-content');
		});
	});
} )