<?php

/*
	
@package mlm
	
	========================
		look admin
	========================
*/


	 /* 2.0 - Customize Admin Panel
	 -------------------------------------------------------------- */
	 
	 function marioLafuente_custom_admin_Dash(){
		echo '
				<style type="text/css">
				#wp-admin-bar-wp-logo {
				display: none;
				}
				#menu-posts-vbsettings .wp-submenu-wrap { display: none; }
				#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
				width: 160px;
				background-color: #4d4d4d;

				#contextual-help-link-wrap {
				display: none!important;
				}

				#footer-upgrade {
				display: none;
				}
				}
				</style>
		';
}


function marioLafuente_my_custom_logo() {
echo '
	<style type="text/css">
	#header-logo { background-image: url('.get_stylesheet_directory_uri().'/assets/marioAdd-ons/logo.png) !important; }
	</style>
';
}

function marioLafuente_custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image: url('.get_stylesheet_directory_uri().'/assets/marioAdd-ons/logo.png) !important; }
	</style>';
}

function marioLafuente_my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' .get_stylesheet_directory_uri(). '/assets/marioAdd-ons/login.css" />';
}

// Admin footer modification
function marioLafuente_remove_footer_admin ()
{
echo '<span id="footer-thankyou">Developed by <a href="https://Mariolafuente.com" target="_blank">Mariolafuente </a></span>';
}

add_action( 'admin_head', 'marioLafuente_custom_admin_Dash' );
add_action('login_head', 'marioLafuente_my_custom_logo');
add_action('login_head', 'marioLafuente_my_custom_login');
add_action('login_head', 'marioLafuente_custom_login_logo');
add_filter('admin_footer_text', 'marioLafuente_remove_footer_admin');

