<?php

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
	 * @var string
	 */
	public $name = 'Boilerplate Plugin';
	
	/**
	 * Instance Cache - Required for singleton
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * Class Properties
	 *
	 * Post Type: array			[@]Wordpress\PostType( name="posttype" )
	 */
	public $property;
	
	/**
	 * Class Methods
	 * 
	 * Action Callback: 		[@]Wordpress\Action( for="action_name", priority=int, args=int )
	 * Filter Callback: 		[@]Wordpress\Filter( for="filter_name" )
	 * Shortcode Callback:		[@]Wordpress\Shortcode( name="short_code" )
	 */
	public function callback() 
	{
		
	}
}