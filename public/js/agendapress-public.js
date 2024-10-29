(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $(window).on('load', function(){
	 	$('div[data-session-td]').each(function(){
	 		var style = $(this).data('session-td');
	 		$(this).parent().attr('style', style);
	 	})

		$('.agenda-en a[data-pop-id]').each(function(){
			var base = $(this);
			base.click(function(){
				var id = $(this).data('pop-id');
				$('body').append('<div class="agenda-pop"></div>');
				jQuery.post(_agenda.ajax_url, {'action': 'pop_action','id': id}, function(response) {
					$('.agenda-pop').append(response);
					$('.agenda-pop-close').click(function(){
						$('.agenda-pop').remove();
					})
				});
				return false;
			})
		});

	 })


})( jQuery );
