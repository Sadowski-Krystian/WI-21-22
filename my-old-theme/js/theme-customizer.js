(function( $ ) {
	"use strict";
	
	

	// Header Background Color - Color Control
	wp.customize( 'header_background_color_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'backgroundColor', to );
		} );
	});

	// Header Background Image - Image Control
	wp.customize( 'header_background_image_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-image', 'url( ' + to + ') ' );
		} );
	});

	// Header Background Image Repeat - Checkbox
	wp.customize( 'header_background_image_repeat_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-repeat', true === to ? 'repeat' : 'no-repeat' );
		} );
	} );

	// Header Background Image Size - Checkbox
	wp.customize( 'header_background_image_size_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-header' ).css( 'background-size', true === to ? 'cover' : 'auto auto' );
		} );
	} );


	// Header Background Color - Color Control
	wp.customize( 'footer_background_color_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'backgroundColor', to  );
		} );
	});

	// Header Background Image - Image Control
	wp.customize( 'footer_background_image_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'background-image', 'url( ' + to + ')' );
		} );
	});

	// Header Background Image Repeat - Checkbox
	wp.customize( 'footer_background_image_repeat_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'background-repeat', true === to ? 'repeat' : 'no-repeat' );
		} );
	} );

	// Header Background Image Size - Checkbox
	wp.customize( 'footer_background_image_size_setting', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( 'background-size', true === to ? 'cover' : 'auto auto' );
		} );
	} );


	// Header Background Color - Color Control
	wp.customize( 'menu_active_color_setting', function( value ) {
		value.bind( function( to ) {
		
			$( '.menu-header ul .current_page_item a' ).css( 'color', to  );
		} );
	});
	wp.customize( 'menu_active_color_setting', function( value ) {
		value.bind( function( to ) {
			$( '.menu-header ul .current_page_item a:hover' ).css( 'color', to  );
		} );
	});
	wp.customize( 'menu_active_color_setting', function( value ) {
		value.bind( function( to ) {
			$( '.menu-header ul li a:hover' ).css( 'color', to  );
		} );
	});
	wp.customize( 'menu_no_active_color_setting', function( value ) {
		value.bind( function( to ) {
			console.log("menu color");
			$( '.menu-header ul li a' ).css( 'color', to  );
		} );
	});

	// Header Background Color - Color Control
	wp.customize( 'footer_font_color_setting', function( value ) {
		value.bind( function( to ) {
			console.log("copy color");
			$( '.copyright' ).css( 'color', to  );
		} );
	});

	



	


	

})( jQuery );