/**
 * Plugin Javascript Module
 *
 * Created     {date_time}
 *
 * @package    {plugin_name}
 * @author     {plugin_author}
 * @since      {build_version}
 */

"use strict";

/**
 * Module Design Pattern
 *
 * Note: This pattern requires your script to have a dependency on the "mwp" script
 * i.e. @Wordpress\Script( deps={"mwp"} )
 */
(function( $, undefined ) {
	
	/**
	 * Main Module
	 *
	 * The init() function is called after the page is fully loaded.
	 *
	 * Data passed into your script from the server side is available
	 * by the thisModule.local property inside your module:
	 *
	 * > var ajaxurl = thisModule.local.ajaxurl;
	 *
	 * The viewModel of your module will be bound to any HTML structure
	 * which uses the data-view-model attribute and names this module.
	 *
	 * Example:
	 *
	 * <div data-view-model="{plugin_slug}">
	 *   <span data-bind="text: title"></span>
	 * </div>
	 */
	var thisModule = mwp.module( '{plugin_slug}', 
	{
		
		/**
		 * Initialization function
		 *
		 * @return	void
		 */
		init: function()
		{
			// ajax actions can be made to the ajaxurl, which is automatically provided to your module
			var ajaxurl = thisModule.local.ajaxurl;
			
			// set the properties on your view model which can be observed by your html templates
			thisModule.viewModel = 
			{
				title: ko.observable( '{plugin_name}' )
			}
		}
	
	});
		
	
})( jQuery );
 