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
	 * Instance Cache - Required
	 * @var	self
	 */
	protected static $_instance;
	
	/**
	 * @var string		Plugin Name
	 */
	public $name = 'Boilerplate Plugin';
	
	/**
	 * Plugin Properties
	 *
	 * Post Type: array			[@]Wordpress\PostType( name="posttype" )
	 * Javascript File:			[@]Wordpress\Script()
	 * Stylesheet:				[@]Wordpress\Style()
	 */
	public $property;
	
	/**
	 * Plugin Methods
	 * 
	 * Action Callback: 		[@]Wordpress\Action( for="action_name", priority=int, args=int )
	 * Filter Callback: 		[@]Wordpress\Filter( for="filter_name" )
	 * Shortcode Callback:		[@]Wordpress\Shortcode( name="short_code" )
	 * Ajax Handler:			[@]Wordpress\AjaxHandler()
	 */
	public function callback() 
	{
		
	}
}