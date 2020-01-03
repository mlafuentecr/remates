<?php

/*
	
@package mlm
	
	========================
		add logo to site identety custom-logo
	========================
*/


/* 0.5  Increase the Maximum File Upload Size
-------------------------------------------------------------- */
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );


/* 0.  logo theme support
-------------------------------------------------------------- */

add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

/* uso
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo $image[0];
*/

/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	

// Add custom size
add_image_size( 'brand-slider-image-size', 1024, 580, true ); 

// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wpthemebase_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


/* 0. ACF block
-------------------------------------------------------------- */
// add_action('acf/init', 'my_acf_init');
// function my_acf_init() {
	
// 	// check function exists
// 	if( function_exists('acf_register_block') ) {
		
// 		// register a testimonial block
// 		acf_register_block(array(
// 			'name'				=> 'testimonial',
// 			'title'				=> __('Testimonial'),
// 			'description'		=> __('A custom testimonial block.'),
// 			'render_callback'	=> 'my_acf_block_render_callback',
// 			'category'			=> 'formatting',
// 			'icon'				=> 'admin-comments',
// 			'keywords'			=> array( 'testimonial', 'quote' ),
// 		));
// 	}
// }




/* 0. Enable support for Post Thumbnails on posts and pages.
-------------------------------------------------------------- */
add_theme_support( 'post-thumbnails' );

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

	/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
