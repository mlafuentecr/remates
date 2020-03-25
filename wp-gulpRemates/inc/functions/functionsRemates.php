<?php






// WordPress Admin Bar with Code
add_filter('show_admin_bar', '__return_false');



// Our custom post type function
function create_posttype() {

$args = array(
  'label'               => __( 'remates', 'remates' ),
  'description'         => __( 'remates Fields', 'remates' ),
  'labels' => array(
    'name' => __( 'Remates' ),
    'singular_name' => __( 'Remates' )
),
  // Features this CPT supports in Post Editor
  'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
  // You can associate this CPT with a taxonomy or custom taxonomy. 
  'taxonomies'          => array( 'Place', 'remate' ),
  /* A hierarchical CPT is like Pages and can have
  * Parent and child items. A non-hierarchical CPT
  * is like Posts.
  */ 
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 5,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'page',
);

   // Registering your Custom Post Type
   register_post_type( 'remates', $args );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


$handle = 'wpdocs';
wp_register_style( $handle, get_stylesheet_directory_uri().'/styleCustomFiled.css', array(), '', true );
if ( is_page_template( 'template-name.php' ) ) {
    wp_enqueue_style( $handle );
}




/*
	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
*/

function mlm_theme_css_scripts() {
	  wp_enqueue_style( 'style-new', 	get_stylesheet_directory_uri() . '/styleCustomFiled.css'); //newlook
    
}
add_action( 'wp_enqueue_scripts', 'mlm_theme_css_scripts' );


