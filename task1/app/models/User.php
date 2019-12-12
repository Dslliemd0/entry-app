<?php

/*
 * User model to interact user data from database.
 */
class User {

/*
 * Private model class properties to store and use data between object methods.
 */
	private $_db, $_data, $_sessionName, $_isLoggedIn;

/*
 * Class constructor method to get database instance and set global session variable to remember is the user are logged in. If the user not found on database, then clear session data from this user.
 */	
	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');

		if (!$user) {
			if (Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if ($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					Session::delete($this->_sessionName);
				}
			}
		} else {
			$this->find($user);
		}
	}

/*
 * Method which insert new user into database by supported field array $fields.
 */
	public function create($fields = array()) {
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}
	}

/*
 * Method which find if the user exists on database and return boolean value to true if exists.
 */
	public function find($user = null) {
		if ($user) {
			$field = (is_numeric($user)) ? 'id' : 'email';
			$data = $this->_db->get('users', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

/*
 * Login method which try to find user and check user's password. If these conditions passed, then inset session values and and return true, else output message for wrong username and/or password, then return false.
 */
	public function login($email = null, $password = null) {
		$user = $this->find($email);
		if ($user) {
			if (password_verify($password, $this->data()->password)) {
				Session::put($this->_sessionName, $this->data()->id);
				return true;
			} else {
				echo 'You have entered wrong e-mail or/and password!';
			}
		}
		return false;
	}

/*
 * Logout function which delete users data from global session variable.
 */
	public function logout() {
		Session::delete($this->_sessionName);
	}

/*
 * Method which return data about user's information stored in database.
 */
	public function data() {
		return $this->_data;
	}

/*
 * This method checks is the user are logged in.
 */
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
}