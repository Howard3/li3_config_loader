<?php
use lithium\core\Libraries;
use config_loader\loader\Loader;

require dirname(__DIR__) . '/loader/Loader.php';
Loader::config(Libraries::get('config_loader'));

?>