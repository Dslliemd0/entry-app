<?php
/*
 * Controller class for logout actions.
 */
class Logout extends Controller {

/*
 * This method instantiate a new model User object and uses a logout function. After that it redirects page to login/register view.
 */
	public function logout() {
		$user = $this->model('User');
		$user->logout();

		Redirect::to('/task1/public');
	}
}