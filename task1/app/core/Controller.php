<?php

/*
 * Main controller class Controller with methods which is abstracted and commonly used by child controllers who extends this class.
 */
class Controller {

/*
 * Protected method which instantiate and return model class, which name given by $model argument, if that model class file exists.
 */
	protected function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

/*
 * Method which render the view, who's name given by $view parameter and supports this view with $data array (by default it povides an empty array).
 */
	protected function view($view, $data = array()) {
		require_once '../app/views/' . $view . '.php';
	}

/*
 * This method generate a token string which is invoked by static method of Token class and then return this string.
 */
	protected function generateToken() {
		return Token::generate();
	}
}