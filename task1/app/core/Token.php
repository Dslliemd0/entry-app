<?php

/*
 * Token class which generate and then inputs tokens (random string) for security reasons to check if user inputs data from form.
 */
class Token {

/*
 * Method which returns generated random string from string which stored in session global variable and encrypts in MD5 method.
 */
	public static function generate() {
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}

/*
 * Method which check if the generated form token matches of global session variable and returns boolean value (true or false).
 */
	public static function check($token) {
		$tokenName = Config::get('session/token_name');
		if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
		return false;
	}
}