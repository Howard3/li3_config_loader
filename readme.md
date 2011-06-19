# Introduction

The Lithium Config Loader allows you to load configuration files on the fly as classes are used.
The benefit of this is that you do not have to run all of your configurations in the bootstrap
and only apply them when it's relevant.

# Usage

To use the Lithium Config Loader follow these steps

1. Check out this project to your application's `libraries` directory.
2. In `app\config\bootstrap\libraries.php` add the library and configure as appropriate (more
below about configuring.) *before* the call to add the lithium library.
	Libraries::add('li3_config_loader', array(
		'classes' => array(
			'some\class\with\a\Config'
		)
	));
3. Modify your library loading for lithium so that it has the same key as the second parameter as
 shown below.
	Libraries::add('lithium', array(
		'loader' => 'li3_config_loader\loader\Loader::load'
	));

That's it. You'll want to configure the config loader appropriately so see more about that below.

# Configuring the config loader

The config loader accepts two primary keys, `filepath` and `classes`. `filepath` is the default
directory that the configuration files will exist, by default this is set to your application's
*config* directory.

`classes` is an array of classes which have configuration files unique to them. By default when a
 class exists here their namespace & class name are used for the filename and assumed as residing
  in the `filepath`'s directory. You can alternatively set a class to have a directory by setting
   it's namespace as the array key and defining (a relative to the `filepath` or absolute
   directory.)