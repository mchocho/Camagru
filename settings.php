<?php
require ("includes/settings.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHead("Settings | Mojo");
    ?>
    <link rel="stylesheet" href="css/settings.css" media="all" />
  </head>

  <body>
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main settings" align="center">
      <?php
        include_once("views/settings.php");
      ?>
    </div>

    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>


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
