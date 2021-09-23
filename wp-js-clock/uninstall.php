<?php 
if ( !defined( 'WP_UNINSTALL_PLUGIN' )) {
    die;
}
 

remove_action( 'init', 'wp_js_clock_add_custom_shortcode' );
remove_action( 'wp_enqueue_scripts' , 'wp_js_clock_style' );
remove_action( 'wp_enqueue_scripts' , 'wp_js_clock_script' );
remove_filter( 'the_content', 'wp_js_clock_content');
?>