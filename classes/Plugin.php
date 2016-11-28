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
	 * Main Stylesheet
	 *
	 * @Wordpress\Style
	 */
	public $mainStyle = 'assets/css/style.css';
	
	/**
	 * Main Javascript Module
	 *
	 * @Wordpress\Script
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