<?php
/**
 * Basic functions for the app that should be available globally
 */

 /**
  * Get the current URI
  *
  * @return string
  */
function getURI() : string
{
    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode('/', $uri);
    array_shift($uri);
    array_shift($uri);
    $uri = '/' . implode('/', $uri);
    return $uri;
}

/**
 * Get the HTTP method for the current URI
 *
 * @return string
 */
function getRequestMethod() : string
{
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Display a view
 *
 * @param string $file Name of the file to search for
 * @param array $data  Optional variables that may be passed or not
 * @return void
 */
function view(string $file, $data = [])
{
    if (file_exists(dirname(dirname(__DIR__)) . "/resources/views/$file.php"))
        require_once dirname(dirname(__DIR__)) . "/resources/views/$file.php";
    else
        die("This page does not exist");
}