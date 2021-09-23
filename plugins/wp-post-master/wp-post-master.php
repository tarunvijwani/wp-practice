<?php
/*
Plugin Name: WP Post Master
Plugin URI: https://WordPress.org/tarunvijwani
Description: Display posts in grid format.
Version: 1.0.0
Contributors: tarunvijwani
Author: Tarun Vijwani
Author URI: https://WordPress.org/tarunvijwani
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-post-master
Domain Path:  /languages
*/

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}


include( plugin_dir_path(__FILE__) . 'includes/wp-post-master-hooks.php' );
