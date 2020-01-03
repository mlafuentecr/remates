<?php

/*
	
@package mlm
	
	========================
		REMOVE GENERATOR VERSION NUMBER
	========================
*/


	 // Removes the wlwmanifest link
	 remove_action( 'wp_head', 'wlwmanifest_link' );
	 // Removes the RSD link
	 remove_action( 'wp_head', 'rsd_link' );
	 // Removes the WP shortlink
	 remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	 // Removes the canonical links
	 remove_action( 'wp_head', 'rel_canonical' );
	 // Removes the links to the extra feeds such as category feeds
	 remove_action( 'wp_head', 'feed_links_extra', 3 );
	 // Removes links to the general feeds: Post and Comment Feed
	 remove_action( 'wp_head', 'feed_links', 2 );
	 // Removes the index link
	 remove_action( 'wp_head', 'index_rel_link' );
	 // Removes the prev link
	 remove_action( 'wp_head', 'parent_post_rel_link' );
	 // Removes the start link
	 remove_action( 'wp_head', 'start_post_rel_link' );
	 // Removes the relational links for the posts adjacent to the current post
	 remove_action( 'wp_head', 'adjacent_posts_rel_link' );
	 remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	 // Removes the WordPress version i.e. -
	 remove_action( 'wp_head', 'wp_generator' );

	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 remove_action( 'admin_print_styles', 'print_emoji_styles' );

	//Add Filters
	add_filter('the_generator', 'mlm_remove_version');
	add_filter( 'revslider_meta_generator', 'remove_revslider_meta_tag' );
	add_action( 'admin_init', 'remove_dashboard_meta' );
	add_filter( 'emoji_svg_url', '__return_false' );

/* REMOVE STUFF meta_box */

function remove_dashboard_meta() {

	//Completely remove various dashboard widgets (remember they can also be HIDDEN from admin)
	remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      //Recent Drafts
	remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
	remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      //Other WordPress News
	remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    //Incoming Links
	remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    
	remove_meta_box( 'dashboard_activity',       'dashboard', 'normal' );   
	remove_meta_box( 'dashboard_right_now',       'dashboard', 'normal' );    
	remove_action('welcome_panel', 'wp_welcome_panel');    
}


	function mlm_remove_version() {
	return '';
	}
	function remove_revslider_meta_tag() {
	return '';
	}


	//remove
add_filter('wp_footer', 'remove_unwanted_css');
add_action('get_header', 'remove_admin_login_header');
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action('wp_head', 'rest_output_link_wp_head', 10);


  /* 0.6  Deregister CSS file
    -------------------------------------------------------------- */
    function remove_unwanted_css(){
			wp_deregister_style('dashicons-css');
			wp_dequeue_style('thickbox-css');
			wp_dequeue_style('contact-form-7-css');
	}


	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}


  /* wp-embed It relates specifically to embeding WordPress posts from other people's blogs/websites. Embedding WordPress posts inside WordPress posts: so meta! This feature was introduced in WordPress 4.4.
    -------------------------------------------------------------- */
	function my_deregister_scripts(){
		wp_deregister_script( 'wp-embed' );
	}
	add_action( 'wp_footer', 'my_deregister_scripts' );