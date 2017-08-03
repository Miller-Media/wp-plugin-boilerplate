<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

include_once 'class-tgm-plugin-activation.php';

/* Register dependencies for this plugin */
add_action( 'tgmpa_register', function() 
{
	$base_dir = dirname( dirname( __FILE__ ) );
	$dependencies = array(
		/* This is an example of how to include a plugin dependency. See: http://tgmpluginactivation.com/configuration/#h-plugin-parameters
		array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => false,
		),
		*/
	);
	
	if ( file_exists( $base_dir . '/data/plugin-dependencies.php' ) )
	{
		$plugin_dependencies = json_decode( include $base_dir . '/data/plugin-dependencies.php', TRUE );
		$dependencies = array_merge( $dependencies, $plugin_dependencies );
	}
	
	$plugin_name = 'An active plugin';
	if ( file_exists( $base_dir . '/data/plugin-meta.php' ) )
	{
		$plugin_meta = json_decode( include $base_dir . '/data/plugin-meta.php', TRUE );
		$plugin_name = $plugin_meta[ 'name' ];
	}
	
	$config = array(
		'id'           => basename( $base_dir ),
		'default_path' => $base_dir . '/bundles',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'plugins.php',
		'capability'   => 'manage_options',
		'has_notices'  => true,
		'dismissable'  => false,
		'is_automatic' => true,
		'strings'      => array(
			'notice_can_install_required'     => _n_noop(
				'<em>' . $plugin_name . '</em> requires the following plugin: %1$s.',
				'<em>' . $plugin_name . '</em> requires the following plugins: %1$s.',
				basename( $base_dir )
			),
			'notice_can_install_recommended'  => _n_noop(
				'<em>' . $plugin_name . '</em> recommends the following plugin: %1$s.',
				'<em>' . $plugin_name . '</em> recommends the following plugins: %1$s.',
				basename( $base_dir )
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with <em>' . $plugin_name . '</em>: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with <em>' . $plugin_name . '</em>: %1$s.',
				basename( $base_dir )
			),
		),
	);
	
	/* Register dependencies */
	tgmpa( $dependencies, $config );
});
