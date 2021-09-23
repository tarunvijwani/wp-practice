<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}

include( plugin_dir_path( __FILE__ )  . 'wp-post-master-functions.php' );

add_filter( 'excerpt_length' , 'wp_post_master_custom_excerpt_length' , 999 );
add_filter( 'excerpt_more' , 'wp_post_master_excerpt_more' );


add_action( 'wp_ajax_wp_post_master_term_content' , 'wp_post_master_term_content' );
add_action( 'wp_ajax_nopriv_wp_post_master_term_content' , 'wp_post_master_term_content' );
add_action( 'init' , 'wp_post_master_add_custom_shortcode' );
add_action( 'wp_enqueue_scripts' , 'wp_post_master_style' );
add_action( 'admin_enqueue_scripts' ,'admin_post_master_script' );
add_action( 'wp_enqueue_scripts' , 'wp_post_master_script' );
add_action( 'admin_menu' , 'wp_post_master_menu' );
add_action( 'admin_init' , 'wp_post_master_settings' );


register_deactivation_hook( __FILE__, 'remove_wp_post_master' );





 



