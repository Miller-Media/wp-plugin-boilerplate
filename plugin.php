<?php
/*
 * Plugin Name: Boilerplate Wordpress Plugin
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
	require_once __DIR__ . '/vendor/autoload.php';

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
			
			/* Connect plugin modules to Modern Wordpress Framework */
			$framework = \Modern\Wordpress\Framework::instance()
				->attach( $plugin )
				->attach( $settings );
			
			/* Enable Widgets */
			\MillerMedia\Boilerplate\BasicWidget::enableOn( $plugin );
		}
	}
	
	BoilerplatePlugin::init();
}

