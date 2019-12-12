<form action="" method="post" class="login" <?php echo $data['login_style_display']; ?>>
	<fieldset>
		<p class="errors"><?php
		if (isset($data['login_errors'])) {
			foreach ($data['login_errors'] as $error) {
				echo $error, '<br />';		
			}
		}
		?></p>
		<legend>Log In</legend>
		<div class="logo"></div>
		<hr class="separate-line" />
		<div class="input-container">
			<label class="required" for="email">Email</label><br />
			<input id="email" type="email" size="15" name="email" id="password" autocomplete="off">
			<i class="form-icon email-inactive"></i>
		</div>
		<div class="input-container">
			<label class="required" for="password">Password</label><br />
				<input type="password" size="15" name="password" id="password" autocomplete="off">
				<i class="form-icon password-inactive"></i>
			</div>
			<input type="hidden" name="token" value="<?php echo $data['token'] ?>">
			<input type="hidden" name="login_submit" value="pass" />
			<button class="button submit-button" type="submit" name="login" id="login" value="accepted">Login</button>
			<span  class="forgot-button"><a href="">Forgot?</a></span>
		</fieldset>
</form>