<?php

if ($data['is_logged']) {
	?>
	<p><?php echo $data['flash_notification']; ?></p>
	<p>Welcome <?php echo $data['name']; ?>!</p>
	<p><a href="/task1/public/logout/logout">Log Out</a></p>
<?php
} else {
	echo '<p>Please <a href="/task1/public">login or register</a> to get access this page.</p>';
}