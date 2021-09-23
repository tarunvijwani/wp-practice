<?php 
if ( !defined( 'WP_UNINSTALL_PLUGIN' )) {
    die;
}
 
$option_name = 'wp_post_master_settings';
 
delete_option( $option_name );
 
remove_filter( 'excerpt_length' , 'wp_post_master_custom_excerpt_length' , 999 );
remove_filter( 'excerpt_more' , 'wp_post_master_excerpt_more' );
remove_action( 'wp_ajax_wp_post_master_term_content' , 'wp_post_master_term_content' );
remove_action( 'wp_ajax_nopriv_wp_post_master_term_content' , 'wp_post_master_term_content' );
remove_action( 'init' , 'wp_post_master_add_custom_shortcode' );
remove_action( 'wp_enqueue_scripts' , 'wp_post_master_style' );
remove_action( 'admin_enqueue_scripts' ,'admin_post_master_script' );
remove_action( 'wp_enqueue_scripts' , 'wp_post_master_script' );
remove_action( 'admin_menu' , 'wp_post_master_menu' );
remove_action( 'admin_init' , 'wp_post_master_settings' );
 

?>