<?php

namespace config_loader\loader;

use lithium\core\Libraries;
use lithium\util\Inflector;
use lithium\core\ConfigException;

class Loader {
	protected static $_config = array();

	public static function config(array $config) {
		$config += array(
			'filepath' => LITHIUM_APP_PATH . '/config',
			'classes' => array()
		);
		$configs = array();
		foreach ($config['classes'] as $key => $configItem) {
			if (is_numeric($key)) {
				$configs[$configItem] = '';
				continue;
			}
			$configs[$key] = $configItem;
		}
		$config['classes'] = $configs;
		static::$_config = $config;
	}

	public static function load($class, $require = false) {;
		$config = &static::$_config;
		if (isset($config['classes'][$class])) {
			$path = $config['classes'][$class] ?: Inflector::underscore($class) . '.php';
			$path = preg_match('/^\w:|^\//', $path) ? $path : $config['filepath'] . '/' . $path;
			if (!(include $path)) {
				throw new ConfigException("Could not load config file at `{$path}` for `{$class}`");
			}
		}
		Libraries::load($class, $require);
	}
}