<?php
/**
 * The base configuration for WordPress
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


// /*------------------------------------*\
// 	environment
// \*------------------------------------*/

$local          = 'local.remates.sitecr.com';
$development    = 'development.website.com';
$staging        = 'www.remates.sitecr.com';
$production     = 'website.com';

$environments = array(
  'local'       => $local,
  'development' => $development,
  'staging'     => $staging,
  'production'  => $production
);

// Get the hostname
$http_host = $_SERVER['HTTP_HOST'];
//echo $http_host;


// Loop through $environments to see if there’s a match
foreach($environments as $environment => $hostname) {
  if (stripos($http_host, $hostname) !== FALSE) {
    define('ENVIRONMENT', $environment);
    break;
  }
}




// $http = 'http:\/\/';
if(ENVIRONMENT === 'local' ){
  // define( 'WP_HOME', 'http:'.$local );
  // define( 'WP_SITEURL', 'http:'.$local );
  define('WP_ENV',      'src'); //this will make search for assets in src folder
}elseif (ENVIRONMENT === 'development') {
  // define( 'WP_HOME',    $development );
  // define( 'WP_SITEURL', $development );
  define('WP_ENV', 'src');
}elseif (ENVIRONMENT === 'staging') {
  // define( 'WP_HOME',    $staging );
  // define( 'WP_SITEURL', $staging );
  define('WP_ENV', 'src'); //this will make search for assets in dist folder
}else{
  // define( 'WP_HOME',    $production );
  // define( 'WP_SITEURL', $production );
  define('WP_ENV', 'dist'); //this will make search for assets in dist folder
}

//echo WP_ENV; 


// Location of environment-specific configuration
$wp_db_config = 'wp-config-' . ENVIRONMENT . '.php'; 

// Check to see if the configuration file for the environment exists
if (file_exists(__DIR__ . '/' . $wp_db_config)) {
  require_once($wp_db_config);
} else {
  // Exit if configuration file does not exist
  exit('No database or enviroment is not define here wp-config.php = '.$wp_db_config);
}

// /*------------------------------------*\
// 	environment finish
// \*------------------------------------*/


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
