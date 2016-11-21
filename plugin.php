<?php
/*
 * Plugin Name: Boilerplate Wordpress Plugin
 * Depends: lib-modern-wordpress
 * Description: A boiler-plate plugin skeleton based on the modern wordpress plugin framework
 * Version: 0.1
 * Author: Kevin Carwile (Miller Media)
 * Author URI: http://www.millermedia.io
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/* Load Only Once */
if ( ! class_exists( 'BoilerplatePlugin' ) )
{
	require_once 'vendor/autoload.php';

	class BoilerplatePlugin
	{
		public static function init()
		{
			/* Plugin Core */
			$plugin	= \MillerMedia\Boilerplate\Plugin::instance();
			$plugin->setPath( rtrim( plugin_dir_path( __FILE__ ), '/' ) );
			
			/* Plugin Settings */
			$settings = \MillerMedia\Boilerplate\Settings::instance();
			$plugin->addSettings( $settings );
			
			/* Connect annotated resources to wordpress core */
			$framework = \Modern\Wordpress\Framework::instance()
				->attach( $plugin )
				->attach( $settings );
			
			/* Enable Widgets */
			\MillerMedia\Boilerplate\BasicWidget::enableOn( $plugin );
		}
		
		public static function status() {
			if ( ! class_exists( 'ModernWordpressFramework' ) ) {
				echo '<td colspan="3" class="plugin-update colspanchange">
						<div class="update-message notice inline notice-error notice-alt">
							<p><strong style="color:red">INOPERABLE.</strong> Please activate the <strong>Modern Wordpress Plugin Framework</strong> to enable the operation of this plugin.</p>
						</div>
					  </td>';
			}
		}
	}
	
	add_action( 'after_plugin_row_' . plugin_basename( __FILE__ ), array( 'BoilerplatePlugin', 'status' ) );
	
	/**
	 * DO NOT REMOVE
	 *
	 * This plugin depends on the modern wordpress framework.
	 * This block ensures that it is loaded before we proceed.
	 */
	if ( class_exists( 'ModernWordpressFramework' ) ) {
		BoilerplatePlugin::init();
	}
	else {
		add_action( 'modern_wordpress_init', array( 'BoilerplatePlugin', 'init' ) );
	}
	
	
}

