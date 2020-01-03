<?php

// /*------------------------------------*\
// 	defines
// \*------------------------------------*/
$GLOBALS['rematesPg'] 		= 3331; //id from page settings
$GLOBALS['themePath'] 		= get_theme_file_path();
$GLOBALS['themeCssPath'] 	= get_stylesheet_directory_uri();
$GLOBALS['WP_ENV'] 	        = WP_ENV;
// /*------------------------------------*\
// 	Functions
// \*------------------------------------*/


add_filter('show_admin_bar', '__return_false');
require  $GLOBALS['themePath'].'/inc/functions/cleanup.php';
require  $GLOBALS['themePath'].'/inc/functions/admin_look.php';
require  $GLOBALS['themePath'].'/inc/functions/element-support.php';
require  $GLOBALS['themePath'].'/inc/functions/acfToJson.php';
require  $GLOBALS['themePath'].'/inc/functions/widgets.php';
require  $GLOBALS['themePath'].'/inc/functions/enqueue.php';
require  $GLOBALS['themePath'].'/inc/functions/boostrap.php';
require  $GLOBALS['themePath'].'/inc/functions/menuNav.php';
require  $GLOBALS['themePath'].'/inc/functions/CPT_remates.php';
//require  $GLOBALS['themePath'].'/inc/functions/acfForm.php';

require  $GLOBALS['themePath'].'/inc/functions/dashboad-menu.php';
// require  $GLOBALS['themePath'].'/inc/functions/custom-post-type.php';
//require  $GLOBALS['themePath'].'/inc/functions/custom-menutab.php';




function wpse_enqueue_datepicker($post) {
   global $post;
   if($post->ID === 5813){
   // Load the datepicker script (pre-registered in WordPress).
   wp_enqueue_script( 'jquery-ui-datepicker' );

   // You need styling for the datepicker. For simplicity I've linked to the jQuery UI CSS on a CDN.
   wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
   wp_enqueue_style( 'jquery-ui' );  
   }
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );







//crea la acciones para meter post nuevos
add_action('template_redirect', function() {
   global $post;
   $postType = $post->post_type;

    //var_dump($postType);

    if($postType === 'rematesettings'){
      require  $GLOBALS['themePath'].'/inc/functions/CPT_Field_remates.php';
    }
    
 
 });
 



