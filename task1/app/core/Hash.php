<?php

/*
 * Class which hashes random strings for paswords to save into database and password match check.
 */
class Hash {
	
/*
 * Method which generates hash password by supported password $string and random symbol genarated $salt (by default empty line).
 */
	public static function make($string, $salt = '') {
		$options = array(
			'salt' => $salt
		);
		return password_hash($string, PASSWORD_BCRYPT, $options);
	}

/*
 * Method wich return random symbol line (known as salt).
 */
	public static function salt($lenght) {
		return random_bytes($lenght);
	}

/*
 * This method return unique string line based on make() method.
 */
	public static function unique() {
		return self::make(uniqid());
	}
}