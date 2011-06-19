<?php
use lithium\core\Libraries;
use li3_config_loader\loader\Loader;

require dirname(__DIR__) . '/loader/Loader.php';
Loader::config(Libraries::get('li3_config_loader'));

?>