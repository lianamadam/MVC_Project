<?php 

namespace application\core;

class Router {

	protected $routes = [];
	protected $params = [];
	
	function __construct()
	{
		$arr = require 'application/config/routes.php';
		print_r($arr);
		foreach ($arr as $key => $val) {
			$this->add($key, $val);
		}
	}

	public function add($route, $params)
	{
		$route = '#^' . $route . '#';

		$this->routes[$route] = $params;
	}

	public function match()
	{
		$url = trim($_SERVER['REQUEST_URI'], '/');
		foreach ($this->routes as $route => $params) {
			if(preg_match($route, $url, $matches)) {
				$this->params = $params;
				return true;
			}
		}

		return false;
	}

	public function run()
	{
		if($this->match()) {
			$controller = 'application\\controllers\\' . ucfirst($this->params['controller'] . '.php');
			
			if(class_exists($controller)) {
				echo "string";
			}

			else {
				echo " ";
			}
		}

		else {
			echo "Не найден";
		}
	}

}

session_start();

$router = new Router();

 ?>