acceptedKeys = [
  'a',
  's',
  'd',
  'f',
  'g',
  'h',
  'j',
  'k',
  'l',
];

window.addEventListener( 'keydown' , drumkitPlaySound) ;

function drumkitPlaySound( e ) {
  if ( !acceptedKeys.includes( e.key.toLowerCase() ) ) {
    return;
  } else {

    elementClass = '.key-' + e.key.toLowerCase();
    audioClass = 'key-' + e.key.toLowerCase();
    targetElement = document.querySelector( elementClass );
    targetElement.addEventListener( 'transitionend' , drumkitRemoveTransition );
    targetElement.classList.add( 'wp-js-drum-kit-key-animation' );
    const audio = document.querySelector( `audio[class='${ audioClass }']` );
    audio.currentTime = 0;
    audio.play();

  }
}

function drumkitRemoveTransition( e ) {

  e.target.removeEventListener( 'transitionend' , drumkitRemoveTransition );
  e.target.classList.remove( 'wp-js-drum-kit-key-animation' );
  
}
