<?php
/**
 * Plugin HTML Template
 *
 * Created:  {date_time}
 *
 * @package  {plugin_name}
 * @author   {plugin_author}
 * @since    {build_version}
 *
 * @example:
 * $content = $plugin->getTemplateContent( 'snippet', array( 'title' => 'Some Custom Title', 'content' => 'Some custom content' ) );
 *
 * @param	string		$title		The provided title
 * @param	string		$content	The provided content
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

?>

<!-- html content -->
<h2><?php echo $title ?></h2>
<div>
	<?php echo $content ?>
</div>