/**
 * @package 	Boilerplate Wordpress Plugin
 * @author 		Kevin Carwile (Miller Media)
 * @since		Nov 2016
 */

use "strict";

/**
 * Module Design Pattern
 */
(function( $, undefined ) {
	var myModule = (function() {
		
		/**
		 * @var	this
		 */
		var $this = this;
		
		/**
		 * Data passed by backend
		 *
		 * @var object/array	
		 * .ajaxurl [WP Ajax Endpoint]
		 */
		$this.local = mw_localized_data;
		
		/**
		 * Module Methods 
		 */
		$.extend( $this, {
			
			init: function()
			{
				// Kick off page processing...
				$this.doSomething();
			},
			
			/**
			 * Example method
			 *
			 * @return void
			 */
			doSomething()
			{

			}
		
		});
	})();
	
	/* Initialize when document is ready */
	$( document ).ready( myModule.init );
	
})( jQuery );
 