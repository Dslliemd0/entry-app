<form action="" method="post" class="signup" <?php echo $data['register_style_display']; ?>>
	<fieldset>
		<p  class="errors"><?php
		if (isset($data['register_errors'])) {
			foreach ($data['register_errors'] as $error) {
				echo $error, '<br />';		
			}
		}
		?></p><p class="notifications">
		<?php
		if (isset($data['notifications'])) {
			echo $data['notifications'];
		}
		?></p>
		<legend>Sign Up</legend>
		<div class="logo"></div>
		<hr class="separate-line" />
		
		<div class="input-container">
			<label class="required" for="name">Name</label><br />
			<input type="text" size="15" name="name" id="name" value="<?php echo $data['name']; ?>" autocomplete="off">
			<i class="form-icon user-inactive"></i>
		</div>
		<div class="input-container">
			<label class="required" for="email">Email</label><br />
			<input type="email" size="15" name="email" id="email" value="<?php echo $data['email']; ?>">
			<i class="form-icon email-inactive"></i>
		</div>
		<div class="input-container">
			<label class="required" for="password">Password</label><br />
				<input type="password" size="15" name="password" id="password" value="">
				<i class="form-icon password-inactive"></i>
		</div>
			<input type="hidden" name="token" value="<?php echo $data['token']; ?>">
			<input type="hidden" name="signup_submit" value="pass">
			<button class="button submit-button" type="submit" name="Register" value="accepted">Sign Up</button>
			
		</fieldset>
</form>