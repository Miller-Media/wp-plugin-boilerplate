<?php

namespace MillerMedia\Boilerplate;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Widget Class
 *
 * @Wordpress\Widget
 * @Wordpress\WidgetSetting( name="title", title="Widget Title", type="text" )
 */
class BasicWidget extends \Modern\Wordpress\Plugin\Widget
{
 	/**
	 * @var	Plugin (Do Not Remove)
	 */
	protected static $plugin;
	
	/**
	 * Widget Name
	 *
	 * @var	string
	 */
	public $name = 'Boilerplate Widget';
	
	/**
	 * Widget Description
	 *
	 * @var	string
	 */
	public $description = 'A simple boilerplate wordpress widget';
	
	/**
	 * Widget Settings
	 *
	 * @var	array
	 */
	public $settings = array
	(
		'title' 	=> array( 'title' => 'Widget Title', 'type' => 'text', 'default' => 'Boilerplate Widget' ),
		'content' 	=> array( 'title' => 'Widget Content', 'type' => 'textarea' ),
	);

	/**
	 * HTML Wrapper Class
	 * 
	 * @var string
	 */
	public $classname = 'boilerplate-widget';
	
    /**
     * Output the widget content.
	 *
     * @param 	array 	$args     	Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
     * @param 	array 	$instance 	The settings for the particular instance of the widget.
     */
    public function widget( $args, $instance ) 
	{
        echo $this->getPlugin()->getTemplateContent( 'widget/layout/standard', array( 'args' => $args, 'widget_title' => $instance[ 'title' ], 'widget_content' => $instance[ 'content' ] ) );
    }
	
}