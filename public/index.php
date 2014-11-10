<?php 

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('ADMINTOOLBAR', ROOT . '\application\views\admin\admintoolbar.php');

require_once(ROOT . DS . 'library' . DS . 'db.php');
require_once(ROOT . DS . 'library' . DS . 'controller.php');
require_once(ROOT . DS . 'application'. DS . 'controllers' . DS . 'blocks.php');
require_once(ROOT . DS . 'library' . DS . 'model.php');
require_once(ROOT . DS . 'library' . DS . 'view.php');
require_once(ROOT . DS . 'library' . DS . 'init.php');




// Autoload any classes that are required
function __autoload($className) { 
    if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower(str_replace('Controller', '', $className)) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower(str_replace('Controller', '', $className)) . '.php');
    } else {
        /* Error Generation Code Here */
		echo 'Could not find ' . strtolower($className) . '.php';
    }
	
	if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
		echo 'Could not find ' . strtolower($className) . '.php';
    }
}

$init = new Init();