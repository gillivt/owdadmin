<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
    //define('SITE_ROOT', DS.'home'.DS.'www'.DS.'theploughonthegreen.co.uk');
    define ('SITE_ROOT', 'c:'.DS.'wamp'.DS.'www'.DS.'owdmobileappforinstructors');
defined('WEB_ROOT') ? null : define('WEB_ROOT', '');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'database');

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'class.session.php');
require_once(LIB_PATH.DS.'httpful.phar');
//require_once(LIB_PATH.DS.'class.pagination.php');

?>