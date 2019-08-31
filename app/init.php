<?php
// Autoload classes
spl_autoload_register(function ($className) {
  $className = str_replace("\\", "/", $className);
  require_once $_SERVER['DOCUMENT_ROOT'] . "/php-mvc/$className.php";
});

// Load helper functions
require_once dirname(__DIR__) . '/App/Functions/helpers.php';

// Create router instance
$router = new App\Classes\Router;