<?php
// Init app
require_once dirname(__DIR__) . '/App/init.php';
//echo "<a href='controller/action/123'> Link </a>";
$router->loadRoutes(dirname(__DIR__) . '/App/Config/routes.php')->dispatch(getURI(), getRequestMethod());