<?php
namespace App\Classes;

class Router
{
	/**
	 * @var array Routes list
	 */
	private $routes = [];

	/**
	 * @var string Current controller
	 */
	private $controller;

	/**
	 * @var string Method for current controller
	 */
	private $action;

	/**
	 * @var string Corresponding parameters for current route
	 */
	protected $args;

	/**
	 * Get routes array
	 *
	 * @return array
	 */
	private function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * Load routes file
	 */
	public function loadRoutes(string $file) : Router
	{
		$router = new self;
		require_once $file;
		return $router;
	}

	/**
	 * Set a new GET route
	 *
	 * @param string $route
	 * @param mixed $callback
	 * @return void
	 */
	public function get($route, $params)
	{
		$this->routes['GET'][$route] = $this->processRoute($route, $params);
	}

	/**
	 * Process a route to split it in controller, action and parameters
	 *
	 * @param string $route
	 * @param string $params
	 * @return array
	 */
	private function processRoute($route, $params)
	{
		[$controller, $method] = explode('@', $params);

		return [
			"controller" => $controller,
			"method" => $method
		];
	}

	/**
	 * Find out if the route has arguments to save
	 *
	 * @param string $fullRoute
	 * @return mixed
	 */
	private function findParams($fullRoute)
	{
		// Take route
		// replace {numeric} with [0-9]+ for regex
		// save value
		$params = [];
		die();
	}

	/**
	 * Search for a match in the $routes array
	 *
	 * @param string $uri Current URI
	 * @param string $requesType HTTP Method
	 * @return boolean
	 */
	private function match(string $uri, string $requestType) : bool
	{
		foreach ($this->routes[$requestType] as $route => $param)
		{
			if ($route === $uri)
			{
				$this->controller = $this->getNamespace() . $param["controller"];
				$this->action = $param["method"];
				return true;
			}
		}
		return false;
	}

	/**
	 * Call the corresponding controller method for the URI
	 *
	 * @param string $uri Current URI
	 * @param string $requesType HTTP Method
	 * @return void
	 */
	public function dispatch(string $uri, string $requestType) : void
	{
		if ($this->match($uri, $requestType)) {
			if (class_exists($this->controller)) {
				$controller_object = new $this->controller;
				$controller_action = $this->action;
				if (method_exists($controller_object, $controller_action)) {
					// Then we successfully call the controller method:
					$controller_object->$controller_action();
				} else
					throw new Exception("The method $this->action does not exist in the $this->controller controller");
			} else
				throw new Exception("Controller class $this->controller not found");
		}	else
			throw new Exception("No route matched", 404);
	}

	/**
	 * Get controller class namespace
	 *
	 * @return string
	 */
	private function getNamespace() : string
	{
		return 'App\Controllers\\';
	}
}