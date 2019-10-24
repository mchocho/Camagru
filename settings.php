<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Settings | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <!-- <style></style> -->
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Settings</h1>

		<div class="settings_container">
			<div class="edit username">
				<p>Your current username is <span>Thanos$$$</span></p>
				<input type="button" id="edit_username" class="button" value="Change Username" />
				<form method="POST" id="username_input" class="input hide">
					<label>
						<span>New username</span>
						<input type="text" name="username" />
					</label>
					<input type="submit" name="submit" value="Save" />
				</form>
			</div>
			<div class="edit email">
				<p>Your current email address is <span>themadtitan@hotmail.com</span></p>
				<input type="button" class="button" value="Change email" />
				<form method="POST" id="email_input" class="input hide">
					<label>
						<span>New email</span>
						<input type="text" name="email" />
					</label>
					<input type="submit" name="submit" value="Save" />
				</form>
			</div>
			<div class="edit password">
				<p>I want to change my password <div class="icon lock"></div></p>
			</div>
		</div>
	</body>
</html>
