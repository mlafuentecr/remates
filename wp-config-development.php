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
define('DB_NAME',     'database_name_here');
define('DB_USER',     'username_here');
define('DB_PASSWORD', 'password_here');
define('DB_HOST',     'localhost');
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');

define('AUTH_KEY',         'ye8{>:Uqj+Zcm6}-|iz=hh3u*g(N!EOksFK(>!`fz0 dj-~5]|hcv6YhNQfZ*;7(');
define('SECURE_AUTH_KEY',  ';G febCFZyGU_q-> d*K;`5:c@Y@ On+D_*B@l|B^CS6b!:mmy,Tr$_,9sl3Ul*W');
define('LOGGED_IN_KEY',    '.56p&$++t;4V57]}9I0MOj3K-;z>9MPu<$mP`u-PiyvmTV3II.>t4W9s; H#{fTh');
define('NONCE_KEY',        'AhFAa1$JS8|>7%&[AlC)8z?tcC-rP(|Xs+&bkjVpZ%l<!-jg$P}@@+8,IT(z~g9U');
define('AUTH_SALT',        '+^,T`U}RTtZ)qaN-J.Dt3Q1Kl1/dHNsV2o}?8RTg%5|Qwwj:DmhM6#-/w<$AoV<y');
define('SECURE_AUTH_SALT', ';N!iQA },$basU?V&^DHr:jvWz1~Jd1zQ ZM6%1Uk?i+@6I,v|:H,wU+</92uCLB');
define('LOGGED_IN_SALT',   'wkx1WegH*gHQ-aP5?$&;zk6$GjA,qP^0hJ9-=,Q07^Qs,Ug^T!h@)hM339W[Z4:9');
define('NONCE_SALT',       '+R^=&>HB[-0Ge|ZpXq@H_%WRb9[7E=6)Ci0zP4Qg&/;?n|O*x5Tseg;yGp-V#J+4');


$table_prefix = 'wp_';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
