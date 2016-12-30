<?php
/**
 * Plugin Class File
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
 * Plugin Class
 */
class Plugin extends \Modern\Wordpress\Plugin
{
	/**
	 * Instance Cache - Required
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string		Plugin Name
	 */
	public $name = '{plugin_name}';
	
	/**
	 * Main Stylesheet
	 *
	 * @Wordpress\Stylesheet
	 */
	public $mainStyle = 'assets/css/style.css';
	
	/**
	 * Main Javascript Module
	 *
	 * @Wordpress\Script( deps={"mwp"} )
	 */
	public $mainScript = 'assets/js/module.js';
	
	/**
	 * @Wordpress\Action( for="init" )
	 */
	public function pluginInit()
	{
		$this->useStyle( $this->mainStyle );
		$this->useScript( $this->mainScript );
	}
	
}