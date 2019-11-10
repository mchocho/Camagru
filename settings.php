<?php
session_start();
require ('includes/ft_util.php');
require ('includes/getusers.php');
scream();
if (!isset($_SESSION['id'], $_SESSION['username'], $result['email'], $result['notifications'])) {
	ft_redirectuser();
}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Settings | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
		<style>
			h2 {
				margin-top: 0% !important;
			}

			.settings_container {
				width : 40%;
			}

			.edit img {
				width: 50%;
				height: 50%;
			}

			.hide, input.file {
				display: none;
				visibility: hidden;
			}

			div.icon.slider {
				width: 128px;
				height: 128px;
				background: url('images/icons/slider.png');
				cursor: pointer;
			}

			div.icon.slider.off {
				background: url('images/icons/slider_off.png');
			}

			.icon.slider input {
				visibility: hidden;
			}

		</style>
	    <!-- Or link external file -->
        <link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body>
		<!-- Content goes here -->
		<header class="header">
			<a href="index.php">
				<div class="logo">
					<img src="images/icons/logo_true.jpg" />
				</div>
				<div class="heading">
					<h1>Mojo</h1>
				</div>
			</a>
			<?php
				require ('includes/profile_header.php');
			?>
		</header>
		<div class="wrapper main settings" align="center">
			<h2>Settings</h2>
			<div class="settings_container">
				<div class="edit pic">
					<div class="profile_container">
							<img src="images/mojo.jpg" id="pic" class="pic" />
					</div>
					<input type="button" id="edit_pic" value="Change Profile Pic" class="btn" />
					<form action="includes/handle_settings.php" method="POST" enctype="multipart/form-data" id="pic_input" class="input hide">
						<button>
							<label>
								Change profile picture
								<input type="file" id="file" name="pic" class="file" />
							</label>
						</button>
						<input type="submit" name="submit" value="Save" class="btn" />
					</form>

				</div>
				<div class="edit username">
					<p>Your current username is <span><?php echo $_SESSION['username'];?></span></p>
					<input type="button" id="edit_username" value="Change Username" class="btn" />
					<form action="includes/handle_settings.php" method="POST" id="username_input" class="input hide">
						<label>
							<span>New username</span>
							<input type="text" name="username" class="text" />
						</label>
						<label>
							<span>Current password</span>
							<input type="password" name="password" class="text" />
						</label>
						<input type="submit" name="submit" value="Save" class="btn" />
						<input type="hidden" name="resetusername" value="true" />
					</form>
				</div>
				<div class="edit email">
					<p>Your current email address is <span><?php echo $result['email'];?></span></p>
					<input type="button" id="edit_email" value="Change email" class="btn" />
					<form action="includes/handle_settings.php" method="POST" id="email_input" class="input hide">
						<label>
							<span>New email</span>
							<input type="text" name="email" class="text" />
						</label>
						<label>
							<span>Current password</span>
							<input type="password" name="password" class="text" />
						</label>
						<input type="submit" name="submit" value="Save" class="btn" />
						<input type="hidden" name="resetemail" value="true" />
					</form>
				</div>
				<div class="edit notifications">
					<?php
						$str = "Notifications are currently ";
						if ($result['notifications'] === 'T') {
							$str .= "enabled";
						} else {

							$str .= "disabled";
						}

						echo '<p>'.$str.'</p>';
					?>
					<input type="button" id="edit_notifications" value="Change notifications" class="btn" />
					<form action="includes/handle_settings.php" method="POST" id="notifications_input" class="input hide">
						<label>
						<?php
							$val = '';
							echo '<div id="icon_slider" class="icon slider';
							if ($result['notifications'] === 'F') {
								echo ' off';
							}
							echo '">';
							echo '<input type="checkbox" id="slider_input" name="notifications" value="on"';
							if ($result['notifications'] === 'T') {
								echo ' checked="check"';
							}
							echo ' /></div>';
						?>
						</label>
						<input type="submit" name="submit" value="Save" class="btn" />
						<input type="hidden" name="setnotifications" value="true" />
					</form>
				</div>
				<div class="edit password">
					<p>Reset password <div class="icon lock"></div></p>
					<input type="button" id="edit_password" value="Change my password" class="btn" />
					<form action="includes/handle_settings.php" method="POST" id="password_input" class="input hide">
						<label>
							<span>Current password</span>
							<input type="password" name="password" class="text" />
						</label>
						<label>
							<span>New password</span>
							<input type="password" name="newpassword" class="text" />
						</label>
						<label>
							<span>Confirm password</span>
							<input type="password" name="passwordconfirm" class="text" />
						</label>
						<input type="submit" name="submit" value="Reset My Password" class="btn" />
						<input type="hidden" name="resetpassword" value="true" />
					</form>
				</div>
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/"             title="Flaticon">www.flaticon.com</a></div>
		</footer>
		<script>
			const btns = [
				document.getElementById('edit_pic'),
				document.getElementById('edit_username'),
				document.getElementById('edit_notifications'),
				document.getElementById('edit_email'),
				document.getElementById('edit_password')
			];

			btns.forEach(function(value, i) {
				console.log("Value = " + value);
				value.addEventListener('click', function(e) {
					const el = e.target,
						next = el.nextElementSibling;

					if (next.className.indexOf('hide') > -1)
						next.classList.remove('hide');
					else
						next.classList.add('hide');
				});
			});

			document.getElementById('file').addEventListener('change', function handleFiles(files) {
				const file = document.getElementById('file')[0],
					img = document.getElementById('pic');

    			if (!file.type.startsWith('image/')) return;

    			//const img = document.createElement("img");
    			//img.classList.add("obj");
    			//img.src = file;
				//preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.

				const reader = new FileReader();
				reader.onload = function() {
					return function(e) {
						img.src = e.target.result;
					};
				};
				reader.readAsDataURL(file);
			});

			document.getElementById('slider_input').addEventListener('change', function() {
				const el = document.getElementById('slider_input');

				if (el.checked) {
					document.getElementById('icon_slider').classList.remove('off');
				} else {
					document.getElementById('icon_slider').classList.add('off');
				}
			});
		</script>
	</body>
</html>
