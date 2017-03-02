# Plugin Boilerplate
Welcome to the boilerplate plugin using Modern Wordpress. This boilerplate can be automatically downloaded and customized for your new project using the WP CLI. Visit the [Modern Wordpress project](https://github.com/Miller-Media/modern-wordpress) page for quick start instructions. 

* [Creating PHP Classes](#php-classes)
* [Using templates](#html-templating)
* [Using settings](#plugin-settings)
* [Using widgets](#widgets)
* [Using stylesheets and scripts](#stylesheets-and-scripts)
* [Using javascript modules](#javascript-module-programming)
* [Using active records](#database-records)
* [Using display tables](#active-record-display-tables)
* [Using the form helper](#form-helper)
* [Using task queues](#task-queues)
* [Unit testing your plugin](#testing-your-plugin)

# Rundown
* All of your plugin classes will be namespaced with your **\VendorName\PackageName** prefix.
* The modern wordpress framework can be accessed using `$mwp = \Modern\Wordpress\Framework::instance();`
* Wordpress annotated methods on objects will only be attached to wordpress core when you do this:<br> `$mwp->attach( $objectInstance );`

## PHP Classes
Plugin components should be logically separated into classes at some point. To add a new class to your plugin using the WP CLI, use the following command:

```
$ wp mwp add-class myplugin-slug ClassName
```

This will create a namespaced class in the form of `\VendorName\PackageName\ClassName` which is located in the `/classes/ClassName.php` file of your plugin.

### Create an instance:
```php
$shinyNewObject = new \VendorName\PackageName\ClassName();
```
### Hook it into wordpress core:
*Only needed if you have one or more @Wordpress annotations in the class*
```php
$framework = \Modern\Wordpress\Framework::instance();
$framework->attach( $shinyNewObject );
```

### Singletons
If you want to implement your class using the singleton design pattern in order to make sure that only one copy of your object is ever instantiated, simply extend the `\Modern\Wordpress\Pattern\Singleton` base class and define a `$_instance` property for your class.
```php
namespace VendorName\PackageName;

class MyClass extends \Modern\Wordpress\Pattern\Singleton
{
    /**
     * @var object	All singletons must define this property
     */
    protected static $_instance;
    
    /**
     * Initialize
     *
     * @return	void
     */
    protected function init()
    {
    	// initialization routine when the instance is first created
    }
}
```

Then to access your singleton instance from anywhere, use:
```php
$myObject = \VendorName\PackageName\MyClass::instance();
```

## HTML Templating
Business logic should remain completely separate from HTML templates to allow them to be easily overridden by themes, and for easier management. MWP templates are stored in the `/templates` subfolder of your plugin. They can be organized into additional subfolders within the templates directory to better delineate between them.

### Create a new template from WP CLI:

```
$ wp mwp add-template myplugin-slug views/template-name
```
This will create a new html template in the templates directory named `/templates/views/template-name.php`. You can easily grab its contents in your plugin using:


### Get your template content:

```php
$template_content = $this->getPlugin()->getTemplateContent( 'views/template-name' );
```
> Classes created using the `$ mwp add-class` command line are automatically bootstrapped with a getPlugin()
> method that will give you easy access to your plugin instance. If you are working from a class that is
> not bootstrapped with the getPlugin() method, you can access your plugin instance by calling:
> `$plugin = \VendorName\PackageName\Plugin::instance();`


### Pass variables to your template:

If you want to pass some variables to your template to use, this will make the $varname variable available inside your template:

```php
$value = "Hello Dollie.";
$template_content = $this->getPlugin()->getTemplateContent( 'views/template-name', array( 'varname' => $value ) );
```

### Overriding templates in themes
Templates from your plugin can be overridden in wordpress themes by placing a copy of the template file in the themes `/templates` subdirectory in a folder with the same name as your plugin slug. As an example, the template described above would be overriden by:<br> `/wp-content/themes/theme-name/myplugin-slug/views/template-name.php`  

## Plugin Settings
Your plugin includes a bootstrapped settings class that you can use to easily add a new settings to your plugin. It's located at `/classes/Settings.php`.

### Add a new setting:
*Here we are adding a setting named 'setting1' using [annotations](https://github.com/Miller-Media/modern-wordpress/wiki/@Annotations).*
```php
/**
 * ...
 * @Wordpress\Options\Field( name="setting1", type="text", title="Setting 1", default="Hello Dollie." )
 */
class Settings extends \Modern\Wordpress\Plugin\Settings
```

### Use the setting in your code:

```php
// assuming your object has a getPlugin() method

$setting_value = $this->getPlugin()->getSetting( 'setting1' );

if ( $setting_value == 'Hello Dollie.' ) {
    /* Manually save a new setting */
    $this->getPlugin()->setSetting( 'setting2', 'Hello Dandy.' );
    $this->getPlugin()->getSettings()->saveSettings();
}
```
## Widgets
Modern wordpress provides a bootstrap class that you can extend to add widgets to your plugin. To create a new widget, add a new class that extends `\Modern\Wordpress\Plugin\Widget`. Then enable it for your plugin.

```php
namespace VendorName\PackageName;

class WidgetClass extends \Modern\Wordpress\Plugin\Widget
{
 	// Required property
	protected static $plugin;
	
	// Widget name
	public $name = 'Hello Widget';
	
	// Widget description
	public $description = 'A widget to greet the world.';
	
	// Widget output
	public function widget( $args, $instance ) 
	{
		echo $this->getPlugin()->getTemplateContent( 'views/template-name' );
	}
}

```

Enable the widget for your plugin like this:

```php
$plugin = \VendorName\PackageName\Plugin::instance();
\VendorName\PackageName\WidgetClass::enableOn( $plugin );
```

## Stylesheets and Scripts

### Create a new stylesheet or script from WP CLI:
```
$ wp mwp add-js myplugin-slug script-name
$ wp mwp add-css myplugin-slug stylesheet-name
```

This will create a new stylesheet located at `/assets/css/stylesheet-name.css` and a new javascript module located at `/assets/js/script-name.js`.

### Reference the stylesheet/script in your plugin:
> [Documentation](https://github.com/Miller-Media/modern-wordpress/wiki/@Annotations)

```php
class ClassName
{
    /**
     * @Wordpress\Stylesheet
     */
     public $myStyle = 'assets/css/stylesheet-name.css';

    /**
     * @Wordpress\Script( deps={"mwp"} )
     */
     public $myScript = 'assets/js/script-name.js';
    
    /**
     * ...
     */
     public function someFunc()
     {
        // use the stylesheet on this page
        $this->getPlugin()->useStyle( $this->myStyle );

        // use the script on this page, pass it some local variables
        $this->getPlugin()->useScript( $this->myScript, array(
            'setting1' => $this->getPlugin()->getSetting( 'setting1' ),
        ) );
     }
}
```

## Javascript Module Programming

Javascript modules that you create using the WP CLI will be generated with scaffolding that allows convenient use of the MVVM design pattern to keep your module code conveniently decoupled from your HTML via view models and data bindings.

They key concept with MVVM is that the business logic in the javascript module should not be concerned with how the HTML (view) is constructed or implemented. It will simply conduct its business and populate its internal data into a ViewModel javascript object. Your HTML templates can then bind themselves to data in your view models as they see fit to display it however they like.

Here is an example of how that works:

```javascript
var mainController = mwp.controller( 'controller-name', 
{
    init: function()
    {
        mainController.viewModel = {
            setting1: ko.observable( mainController.local.setting1 ),
            sayHi: function() {
                mainController.viewModel.setting1( 'Hello World!' );
            }
        };
    }
});
```
**Brief explanation of what's going on here:**<br>
* `mwp.controller()` is registering the controller by the name of `controller-name` with modern wordpress.
* The `init()` function is always called on each controller automatically when the page has loaded.
* The `viewModel` property of the controller is what is exposed to your HTML for data bindings.
* The `ko.observable()` wrapper is what allows your HTML to automatically update when that value changes. **Note:** The `setting1` property of the view model is not an actual value, but a function that returns/sets a value.

### Binding your HTML to your ViewModel

```html
<div data-view-model="controller-name">
  <h1 data-bind="text: setting1"></h1>
  <button data-bind="click: sayHi">Say Hi!</button>
</div>
```

**Brief explanation:**<br>
* The `data-view-model` attribute links the html structure to the view model from your controller.
* The `data-bind` attribute on the H1 element will keep the text inside the element synchronized with the value contained in your setting1 observable value on your view model.
* The `data-bind` attribute on the button triggers the `sayHi` function on your view model when it is clicked.
* The `sayHi` function in your view model updates the value in the `setting1` observable, and your H1 element magically changes its text.
* There are lots of things you can do with data bindings in your HTML, including loops and more. Full documentation is available on the [KnockoutJS website](http://knockoutjs.com).

## Database Records

Modern Wordpress provides a bootstrap class which implements the Active Record design pattern and allows you to quickly model and manipulate your database rows as objects. 

### Create a database table and begin tracking it in your plugin

Use the WP CLI to add the table name (without the wp_ prefix) to your plugin meta data. By doing this, the current structure of your database table will be built into your plugin whenever you build it using: `$ wp mwp build-plugin ...` 

If you have multiple tables to track, include all their names separated by commas.
```
$ wp mwp update-meta myplugin-slug --tables="table1,table2"
```

### Create a new PHP class for your active record

```
$ wp mwp add-class myplugin-slug TableData
```

### Customize your PHP class according to the columns in your database

```php
/* classes/TableData.php */

namespace VendorName\PackageName;

class TableData extends \Modern\Wordpress\Pattern\ActiveRecord
{
	/**
	 * @var	array		Required for all active record classes
	 */
	protected static $multitons = array();

	/**
	 * @var	string		Table name
	 */
	public static $table = "table_name";
	
	/**
	 * @var	array		Table columns
	 */
	public static $columns = array(
		'id',
		'salutation',
		'name',
		'friends',
	);
	
	/**
	 * @var	string		Table primary key
	 */
	public static $key = 'id';
	
	/**
	 * @var	string		Table column prefix
	 */
	public static $prefix = '';

}
```

Now with your active record, you can query, create, update, and delete records from your database with ease.

```php

// Create a new record
$record = new \VendorName\PackageName\TableData;
$record->salutation = "Hello";
$record->name = "Dollie.";
$record->save();

$new_record_id = $record->id;

// Load a record
$some_id = 2;
try {
    $otherRecord = \VendorName\PackageName\TableData::load( $some_id );
    $otherRecord->salutation = "Hola";
    $otherRecord->name = "Amigo.";
    $otherRecord->save();
}
catch( \OutOfRangeException $e )
{
    // record does not exist...
}

// Load specific records
$records = \VendorName\PackageName\TableData::loadWhere( array( "name=%s", "Dollie." ) );
foreach( $records as $r ) {
    $r->friends = $r->friends + 1;
    $r->save();
}

// Count records
$total = \VendorName\PackageName\TableData::countWhere( array( "name=%s", "Dollie." ) );

// Delete a record
$record = \VendorName\PackageName\TableData::load( $new_record_id );
$record->delete();
```

## Active Record Display Tables
If you want to display a table in the WP Admin that the end user can use to view and manage the active records of a given type, then modern wordpress provides a convenient ActiveRecordTable helper for active records, and factory method that you can use to access it. Here is an example of how you can create a display table:

```php

use VendorName\PackageName\TableData; // The active record class

// Create an instance of the table helper
$table = TableData::createDisplayTable();

// Allow bulk actions to be applied to the records.
// In this example, the 'delete()' method will be called on each selected record
$table->bulkActions = array( 'delete' => 'Delete' );

// Specify the table columns that should be outputted to the table
$table->columns = array( 'name' => 'Persons Name', 'salutation' => 'Favorite Greeting', 'friends' => 'Number of friends' );

// Specify the amount of records to show per page
$table->perPage = 20;

// Specify the default sort options
$table->sortBy = "friends";
$table->sortOrder = "DESC";

// Specify output handlers to process the display output for specific columns.
// If no handler is specified for a column, its raw content will be outputted.
$table->handlers = array(
	'friends' => function( $record ) {
		if ( $record[ 'friends' ] == 0 ) {
			return "Oops, no friends yet!";
		}
		return $record[ 'friends' ];
	},
);

// Prepare the items in the table. Only display people with 0 or more friends.
$table->prepare_items( array( "friends >= %d", 0 ) );

// Output the table
$table->display();
```

## Form Helper
Modern wordpress can help you build and process the data from submitted forms. Behind the scenes, it uses the [Piklist framework](https://piklist.com/learn/section/fields/) to construct form fields. Therefore, the available fields and their configuration parameters are the same as what is documented on the Piklist website.

Here is an example of how to build and process the data using the modern wordpress form helper:
```php
/* somewhere in php user land... */
$plugin = \VendorName\PackageName\Plugin::instance();

// Create a form container
$form = $plugin->createForm( 'collect_email_address' );

// Add a text field
$form->addField( array(
	'type' => 'text',
	'field' => 'my_email_field',
	'label' => 'Enter your email address',
	'required' => true,
	'sanitize' => array(
		array( 'type' => 'text_field' ),
	),
	'validate' => array(
		array( 'type' => 'email' ),
	),
) );

// Check if form has a valid submission
if ( $form->isValidSubmission() )
{
	// Get values from form
	$values = $form->getValues();
	
	$email_address = $values[ 'my_email_field' ];
	
	// do something with $email_address...
	
	// Complete the form processing, allowing other hooks to participate
	$form->processComplete( function() {
		wp_redirect( home_url() );
	});
}

// The form has either not been submitted, or contains errors.
// Either way, its appropriate to render it
echo $form->render();
```

## Task Queues
You can leverage the task runner built into modern wordpress to run cron type tasks or run background processing tasks. To use the task runner:

```php
use \Modern\Wordpress\Task;

// Sample configuration for your task. The only required option is an 'action' hook
$config = array
(
	// Action Hook
	// (required) the action which will be fired when this task is ran
	// i.e. register your callback using @Wordpress\Action( for="my_task_action" )
	'action' => 'my_task_action',
	
	// Identification Tag
	// (optional) a tag which you can use to look up or delete this task later
	'tag' => 'identifier_tag',
	
	// Task Priority
	// (optional) a higher priority means it will be ran before lower priority tasks
	// defaults to 5 if not specified
	'priority' => 5,
	
	// Start Time
	// (optional) a timestamp that indicates a time that this task should wait to 
	// start next. It may not start exactly at this time, but it will not start any
	// earlier.
	'next_start' => time(),
);

// Data to be passed into your callback hook when the task is ran
$data = array( 'bottles_of_beer' => 99 );

// Setup the task runner
Task::queueTask( $config, $data );

/**
 * Count tasks from queue based on action and or tag
 *
 * @param	string		$action			Count all tasks with specific action|NULL to ignore
 * @param	string		$tag			Count all tasks with specific tag|NULL to ignore
 * @return	void
 */
$total = Task::countTasks( 'my_task_action', 'identifier_tag' );

/**
 * Delete tasks from queue based on action and or tag
 *
 * @param	string		$action			Delete all tasks with specific action
 * @param	string		$tag			Delete all tasks with specific tag
 * @return	void
 */
Task::deleteTasks( 'my_task_action', 'unwanted_task_id' );
```

When a task is ran, the action you specified in your task configuration is triggered via wordpress core. Therefore, any functions you have attached to it will be executed with the only parameter being the `$task` object.

```php
class MyClass
{
	/** 
	 * @Wordpress\Action( for="my_task_action" )
	 */
	public function myTaskRunner( $task )
	{
		$data = $task->data;
		
		// if we have no more
		if ( $data[ 'bottles_of_beer' ] <= 0 ) {
			return $task->complete();
		}
		
		$data[ 'bottles_of_beer' ] = $this->drinkSome( $data[ 'bottles_of_beer' ] );
		
		$task->data = $data;
		return;
	}
	
	public function drinkSome( $beer )
	{
		return $beer - 1;
	}

}
```

If you have multiple items to process in your task runner, such as the example above, only process one item at a time in your function. Then update the `$task->data` property with information about where you are at in your processing, and let the function return. If there is still time left in the request for your task runner to do more work, the action will be triggered again, and your function will be given back the current `$task` object to do more work.

This way, if the script processing time is approaching its timeout, the framework will be able to automatically save your task state and continue processing it at a later time.

If you want to tell the framework that your task is complete and allow it to be removed, simply do the following:

```php
return $task->complete();
```

If you want to postpone processing until a future date/time, or set up the next cycle for your task without telling the system to remove it, just set the `next_start` property on the task and return from the function. This will cause the framework to stop calling your task callback until the next start time is reached.

```php
// start back up in 24 hours
$task->next_start = time() + ( 60 * 60 * 24 );
return;
```

## Testing Your Plugin
You can write unit and functional tests for your plugin by following the example test case in the boilerplate located at `/tests/test-plugin.php`. Tests can all be added to the provided test class, or new test classes with individual test cases can be created and placed in the `/tests` subfolder of your plugin.

To run the tests, you will use the WP CLI and the testing framework. More information can be found at [http://wp-cli.org/docs/plugin-unit-tests/](http://wp-cli.org/docs/plugin-unit-tests/).

To set up the testing scaffolding, use:
```
$ wp scaffold plugin-tests myplugin-slug
$ cd $(wp plugin path myplugin-slug --dir)
$ bin/install-wp-tests.sh wordpress_test root '' localhost latest
```
* `wordpress_test` is the name of your test database (all data will be deleted!)
* `root` is the MySQL user name
* `''` is the MySQL user password
* `localhost` is the MySQL server host
* `latest` is the wordpress version

You must then install modern wordpress into the newly created testing wordpress environment:

```
$ wp plugin install https://github.com/Miller-Media/modern-wordpress/raw/master/builds/modern-framework-latest-stable.zip --activate --path="/tmp/wordpress"
```

After your testing environment has been set up, you simply need to run `phpunit` from the working directory of your plugin.

```
$ cd $(wp plugin path myplugin-slug --dir)
$ phpunit
```
