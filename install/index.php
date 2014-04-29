<?php
/**
*	jcbarreno.b@gmail.com
*
*/

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__DIR__));
define('PATH_INSTALL', dirname(__FILE__));
define('PATH_INSTALL_SRC', PATH_INSTALL.DS.'src');
define('PATH_INSTALL_MODELS', PATH_INSTALL_SRC.DS.'models'.DS);
define('PATH_CONFIG', PATH_ROOT.DS.'config');
define('PATH_TEMPLATES', PATH_INSTALL.DS.'templates');
define('PATH_VENDOR', PATH_ROOT.DS.'vendor');
require_once PATH_VENDOR.DS.'autoload.php';
require_once PATH_CONFIG.DS.'clib.php';

#modelos
require_once PATH_INSTALL_MODELS.'model.install.php';

$app = require PATH_INSTALL_SRC.DS.'bootstrap.php';
require PATH_INSTALL_SRC.'/controllers.php';
$app['debug'] = false;
$app->run();

