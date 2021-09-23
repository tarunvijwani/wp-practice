<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}

include( plugin_dir_path(__FILE__) . 'drum-kit-markup.php' );

function wp_js_drum_kit_style()
{
    wp_enqueue_style( 'main-drum-kit-style' , plugin_dir_url( __DIR__  ). 'front/css/style.css' );
}

function wp_js_drum_kit_script()
{
    wp_enqueue_script( 'main-drum-kit-script' , plugin_dir_url( __DIR__  ) . 'front/js/wp_js_drum_kit_js.js' );
}

function wp_js_drum_kit_add_custom_shortcode() {

    if( !shortcode_exists('wp-drum-kit') )
    {
        add_shortcode( 'wp-drum-kit' , 'wp_js_drum_kit_content_shortcode' );
    }
}

function wp_js_drum_kit_content_shortcode(){

    static $wp_js_drum_kit_run_counter = 0;
    
    if( $wp_js_drum_kit_run_counter > 0 ){
        return;
    }

    $drum_kit_markup = drum_kit_markup();
    $wp_js_drum_kit_run_counter++;
    
    return wp_kses_post( $drum_kit_markup );

}

function wp_js_drum_kit_content( $content )
{
    if ( strpos( $content , '[wp-drum-kit]' ) !== false ) {
        return $content;
    }
   
    if( is_page() )
    {

        $title = 'JavaScript Drum Kit';
        $page_title = esc_html( get_the_title() );
        
        
        if( $title == $page_title )
        {
            $drum_kit_markup= drum_kit_markup();
            $content.= wp_kses_post( $drum_kit_markup );    
        }
    }
    return $content;

}

function remove_drum_kit_plugin(){
    remove_filter( 'the_content' , 'wp_js_drum_kit_content' );
    remove_action( 'init' , 'wp_js_drum_kit_add_custom_shortcode' );
    remove_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_style' );
    remove_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_script' );
}

add_action( 'init' , 'wp_js_drum_kit_add_custom_shortcode' );
add_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_style' );
add_action( 'wp_enqueue_scripts' , 'wp_js_drum_kit_script' );
add_filter( 'the_content' , 'wp_js_drum_kit_content' );

register_deactivation_hook( __FILE__, 'remove_drum_kit_plugin' );




