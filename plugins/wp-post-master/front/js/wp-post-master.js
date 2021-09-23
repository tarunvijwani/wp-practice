(function ( $ ) {

  $(document).ready(function () {

    let response_markup = '';
    let termID = '';
    let loadedTerm = [ 'latest-post' ];
    $( '.wp-post-master-content-loading' ).hide();
    $( '.wp-post-master-wrapper.latest-posts' ).addClass( 'active' );

    $( '.wp-post-master-tab' ).click(function () {

      $( '.wp-post-master-tab' ).removeClass( 'active' );
      $(this).addClass( 'active' );
      termID = $(this)[0].classList[2].split( 'term-id-' );

      if (!termID[1]) {
        termID[1] = 'latest-post';
      }

      if ( loadedTerm.includes( termID[ 1 ] ) ) {

        $( '.wp-post-master-wrapper' ).removeClass( 'active' );
        $( '.' + $( this )[ 0 ].classList[ 2 ] ).addClass( 'active' );
        return;

      }

      get_term_posts( termID[ 1 ] );
      loadedTerm.push( termID[1] );
      $( '.wp-post-master-wrapper' ).removeClass( 'active' );
      $( '.' + $( this )[ 0 ].classList[ 2 ]).addClass( 'active' );

    });

    function get_term_posts(termID ) {

      $( '.wp-post-master-content-loading' ).show();
      
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: wp_post_master_globals.ajax_url,
        data: {
          action: 'wp_post_master_term_content',
          _ajax_nonce: wp_post_master_globals.nonce,
          term_id: termID,
        },
        success: function (response) {
          if ( 'success' == response.type ) {

            response_markup = response.content_markup;
            className = '.wp-post-master-wrapper' + '.term-id-' + termID;

            $( '.wp-post-master-tabs' ).after( response_markup );
            $( className ).addClass( 'active' );

            $( '.wp-post-master-content-loading' ).hide();

          } else {

            response_markup = 'Error!';
            
          }
        },
      });
    }
  });

})( jQuery );
