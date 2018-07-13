jQuery( '.service-toggle' ).click( function() {
  var targetControl = jQuery( this ).attr( 'aria-controls' );
  jQuery( '.service-icon' + targetControl + '-icon .fas', this ).toggleClass( 'fa-angle-right' );
  jQuery( '.service-icon' + targetControl + '-icon .fas', this ).toggleClass( 'fa-angle-down' );
} );
