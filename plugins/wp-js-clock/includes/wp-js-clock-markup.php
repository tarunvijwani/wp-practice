<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
   die;
}


function wp_js_clock_markup()
{
   

   $wp_js_clock_markup='<div class="wp-js-clock-wrapper wp-js-clock-hidden">
                              <div class="wp-js-clock-body">
                                 <div class="clock-hand seconds-hand"></div>
                                 <div class="clock-hand minutes-hand"></div>
                                 <div class="clock-hand hours-hand"></div>
                                 <div class="clock-center"></div>
                              </div>
                        </div>';


   return $wp_js_clock_markup;

}
?>
