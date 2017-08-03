<?php
/**
 * Settings Class File
 *
 * @vendor: {vendor_name}
 * @package: {plugin_name}
 * @author: {plugin_author}
 * @link: {plugin_author_url}
 * @since: {date_time}
 */
namespace MillerMedia\Boilerplate;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Plugin Settings
 *
 * @Wordpress\Options
 * @Wordpress\Options\Section( title="General Settings" )
 * @Wordpress\Options\Field( name="setting1", type="text", title="Setting 1" )
 * @Wordpress\Options\Field( name="setting2", type="select", title="Setting 2", options={ "opt1":"Option1", "opt2": "Option2" } )
 * @Wordpress\Options\Field( name="setting3", type="select", title="Setting 3", options="optionsCallback" )
 */
class Settings extends \Modern\Wordpress\Plugin\Settings
{
	/**
	 * Instance Cache - Required for singleton
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string	Settings Access Key ( default: main )
	 */
	public $key = 'main';
	
	/**
	 * @var 	\Modern\Wordpress\Plugin		Provides access to the plugin instance
	 */
	protected $plugin;
	
	/**
 	 * Get plugin
	 *
	 * @return	\Modern\Wordpress\Plugin
	 */
	public function getPlugin()
	{
		return $this->plugin;
	}
	
	/**
	 * Set plugin
	 *
	 * @return	this			Chainable
	 */
	public function setPlugin( \Modern\Wordpress\Plugin $plugin=NULL )
	{
		$this->plugin = $plugin;
		return \$this;
	}
	
	/**
	 * Constructor
	 *
	 * @param	\Modern\Wordpress\Plugin	\$plugin			The plugin to associate this class with, or NULL to auto-associate
	 * @return	void
	 */
	public function __construct( \Modern\Wordpress\Plugin $plugin=NULL )
	{
		$this->setPlugin( $plugin ?: \MillerMedia\Boilerplate\Plugin::instance() );
	}
}
	
	/**
	 * Example Options Generator
	 * @see: class annotation for setting3
	 *
	 * @param		mixed			$currentValue				Current settings value
	 * @return		array
	 */ 
	public function optionsCallback( $currentValue )
	{
		return array
		(
			'opt3' => 'Option 3',
			'opt4' => 'Option 4',
		);
	}
		
}