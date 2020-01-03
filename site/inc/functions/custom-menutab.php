
<?php
add_action( 'admin_menu', 'add_admin_pages' );

function add_admin_pages() {
   
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'custom menu',
        'manage_options',
        'custompage', /*'myplugin/myplugin-admin.php',*/
        'my_custom_menu_page',
        'dashicons-shield',
        6
    );
    
  
}

//call some elements from espsific page
function my_custom_menu_page(){

    echo '<div id="themefusion_news" class="postbox "> <div class="inside">';
    esc_html_e( 'Admin Page Test', 'textdomain' );  
    $id = 3333; // add the ID of the page where the zero is
    $p = get_page($id);
    $t = $p->post_title;
    the_field('logo',$p);
    echo '<h3>'.apply_filters('post_title', $t).'</h3>'; // the title is here wrapped with h3
    echo apply_filters('the_content', $p->post_content);
    echo "</div></div>";

    ?>
    
    <?php
}
