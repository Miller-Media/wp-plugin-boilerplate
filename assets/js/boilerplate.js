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
	var myPlugin = (function() {
		var self = this;
		
		/* Protect localized data */
		//self.data = plugin_localized_object;
		
		/**
		 * Plugin Class 
		 */
		$.extend( self, {
			
			/**
			 * Initialize
			 *
			 * @return	void
			 */
			init: function()
			{
				// Call internal class methods like so...
				self.doSomething();
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
	$( document ).ready( myPlugin.init );
	
})( jQuery );
 