<?php

/*
 * Session class which stores and recieve values form session global variable.
 */
class Session {

/*
 * This method checks if session variable exists and then return boolean value (true or false).
 */
	public static function exists($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}

/*
 * Storing session data method which support key -> value pair as parameters $name and $value. After that it returns this value.
 */
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}

/*
 * Method which returns session value by supported key as $name parameter.
 */
	public static function get($name) {
		return $_SESSION[$name];
	}

/*
 * Method which delete session data from $name array key.
 */
	public static function delete($name) {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

/* 
 * Method which return "flash data" (a string value of $string parameter).
 * Note: This method is usefull to show notificaion once, and after page reload, it disappears.
 */
	public static function flash($name, $string = '') {
		if (self::exists($name)) {
			$session = self::get($name);
			self::delete($name);
			return $session;
		} else {
			self::put($name, $string);
		}
	}
}