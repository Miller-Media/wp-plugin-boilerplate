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
	 * Test that the plugin is a modern wordpress plugin
	 */
	public function test_plugin_class() 
	{
		$plugin = \MillerMedia\Boilerplate\Plugin::instance();
		
		// Check that the plugin is a subclass of Modern\Wordpress\Plugin 
		$this->assertTrue( $plugin instanceof \Modern\Wordpress\Plugin );
	}
}
