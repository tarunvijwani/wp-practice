<?php
/*
Plugin Name: WP JS Drum Kit
Plugin URI: https://WordPress.org/tarunvijwani
Description: This plugin is to implement the Javascript 30 drum kit module
Version: 1.0.0
Contributors: tarunvijwani
Author: Tarun Vijwani
Author URI: https://tarunvijwani.wordpress.com
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-js-drum-kit
Domain Path:  /languages
*/

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}


include( plugin_dir_path(__FILE__) . 'includes/wp_js_drum_kit_functions.php' );
