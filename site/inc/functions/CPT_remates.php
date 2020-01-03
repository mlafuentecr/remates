<?php

/*

	========================
		Custom type
	========================
*/



add_action( 'init', 'init_custom_post_types' );
function init_custom_post_types( ) {

    $post_name = 'Remates_settings';
    $postTypeName = 'rematesettings';
    $pageId = $GLOBALS['rematesPg'];


   // Register CPTs

  $args = array(
 
		'description'           => __( 'Remates Settings', 'Remates-Settings' ),
		'labels'                => array(
		'name'                => __('Remates Settings'), //TItle of tab
		'singular_name'       => __('Remates-Settings')//Name for iternal
		),
   		/* 'supports'              => false,*/
		'supports'              => ('title'),
		/*'supports' => array( 'title', 'thumbnail'),*/
    	/*'supports' => array //( 'title', 'thumbnail'),*/
		/*'taxonomies'            => array( 'category', 'post_tag' ),*/
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-shield',
		'public'                => true,
		'show_in_admin_bar'     => flase,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
  register_post_type( $postTypeName , $args );
   flush_rewrite_rules();
   
   add_newpage($pageId, $post_name, $postTypeName );
}


// /*------------------------------------*\
// 	adding a page to the post type for settings
// \*------------------------------------*/

function add_newpage($pageId, $post_name, $postTypeName  ){

if (get_post_status($pageId)) {
   /* $post = array (
    'ID'                =>  $pageId ,
    'comment_status'    =>  'open',
    'post_content'      =>  'hi world!',
    'post_name'         =>  $post_name,
    'post_status'       =>  'private',
    'post_title'        =>  $post_name,
    'post_type'         =>  $postTypeName,
    );  
     echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx update';
     $post_id = wp_insert_post($post);*/
}
else {
    $post = array(
    'import_id'         =>  $pageId ,
    'comment_status'    =>  'open',
    'post_content'      =>  'hi world!',
    'post_name'         =>  $post_name,
    'post_status'       =>  'private',
    'post_title'        =>  $post_name,
    'post_type'         =>  $postTypeName,
    );  
   echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx insert post';
   $post_id = wp_insert_post($post);
 
}
 
  
}
 //add_action('init', 'add_newpage');


