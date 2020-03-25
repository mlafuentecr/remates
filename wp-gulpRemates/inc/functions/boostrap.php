<?php
/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts() {
    // load bootstrap css
    wp_enqueue_style( 'wp-bootstrap-css', get_template_directory_uri() . '/src/css/layout/bootstrap.css' );
    wp_enqueue_style( 'wp-fontawesome-cdn', get_template_directory_uri() . '/src/css/layout/fontawesome.min.css' );
	// load bootstrap css



	wp_enqueue_script('jquery');

    // load bootstrap js
    wp_enqueue_script('wp-bootstrap-jquery', get_template_directory_uri() . '/src/js/jquery-3.3.1.slim.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-popper', get_template_directory_uri() . '/src/js/popper.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-bootstrap', get_template_directory_uri() . '/src/js/bootstrap.min.js', array(), '', true );
 
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_scripts' );



/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/functions/wp_bootstrap_navwalker.php');
}

?>