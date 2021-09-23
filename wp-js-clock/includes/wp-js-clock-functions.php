<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}

include( plugin_dir_path( __FILE__ ) . 'wp-js-clock-markup.php' );

function wp_js_clock_style()
{
    wp_enqueue_style( 'main-js-clock-style' , plugin_dir_url( __DIR__  ) . 'front/css/style.css' );
}

function wp_js_clock_script()
{
    wp_enqueue_script( 'main-js-clock-script' , plugin_dir_url( __DIR__  ) . 'front/js/wp-js-clock.js' );
}

function wp_js_clock_add_custom_shortcode() {
    if( !shortcode_exists( 'wp-js-clock' ) )
    {
        add_shortcode( 'wp-js-clock' , 'wp_js_clock_content_shortcode' );

    }
}

function wp_js_clock_content_shortcode(){

    static $wp_js_clock_run_counter = 0;
    
    if( $wp_js_clock_run_counter > 0 ){
        return;
    }

    $wp_js_clock_markup = wp_js_clock_markup();
    $wp_js_clock_run_counter++;
    echo $wp_js_clock_markup ;
    return wp_kses_post( $wp_js_clock_markup );

}

function wp_js_clock_content( $content )
{
    if ( strpos( $content , '[wp-js-clock]' ) !== false ) {
        return $content;
    }
   
    if( is_page())
    {
        $title = 'JS and CSS Clock';
        $page_title = esc_html( get_the_title() );
        
        
        if( $title == $page_title )
        {

            $wp_js_clock_markup= wp_js_clock_markup();
            $content.= wp_kses_post( $wp_js_clock_markup );
            
        }
    }
    return $content;

}

function remove_wp_js_clock(){

    remove_action( 'init', 'wp_js_clock_add_custom_shortcode' );
    remove_action( 'wp_enqueue_scripts' , 'wp_js_clock_style' );
    remove_action( 'wp_enqueue_scripts' , 'wp_js_clock_script' );
    remove_filter( 'the_content', 'wp_js_clock_content');
    
}

add_action( 'init', 'wp_js_clock_add_custom_shortcode' );
add_action( 'wp_enqueue_scripts' , 'wp_js_clock_style' );
add_action( 'wp_enqueue_scripts' , 'wp_js_clock_script' );
add_filter( 'the_content', 'wp_js_clock_content');

 
register_deactivation_hook( __FILE__, 'remove_wp_js_clock' );





