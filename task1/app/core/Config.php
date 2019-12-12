<?php 

/*
 * class Config from which can get global variables.
 */
class Config {

	/*
	 * Static method to retrieve global configuration data based on given argument $path which separates array of array elements by "/" symbol.
	 */
	public static function get($path = null) {
		if($path) {
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach($path as $part) {
				if(isset($config[$part])) {
					$config = $config[$part];
				}
			}
			return $config;
		}
		return false;
	}
}