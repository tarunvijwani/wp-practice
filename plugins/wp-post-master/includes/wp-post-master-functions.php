<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
    die;
}

include( plugin_dir_path( __FILE__ )  . 'wp-post-master-markup.php' );

function wp_post_master_style()
{
    wp_enqueue_style( 'wp-post-master-style' , plugin_dir_url( __DIR__  ) . 'front/css/style.css' );
}

function admin_post_master_script()
{

    wp_enqueue_script( 'admin-post-master-script' , plugin_dir_url( __DIR__  ) . 'admin/js/wp-post-master-admin.js' , ['jquery'] );
    wp_enqueue_style( 'admin-post-master-style' , plugin_dir_url( __DIR__  ) . 'admin/css/style.css' );

}
function wp_post_master_script()
{
    $nonce = wp_create_nonce( 'wp-post-master_nonce' );

    wp_enqueue_script( 'wp-post-master-script' , plugin_dir_url( __DIR__  ) . 'front/js/wp-post-master.js' , ['jquery'] );

    wp_localize_script(
        'wp-post-master-script',
        'wp_post_master_globals',
        [
          'ajax_url'    => admin_url( 'admin-ajax.php' ) ,
          'content_markup' => '',
          'term_id' => null,
          'nonce'       => $nonce,
        ]
      );

}

function wp_post_master_add_custom_shortcode() 
{
    if( !shortcode_exists( 'wp-post-master' ))
    {
        add_shortcode( 'wp-post-master' , 'wp_post_master_content_shortcode' );

    }
}

function wp_post_master_content_shortcode()
{
    return  wp_post_master_term_markup() . wp_post_master_markup() ;
}

function wp_post_master_term_content() {

    check_ajax_referer( 'wp-post-master_nonce' );
    $response['content_markup'] = wp_post_master_markup( $_POST['term_id'] );
    $response['type'] = 'success';
    $response = json_encode( $response );
    echo $response;
    die();
  
}

function wp_post_master_menu()
{

    add_menu_page(
        'WP Post Master',
          'WP Post Master',
          'manage_options',
          'wppostmaster',
          'wp_post_master_admin_page',
          'dashicons-grid-view',
      );

}

function wp_post_master_admin_page(){
    if( !current_user_can( 'manage_options' ))
    {
        return;
    }
    ?>
    <div class="wrap wp-post-master-admin">
        <h1><?php esc_html_e( get_admin_page_title() ) ;?></h1>
        <form method="POST" action="options.php">
            <?php
            settings_fields ( 'wp_post_master_settings' );
            do_settings_sections( 'wppostmaster' );
            submit_button();

            ?>
        </form>
    </div>
<?php
}

function wp_post_master_settings(){

  if( false == get_option( 'wp_post_master_settings' ) ) {
      add_option( 'wp_post_master_settings' );
  }

  add_settings_section(
      'wp_post_master_settings_section' ,
      __( 'WP Post Master Options' ),
      'wp_post_master_settings_section_callback',
      'wppostmaster',
  );

  add_settings_field(
    'wp_post_master_settings_field_display_count',
    __( 'Display number of posts' , 'wpplugin' ),
    'wp_post_master_settings_display_count',
    'wppostmaster',
    'wp_post_master_settings_section',
  );

  add_settings_field(
    'wp_post_master_settings_field_number_of_items',
    __( 'Number of categories/tags:' ),
    'wp_post_master_settings_number_of_items',
    'wppostmaster',
    'wp_post_master_settings_section',
  );

    
  add_settings_field(
    'wp_post_master_settings_field_item_to_display',
    __( 'Select item to display:' ),
    'wp_post_master_settings_item_to_display',
    'wppostmaster',
    'wp_post_master_settings_section',
  );

  add_settings_field(
    'wp_post_master_settings_field_display_excerpts',
    __( 'Display excerpts:' ),
    'wp_post_master_settings_display_excerpts',
    'wppostmaster',
    'wp_post_master_settings_section',
  );

  register_setting(
    'wp_post_master_settings',
    'wp_post_master_settings'
  );

}
  
function wp_post_master_settings_section_callback(){
    esc_html_e( 'Change the settings for the WP post master plugin:' );
}
  
function wp_post_master_settings_number_of_items(){

  $options = get_option( 'wp_post_master_settings' );
  $select = 5;

  if( isset( $options['number_of_items'] )) {
      $select = esc_html( $options['number_of_items'] );
  }

  $html = '<select id="wp_post_master_settings_number_of_items" name="wp_post_master_settings[number_of_items]">';

  for( $i = 0; $i < 11; $i++ )
  {
    $html .= '<option value="' . $i . '"' . selected( $select , $i , false ) . '>' . $i . '</option>';
  }

  $html .= '</select>';
  echo $html;

}

function wp_post_master_settings_item_to_display(){
  
  $options = get_option( 'wp_post_master_settings' );
  $select = '';

  if( isset( $options[ 'item_to_display' ] )) {
      $select = esc_html( $options['item_to_display'] );
  }

  $html = '<select id="wp_post_master_settings_item_to_display" name="wp_post_master_settings[item_to_display]">';
  $html .= '<option value="category" ' . selected( $select , "category", false ) . '>Categories</option>';
  $html .= '<option value="post_tag" ' . selected( $select , "post_tag" , false ) . '>Tags</option>';
  $html .= '</select>';
  echo $html;

}

function wp_post_master_settings_display_count( ) {

  $options = get_option( 'wp_post_master_settings' );
  $checkbox = '';

  if( isset( $options[ 'display_count' ] )) {
      $checkbox = esc_html( $options['display_count'] );
  }

  $html = '<input type="checkbox" id="wp_post_master_settings_display_count" name="wp_post_master_settings[display_count]" value="true"' . checked( "true" , $checkbox , false ) . '/>';
  echo $html;

}

function wp_post_master_settings_display_excerpts( ) {

  $options = get_option( 'wp_post_master_settings' );
  $checkbox = '';

    if( isset( $options['display_excerpts'] )) {
        $checkbox = esc_html( $options['display_excerpts'] );
    }

    $html = '<input type="checkbox" id="wp_post_master_settings_display_excerpts" name="wp_post_master_settings[display_excerpts]" value="true"' . checked( "true" , $checkbox , false ) . '/>';
    echo $html;

}

function wp_post_master_excerpt_more( $more ) {
    return ' <a href="' . get_the_permalink() . '" rel="nofollow">Read More...</a>';
}

function wp_post_master_custom_excerpt_length( $length ) {
    return 40;
}



 


function remove_wp_post_master(){
  
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
  
}
