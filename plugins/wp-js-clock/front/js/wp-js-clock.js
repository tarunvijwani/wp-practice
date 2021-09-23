function wpJsClockInit() {

  let currentTime = new Date();
  let currentMinutes = currentTime.getMinutes();
  let currentHours = currentTime.getHours();
  let currentSeconds = currentTime.getSeconds();

  let minuteHand = document.querySelector( '.minutes-hand' );
  let secondHand = document.querySelector( '.seconds-hand' );
  let hoursHand = document.querySelector( '.hours-hand' );
  let rotationDegrees = 0;
  rotationDegrees = ( currentSeconds / 60) * 360 + 90;
  secondHand.style.transform = `rotate(${rotationDegrees}deg)`;

  rotationDegrees =  ( currentMinutes / 60) * 360 + ( currentSeconds / 60) * 6 + 90;
  minuteHand.style.transform = `rotate(${ rotationDegrees }deg)`;
  rotationDegrees = ( currentHours / 12 ) * 360 + ( currentMinutes / 60) * 30 + 90;
  hoursHand.style.transform = `rotate(${ rotationDegrees }deg)`;

  if ( document.querySelector( '.wp-js-clock-wrapper' ).classList[ 1 ] == 'wp-js-clock-hidden' ) 
  {
    document.querySelector( '.wp-js-clock-wrapper' ).classList.remove( 'wp-js-clock-hidden' );
  }

}

setInterval( wpJsClockInit , 1000);
