<?php

/*
	
@package sunsettheme
	
	========================
		Custom type
	========================
*/

add_action( 'init', 'init_custom_post_types' );
function init_custom_post_types() {

   // Register CPTs

  $args = array(
 
		'description'           => __( 'VietBet Settings', 'VietBet-Settings' ),
		'labels'                => array(
		'name'                => __('Vietbet Settings'), //TItle of tab
		'singular_name'       => __('VietBet-Settings')//Name for iternal
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
  register_post_type( 'vbSettings', $args );
  flush_rewrite_rules();

  //remove li where add new is
  //echo '<style>.wp-submenu-wrap { display: none; }</style>';
}


// /*------------------------------------*\
// 	adding a page to the New post type
// \*------------------------------------*/

function add_newpage(){
    $pageName = 'VB_Settings';
    $pageId = $GLOBALS['vbSettings'];
//Update
if (get_post_status($pageId) ) {
    /*$post = array //(
    'ID'                =>  $pageId,
    'comment_status'    =>  'open',
    'post_content'      =>  'hi world!',
    'post_name'         =>  'VB_Settings',
    'post_status'       =>  'private',
    'post_title'        =>  $pageName,
    'post_type'         =>  'vbSettings',
    );  
     echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx update';
     $post_id = wp_insert_post($post);*/
}
//if not in database, add post with id 3333
else {
    $post = array(
    'import_id'         =>  $pageId,
    'comment_status'    =>  'open',
    'post_content'      =>  'hi world!',
    'post_name'         =>  'VB_Settings',
    'post_status'       =>  'private',
    'post_title'        =>  $pageName,
    'post_type'         =>  'vbSettings',
    );  
   //echo 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx insert post';
    $post_id = wp_insert_post($post);
    //register_post_type( 'vbSettings', $args );
}
 
  
}
  //add_action('init', 'add_newpage');


