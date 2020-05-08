<?php

// FRONT CONTROLLER


// General configs, error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Session
session_start();

// Connect system files
define("ROOT", dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

// Call Router
$router = new Router();
$router->run();
