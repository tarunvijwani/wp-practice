<?php 

// If this file is called directly, abort.
if ( !defined( 'WPINC' )) {
   die;
}


function drum_kit_markup()
{
   
   $drumkit_sound_repo= 'https://github.com/tarunvijwani/wp-practice/blob/main/plugins/wp-js-drum-kit-sounds/';
   
   $drum_kit_markup='<div class="wp-js-drum-kit-wrapper">
                        <div class="wp-js-drum-kit-keys">
                           <div class="wp-js-drum-kit-single-key key-a">
                              <span class="wp-js-drum-kit-key-text">A</span>
                              <span class="wp-js-drum-kit-key-info">CLAP</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-s">
                              <span class="wp-js-drum-kit-key-text">S</span>
                              <span class="wp-js-drum-kit-key-info">HIHAT</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-d">
                              <span class="wp-js-drum-kit-key-text">D</span>
                              <span class="wp-js-drum-kit-key-info">KICK</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-f">
                              <span class="wp-js-drum-kit-key-text">F</span>
                              <span class="wp-js-drum-kit-key-info">OPENHAT</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-g">
                              <span class="wp-js-drum-kit-key-text">G</span>
                              <span class="wp-js-drum-kit-key-info">BOOM</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-h">
                              <span class="wp-js-drum-kit-key-text">H</span>
                              <span class="wp-js-drum-kit-key-info">RIDE</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-j">
                              <span class="wp-js-drum-kit-key-text">J</span>
                              <span class="wp-js-drum-kit-key-info">SNARE</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-k">
                              <span class="wp-js-drum-kit-key-text">K</span>
                              <span class="wp-js-drum-kit-key-info">TOM</span>
                           </div>
                           <div class="wp-js-drum-kit-single-key key-l">
                              <span class="wp-js-drum-kit-key-text">L</span>
                              <span class="wp-js-drum-kit-key-info">TINK</span>
                           </div>
                        </div>
                        <div class="wp-js-drum-kit-sound">
                           <audio class="key-a" src="'.$drumkit_sound_repo .'/sounds/clap.wav?raw=true"></audio>
                           <audio class="key-s" src="'.$drumkit_sound_repo  .'/sounds/hihat.wav?raw=true"></audio>
                           <audio class="key-d" src="'.$drumkit_sound_repo .'/sounds/kick.wav?raw=true"></audio>
                           <audio class="key-f" src="'.$drumkit_sound_repo .'/sounds/openhat.wav?raw=true"></audio>
                           <audio class="key-g" src="'.$drumkit_sound_repo  .'/sounds/boom.wav?raw=true"></audio>
                           <audio class="key-h" src="'.$drumkit_sound_repo .'/sounds/ride.wav?raw=true"></audio>
                           <audio class="key-j" src="'.$drumkit_sound_repo  .'/sounds/snare.wav?raw=true"></audio>
                           <audio class="key-k" src="'.$drumkit_sound_repo .'/sounds/tom.wav?raw=true"></audio>
                           <audio class="key-l" src="'.$drumkit_sound_repo .'/sounds/tink.wav?raw=true"></audio>
                        </div>
                     </div>';


return $drum_kit_markup;

}
?>
