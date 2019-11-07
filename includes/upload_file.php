<?php
session_start();
require ('ft_util.php');
require ('sql_connect.php');
scream();

if (p_action() && isset($_POST['submit'], $_FILES['file'], $_SESSION['id'])) {

	$filename      = uniqid();
	$target_file   = "../images/uploads/" . $filename;
	$file          = $_FILES["file"];
	$imageFileType = strtolower(pathinfo($file["tmp_name"], PATHINFO_EXTENSION));
	$allowed       = array('jpg', 'jpeg', 'gif', 'png', 'tif');

	echo $target_file;

	if (getimagesize($file['tmp_name'])) {
		if ($file["error"] === 0) {
			if ($file['size'] < 500000) {
				$target_file .= '.'.explode('/', $file['type'])[1];

				move_uploaded_file($file['tmp_name'], $target_file);

				try {
					$q      = "CREATE TABLE IF NOT EXISTS `camagru`.`images` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `name` VARCHAR(120) NOT NULL , `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB";
					$result = $dbc->prepare($q);
					$result = $result->execute();


					$q      = "INSERT INTO images (user_id, name) VALUES (?, ?)";
					$result = $dbc->prepare($q);
					$result = $result->execute([$_SESSION['id'], $filename]);

					ft_redirectuser('../image_uploads.php');
				} catch (PDOException $e) {
					echo "Something went wrong!";
				}
				unlink($target_file);
			} else {
				echo 'The file you provided is too large.';
			}
		} else {
			echo "Something went wrong. Please try again.";
		}
	} else {
		echo "You can't upload files of this type.";
	}
}

?>
