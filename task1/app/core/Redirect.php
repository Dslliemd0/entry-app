<?php
/*
 * Class which redirects URL links.
 */
class Redirect {

/*
 * Redirection method which clears a relative link to base and then adds supported path by $location variable.
 */
	public static function to($location = null) {
		if (isset($_GET['url'])) {
			$_GET['url'] = '';
		}
		header('Location: ' . $location);
		exit();
	}
}