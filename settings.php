<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Settings | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
		<style>
			.hide, input.file {
				display: none;
				visibility: hidden;
			}
			
		</style>
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Settings</h1>

		<div class="settings_container">
			<div class="edit pic">
				<div class="profile_container">
						<img src="https://i.pinimg.com/originals/71/68/2a/71682a3bc39b9552c51836c9b399c467.jpg" id="pic" class="pic" />
				</div>
				<input type="button" id="edit_pic" class="button" value="Change Profile Pic" />
				<form method="POST" enctype="multipart/form-data" id="pic_input" class="input hide">
					<button>
						<label>
							Change profile picture
							<input type="file" id="file" name="pic" class="file" />
						</label>
					</button>
					<input type="submit" name="submit" value="Save" />
				</form>

			</div>
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
				<input type="button" id="edit_email" class="button" value="Change email" />
				<form method="POST" id="email_input" class="input hide">
					<label>
						<span>New email</span>
						<input type="text" name="email" />
					</label>
					<input type="submit" name="submit" value="Save" />
				</form>
			</div>
			<div class="edit password">
				<p>Reset password <div class="icon lock"></div></p>
				<input type="button" id="edit_password" class="button" value="Change password" />
				<form method="POST" id="username_input" class="input hide">
					<label>
						<span>Email address</span>
						<input type="text" name="email" />
					</label>
					<input type="submit" name="submit" value="Reset My Password" />
				</form>
			</div>
		</div>
		<script>
			const btns = [
				document.getElementById('edit_pic'),
				document.getElementById('edit_username'),
				document.getElementById('edit_email'),
				document.getElementById('edit_password')
			];

			btns.forEach(function(value, i) {
				console.log("Value = " + value);
				value.addEventListener('click', function(e) {
					const el = e.target,
						next = el.nextElementSibling;

					console.log('next');

					if (next.className.indexOf('hide') > -1)
						next.classList.remove('hide');
					else
						next.classList.add('hide');
				});
			});

			document.getElementById('file').addEventListener('change', function handleFiles(files) {
  				//for (let i = 0; i < files.length; i++) {
				console.log('Hello onchange');
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
				//}
			});
		</script>
	</body>
</html>
