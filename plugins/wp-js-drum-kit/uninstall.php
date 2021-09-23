<?php 
if ( !defined( 'WP_UNINSTALL_PLUGIN' )) {
    die;
}
 
remove_filter( 'the_content' , 'wp_js_drum_kit_content' );
remove_action( 'init' , 'wp_js_drum_kit_add_custom_shortcode' );
remove_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_style' );
remove_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_script' );


?>