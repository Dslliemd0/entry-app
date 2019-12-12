<?php
/*
 * Contoller class Entry who extends a main Controller class.
 */
class Entry extends Controller {

/*
 * Private Entry object vairables, which get values processing object functions and then are sended to view.
 */
	private $_login_errors,
			$_register_errors,
			$_notifications,
			$_form_position = ' style="left: 50%;"',
			$_login_style_display = ' style="display: block;"',
			$_register_style_display = ' style="display: none;"';

/*
 * This method validates submitted login form data and other conditions for security and usability. It generates User model (to operate database data), then it checks if login form is submitted (because, there are two forms - Login and Register). Also it checks inputted tokens match to form token. If these conditions are true, then process a form validation. If validation has passed, it sets a flash message and redirects to other controller - Welcome and this method welcomeuser(). If validation has not passed, then it outputs a error list above form.
 */
	private function validateLoginForm() {
		$user = $this->model('User');
		if (Input::exists() && (Input::get('login_submit') == 'pass')) {
			if (Token::check(Input::get('token'))) {
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'email' => array('required' => true),
					'password' => array('required' => true)
				));

				if ($validation->passed()) {
					$user = new User();
					$login = $user->login(Input::get('email'), Input::get('password'));

					if ($login) {
						Session::flash('welcome', 'You logged successfully!');
						Redirect::to('welcome/welcomeuser');
					} else {
						$this->_login_errors = $validation->errors();
						$this->_login_errors[] = 'You entered wrong e-mail and/or password!';
					}
				} else {
					$this->_login_errors = $validation->errors();
				}
			}
		}
	}

/* 
 * This method is similar to validateLoginForm() method. Difference is that, it checks a different registration form submitted data, and if it pass this case it outputs message of successful result and registers the user to database.
 */
	private function validateRegisterForm() {
		if (Input::exists() && (Input::get('signup_submit') == 'pass')) {
			$this->_form_position = ' style="left: 2.5%;"';
			$this->_login_style_display = ' style="display: none;"';
			$this->_register_style_display = ' style="display: block;"';
			if (Token::check(Input::get('token'))) {	
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
						'name' => array(
						'required' => true,
						'min' => 2,
						'max' => 50
					),
					'email' => array(
						'unique' => 'users',
						'required' => true,
						'min' => 4,
						'max' => 50
					),
					'password' => array(
						'required' => true,
						'min' => 6
					)
				));

				if ($validation->passed()) {
					

					$user = $this->model('User');
					$salt = Hash::salt(32);

					try {
						$user->create(array(
							'name' => Input::get('name'),
							'email' => Input::get('email'),
							'password' => Hash::make(Input::get('password'), $salt),
							'salt' => $salt,
							'joined' => date('Y-m-d H:i:s')
						));
					} catch (Exception $e) {
						die($e->getMessage());
					}

					$this->_notifications = 'You registered successfully!';
				} else {
					$this->_register_errors = $validation->errors();
				}
			}
		}
	}

/*
 * This method checks if user is submitted one of two forms (login or register). If it's that, then starts a form validation, and if the case is successfull, then it redirects page to other controller and method, or output message of successfull action. If none of forms has submitted, then it generate a new token for form, declare an array which contains data to pass into view, and then output a view in four parts (header, login, register and footer view).
 */
	public function signInOrUp() {
		$this->validateLoginForm();
		$this->validateRegisterForm();
		$token = $this->generateToken();
		$data = array(
			'name' => escape(Input::get('name')),
			'email' => escape(Input::get('email')),
			'notifications' => $this->_notifications,
			'login_errors' => $this->_login_errors,
			'register_errors' => $this->_register_errors,
			'token' => $token,
			'form_position' => $this->_form_position,
			'login_style_display' => $this->_login_style_display,
			'register_style_display' => $this->_register_style_display
		);
		$this->view('header', $data);
		$this->view('login/index', $data);
		$this->view('register/index', $data);
		$this->view('footer');
	}
}