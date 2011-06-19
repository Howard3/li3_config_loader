# Introduction

The Lithium Config Loader allows you to load configuration files on the fly as classes are used.
The benefit of this is that you do not have to run all of your configurations in the bootstrap
and only apply them when it's relevant.

# Usage

To use the Lithium Config Loader follow these steps

_1. Check out this project to your application's `libraries` directory.
_2. In `app\config\bootstrap\libraries.php` add the library and configure as appropriate (more
below about configuring.) *before* the call to add the lithium library.

	Libraries::add('li3_config_loader', array(
		'classes' => array(
			'some\class\with\a\Config'
		)
	));

Modify your library loading for lithium so that it has the same key as the second parameter as
 shown below.

	Libraries::add('lithium', array(
		'loader' => 'li3_config_loader\loader\Loader::load'
	));

That's it. You'll want to configure the config loader appropriately so see more about that below.

# Configuring the Config Loader

The config loader accepts two primary keys, `filepath` and `classes`. `filepath` is the default
directory that the configuration files will exist, by default this is set to your application's
*config* directory.

`classes` is an array of classes which have configuration files unique to them. By default when a
 class exists here their namespace & class name are used for the filename, it is represented as an
 underlined version, and assumed as residing in the `filepath`'s directory. You can alternatively
  set a class to have a directory by setting it's namespace as the array key and defining (a
  relative to the `filepath` or absolute directory.)

# Usage Examples

Say we want to add a config file for the `lithium\security\Auth`, however we don't use the class
for every page, so it'd be a waste to load this file on every page load.

Add the class to the `classes` key in the library config.

	Libraries::add('li3_config_loader', array(
		'classes' => array(
			'lithium\security\Auth'
		)
	));

Create the relevant file (in this example `app\config\lithium_security_auth`).
Add your config to this file

	Auth::config(array(
		'user' => array(
			'adapter' => 'Form',
			'model' => 'Users',
			'fields' => array('username', 'password')
		)
	));
	//whatever else you want to do with auth as well.

Because of this setup the Auth class is never loaded into memory until it's needed.


