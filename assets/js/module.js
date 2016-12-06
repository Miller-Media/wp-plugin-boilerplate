/**
 * Plugin Javascript Module
 *
 * @package    {plugin_name}
 * @author     {plugin_author}
 * @since      {date_time}
 */

"use strict";

/**
 * Module Design Pattern
 */
(function( $, undefined ) {
	
	var thisModule = new function() {
		
		/**
		 * @var	Module Global "this"
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
		 * Named module variable
		 * 
		 * @var  
		 */
		$this.namedVar = null;
		
		
		/**
		 * Main Module Init (runs after page is loaded)
		 *
		 * @return	void
		 */
		$.extend( $this, {
		init: function()
		{
			// Now we can do stuff like attach our methods to the DOM
			$( document ).on( 'sasquatch.spotted', $this.doSomething );
		},
		
		/**
		 * Example module method
		 *
		 * @return void
		 */
		doSomething()
		{
			console.log( 'Hello Harry!' );
		}
		
		});
	};
	
	/* Initialize when document is ready */
	$( document ).ready( thisModule.init );
	
})( jQuery );
 