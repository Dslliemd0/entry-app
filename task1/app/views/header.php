<!DOCTYPE html>
<html>
	<head>
		<title>Log In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/task1/app/media/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	</head>
	<body>
		<div id="log-in">
			<div id="content">
				<div id="not-account-desc" class="ext-content">
					<div class="desc-content">
						<h1>Don't have an account?</h1>
						<hr class="separate-line" />
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<button id="swbutton" class="button switch-button" type="submit">Sign Up</button>
					</div>
				</div>
				<div id="form-background" <?php echo $data['form_position']; ?>>
					<div id="message"></div>