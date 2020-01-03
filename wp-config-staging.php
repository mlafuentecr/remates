<?php
/**
 * The base configuration for WordPress
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


// Prevent file from being accessed directly
if (!defined('ABSPATH')) exit();


// /*------------------------------------*\
// DB INFO
// \*------------------------------------*/
define('DB_NAME', 		'remates_sitecr_com');
define('DB_USER', 		'rematessitecrcom');
define('DB_PASSWORD', 	'vKjbfR*g');
define('DB_HOST', 		'mysql.remates.sitecr.com');
define('DB_CHARSET', 	'utf8');
define('DB_COLLATE', 	'');

define('AUTH_KEY',         'tNt#eYYC!IO_91(Ye?tU%/*ijL(Kb!Fv2y37#DrY^5QF3p`1Gjd3Lf3+J!*dcZ:~');
define('SECURE_AUTH_KEY',  'c$"/jU($CTC"dVSb7MRB2YA7mWTXV~0+LSw`Pg3W$3AzPImlX~q9i`E%0jIPzl0#');
define('LOGGED_IN_KEY',    '5K74b0$WcQ5yv1V;pEo~I8x3V@"#%y~+fp|o)E8#$?~Ir13c5KUu2~#7J~bLeyXG');
define('NONCE_KEY',        'tCnlrALzBux3KIfp"_#C"DZ96heopPwXs5|lZ+e)ok7Kj@Q"A7Z)3f+7nmop?c`A');
define('AUTH_SALT',        'r&?T?fFpb&99NB)iNpMS7S#eW!TP#xmQ%6r;wM4%|x$_jxuhqUf%)hU)P+n:;|MZ');
define('SECURE_AUTH_SALT', 'H3xX7#EdyR28Z6tlrHN5ewbK8cRSCDl~2vEZ6XJkr&7@eqb|NR_*ZucDr2!R_u?N');
define('LOGGED_IN_SALT',   'C0C@@gh&B;"m7+EsI3I^)ocw*!dZ(#RhvCYbgeVuVn%UX`iLPR)p@|/O~m!ZyamC');
define('NONCE_SALT',       'aw9wS/4*UnSc_|*h|4k?iqMPxnKm(a@I0@V+/j*|d~LlkZFN;XPRuQ9ri7QiiSuU');


$table_prefix  = 'wp_9nevfc_';
define('WP_POST_REVISIONS',  10);







// // Enable WP_DEBUG mode
// define( 'WP_DEBUG', true );
// // Enable Debug logging to the /wp-content/debug.log file
// define( 'WP_DEBUG_LOG', true );
// // Disable display of errors and warnings
// define( 'WP_DEBUG_DISPLAY',  true );

// // Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
// define( 'SCRIPT_DEBUG', true );




/**
 * Removing this could cause issues with your experience in the DreamHost panel
 */

if (preg_match("/^(.*)\.dream\.website$/", $_SERVER['HTTP_HOST'])) {
	$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
	define('WP_SITEURL', $proto . '://' . $_SERVER['HTTP_HOST']);
	define('WP_HOME',    $proto . '://' . $_SERVER['HTTP_HOST']);
}



if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
