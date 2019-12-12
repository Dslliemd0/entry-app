<?php

/*
 * Class for input interactions from forms.
 */
class Input {

/*
 * Check if user submits any data into a form.
 */
	public static function exists($type = 'post') {
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
			break;
			case 'get':
				return (!empty($_GET)) ? true : false;
			break;
			default:
				return false;
			break;
		}
	}

/*
 * Method which return data from inputted form based on supported key name $item.
 */
	public static function get($item) {
		if (isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}
}