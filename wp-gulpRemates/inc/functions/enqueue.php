<?php

/*
	
@package sunsettheme
	
	========================
		ADMIN ENQUEUE
	========================
*/

function load_custom_wp_admin_style() {
	wp_register_style( 'custom_wp_admin_css1', $GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/css/admin/admin.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css1' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


/*
	========================
		Login ENQUEUE 
	========================
*/

function mlm_enqueue_style() {
wp_enqueue_style( 'core', $GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/css/admin/login.css', false ); 
//wp_enqueue_style( 'core', $GLOBALS['themeCssPath'] . './src/css/login.css', false ); 
}

function mlm_enqueue_script() {
	 //wp_enqueue_script( 'my-js',  $GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/js/login.js', false ); 
	//wp_enqueue_script( 'my-js',  $GLOBALS['themeCssPath'] . './src/js/bundle.min.js', false ); 
}

add_action( 'login_enqueue_scripts', 'mlm_enqueue_style', 10 );
add_action( 'login_enqueue_scripts', 'mlm_enqueue_script', 1 );

/*
	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
*/

function mlm_theme_css_scripts() {
	wp_enqueue_style( 'caruselCss', $GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/css/layout/carousel.css', false ); 
	wp_enqueue_style( 'mainCss', $GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/css/layout/sitelook.css', false ); 
   wp_enqueue_script( 'script-name', 	$GLOBALS['themeCssPath'] . '/'. $GLOBALS['WP_ENV']  . '/js/alert.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'mlm_theme_css_scripts' );












