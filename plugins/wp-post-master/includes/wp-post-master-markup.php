<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
   die;
}
function wp_post_master_term_markup()
{

   $taxonomy = 'category';
   $number_of_items = 5;
   $display_count = false;

   if ( get_option( 'wp_post_master_settings' )) {

      $options = get_option( 'wp_post_master_settings' );
      $taxonomy = $options['item_to_display'];
      $number_of_items = $options['number_of_items'];
      $display_count = $options['display_count'];

   }
   
   $wp_post_master_term_markup = '';

   $categories = get_terms( $taxonomy, array(
      'orderby'    => 'count',
      'order' => 'DESC',
      'hide_empty' => true,
      'number' => $number_of_items,
   ));
   
   $wp_post_master_term_markup .= '<ul class="wp-post-master-tabs">';
   $wp_post_master_term_markup .= '<li class="wp-post-master-term active wp-post-master-tab latest-posts">Latest Posts</li>';
        
   foreach ( $categories as $term ) {

      $count = '';

      if($display_count)
      {
         $count = '&nbsp;(' . $term->count . ')';
      }

         $wp_post_master_term_markup .= '<li class="wp-post-master-term wp-post-master-tab term-id-' . $term->term_id . '">'. $term->name . $count .'</li>';
      
   }
   
   $wp_post_master_term_markup .= '</ul>';
   $wp_post_master_term_markup .= '<div class="wp-post-master-content-loading"><div class="wp-post-master-content-loader"></div></div>';
  
    wp_reset_postdata();
   return $wp_post_master_term_markup;

}

function wp_post_master_markup( $catgeory_id = null )
{

   $wp_post_master_markup = '';
  
   if( $catgeory_id != null && $catgeory_id != 'latest-posts' )
   { 
      $taxonomy = 'cat';

      if( get_option( 'wp_post_master_settings' )) {

         $options = get_option( 'wp_post_master_settings' );
         $taxonomy = ( $options['item_to_display'] == 'post_tag' ) ? 'tag_id' : 'cat';
      
      }
      $args=array(
      'posts_per_page' => 5,
      $taxonomy => $catgeory_id,
      );

      $wrapper_class = 'term-id-' . $catgeory_id;

   }
   else{

      $args=array(
         'posts_per_page' => 10,
         );
         $wrapper_class = 'latest-posts' ;

   }

  
   $wp_post_master_markup .= '<div class="wp-post-master-wrapper ' . $wrapper_class . '">';
      
   $get_post_master_query = new WP_Query( $args );
   
   if ( $get_post_master_query -> have_posts() ) {
      
      while ( $get_post_master_query->have_posts() ) {
         
         $get_post_master_query -> the_post();
         
         $wp_post_master_markup .= '<div class="wp-post-master-single-post" >';
         

         $wp_post_master_markup .= '<a class="wp-post-master-thumbnail-link" href="' . get_permalink() . '" ><div class="wp-post-master-thumbnail" style="background-image:url(' . get_the_post_thumbnail_url() . ')" ></div></a>';
         $wp_post_master_markup .= '<div class="wp-post-master-details" >';
         $wp_post_master_markup .= '<a class="wp-post-master-post-title-link" href="' . get_permalink() . '" ><div class="wp-post-master-post-title"><h2>' . get_the_title() . '</h2></div></a>';
         if( get_option( 'wp_post_master_settings' )) {

            $options = get_option( 'wp_post_master_settings' );

            if( $options['display_excerpts'] )
            {

               $wp_post_master_markup .= '<div class="wp-post-master-excerpt" >' . substr( get_the_excerpt() , 0 , 700 ) . '</div>';

            }
            
         }

         $wp_post_master_markup .= '</div>';  
         $wp_post_master_markup .= '</div>';  

         
         
      }

      $wp_post_master_markup .= '</div>';
         
   } else {
         
   }
        
   wp_reset_postdata();
   return $wp_post_master_markup;
}

?>
