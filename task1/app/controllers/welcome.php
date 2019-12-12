<?php
/*
 * Controller class Wellcome for logged in user actions.
 */
class Welcome extends Controller {

/*
 * Private Welcome object variable $_form_position to set content position on view.
 */	
	private $_form_position = ' style="left: 50%;"';

/*
 * Method who return given Session variable.
 */
	private function flashNotifications($name) {
		if(Session::exists($name)) {
			return Session::flash($name);
		}
	}

/*
 * Method which instantiate model User object and fill array with user data, and then render Welcome view with this data.
 */	
	public function welcomeuser() {

		$user = $this->model('User');

		$data = array(
			'is_logged' => $user->isLoggedIn(),
			'name' => escape($user->data()->name),
			'form_position' => $this->_form_position,
			'flash_notification' => $this->flashNotifications('welcome')
		);

		$this->view('header', $data);
		$this->view('welcome/index', $data);
		$this->view('footer');
	}
}