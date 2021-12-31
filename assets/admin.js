( function( $ ) {

	var info    = $( 'form#wptnb-trigger .notice-info' );
	var error   = $( 'form#wptnb-trigger .notice-error' );
	var success = $( 'form#wptnb-trigger .notice-success' );
	var spinner = $( 'form#wptnb-trigger .spinner' );
	var button  = $( 'form#wptnb-trigger input[type="submit"]' );
	var title   = $( 'form#wptnb-trigger #wptnb-trigger-title' );
	var nonce   = $( 'form#wptnb-trigger #wptnb_nonce' );

	$( 'form#wptnb-trigger' ).submit( function( event ) {
		event.preventDefault();

		info.show();
		spinner.show();
		error.hide();
		success.hide();

		button.attr( 'disabled', 'disabled' );

		$.post(
			ajaxurl,
			{
				action  : 'wptnb_trigger_build',
				title   : title.val(),
				security: nonce.val(),
			}
		)
			.done( function() {
				success.show();
			} )
			.fail( function() {
				error.show();
			} )
			.always( function() {
				info.hide();
				spinner.hide();
				button.removeAttr( 'disabled' );
			} );
	} );

} )( window.jQuery );
