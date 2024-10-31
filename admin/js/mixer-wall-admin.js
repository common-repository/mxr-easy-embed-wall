(function($) {
  'use strict';
  /**
	 * All of the code for your admin-facing JavaScript source
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

  $(window).ready(function() {
    var i = 0;
    $('.mixer_settings_gct').each(function(){
        if ($(this).val() !== '') i++;
    });
    if (i > 1) {
        $('.mixer_settings_gct').each(function(){
            if ($(this).val() !== '') {
                $(this).parents('td').children('.error').addClass('show');
            }
        });
    }
      
    // $(document).on( 'click', '.premium-notice .notice-dismiss', function() {
    //     $.ajax({
    //         url: ajaxurl,
    //         data: {
    //             action: 'mixer_wall_dismiss_acf_notice'
    //         }
    //     });
    // });
  });
    
})(jQuery);