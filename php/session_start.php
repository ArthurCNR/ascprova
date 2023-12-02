<?php
/**
 * session_start.php - Starts the session and sets constants
 *
 * @author Bert Hekman <bert@condor.tv>
 * @copyright Copyright &copy; 2007, Condor Digital
 */

// Version information
define("TITLE", "MyKart");
define("SUBTITLE", "Karting");
define("VERSION", "1");

define("PAGE_DEFAULT", "main");
define("PAGE_ERROR", "error");

// Comment these if you do not need them:
define("USE_MYSQL", 1);
define("USE_LOGIN", 1);
#define("USER_MUST_LOGIN", 1);

// Include classes
if(defined("USE_LOGIN")) {
    require_once("classes/authguard.php");
}

// Start session
session_name("MyKart");
session_cache_limiter("private, must-revalidate");
session_start();

$config_file = __DIR__.'/config.php';

// Include main configuration and functions
if(!is_file($config_file)) {
	die("MyKart is not configured. Please create a config.php or copy config.php.dist to config.php for the default options\n");
}
require_once("config.php");
require_once("functions.php");
