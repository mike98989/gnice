<?php
// if($_SERVER['HTTPS']!='on') {
// $redirect= 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// header('Location:'.$redirect);
// }
//! require_once "./bootstrap.php";
require_once './app/Config/Config.php';

require_once "./app/helpers/functions.php";
//require_once "./app/helpers/errors.php";

//load autoload
// require_once('../vendor/autoload.php');
/**
 * Error reporting
 */
error_reporting(E_ALL);
//set_error_handler('errorHandler');
//set_exception_handler('exceptionHandler');


/**
 * for autoload to work in libraries the class name needs to match the file name -- exactly ie Controller - Controller
 */
// Autoload Core
spl_autoload_register(function ($className) {
    require_once './app/Core/' . $className . '.php';
});
// Init Core
$init = new Core();