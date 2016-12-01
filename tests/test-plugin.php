<?php
/**
 * Testing Class
 *
 * To set up testing for your wordpress plugin:
 *
 * @see: http://wp-cli.org/docs/plugin-unit-tests/
 *
 * @package {plugin_name}
 */
if ( ! class_exists( 'WP_UnitTestCase' ) )
{
	die( 'Access denied.' );
}

/**
 * Example plugin tests
 */
class BoilerplatePluginTest extends WP_UnitTestCase 
{
	/**
	 * Load Modern Wordpress Framework
	 */
	public function __construct()
	{
		if ( ! file_exists( WP_PLUGIN_DIR . '/modern-wordpress/framework.php' ) )
		{
			die( 'Error: You must first install the Modern Wordpress Framework plugin to your test suite to run tests on this plugin.' );
		}
		
		require_once WP_PLUGIN_DIR . '/modern-wordpress/framework.php';
	}

	/**
	 * Test that the plugin is a modern wordpress plugin
	 */
	public function test_plugin_class() 
	{
		$plugin = \MillerMedia\Boilerplate\Plugin::instance();
		
		// Check that the plugin is a subclass of Modern\Wordpress\Plugin 
		$this->assertTrue( $plugin instanceof \Modern\Wordpress\Plugin );
	}
}
