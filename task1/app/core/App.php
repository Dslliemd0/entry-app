<?php

/*
 * Class App wich get relative URL (manually inputted or invoked) and change it to find controller, invoke this controller method and pass parameters based on this URL.
 */
class App {

/*
 * Set default values if not recieve a relative url. These default values are controller's name, controller's method and parameters of this method (an array).
 */
	protected $controller = 'entry', $method = 'signinorup', $params = array();

/*
 * Invoke a class constructor. Then recieve array which generated on parseUrl() method. Then check the array data of existing files (controller files), if file match then set this controller instance. After that check (if controller was found) it checks given array next element match of existing previous invoked controller's method. If these checks are true then invoke this controller's method with parameters in next element of given array (if any) else invoke method without parameters.
 */
	public function __construct() {
		$url = $this->parseUrl();

		if (file_exists('../app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller;

		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : array();

		call_user_func_array([$this->controller, $this->method], $this->params);

	}

/*
 * This method recieve relative URL and set these values on array separated by "/" symbol.
 */
	private function parseUrl() {
		if (isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

}