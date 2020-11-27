<?php

session_start();
require ('ft_util.php');
require ('sql_connect.php');
<<<<<<< HEAD
scream();
=======
stfu();
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648

if (p_action() /*&& isset($_POST['submit'], $_POST['file'], $_SESSION['id'])*/) {

	// $content 	   = file_get_contents("php://input");
	$filename      = uniqid();
	$target_file   = "../images/uploads/".$filename;
	// $temp          = '../images/tmp/'.$filename;
	$file          = $_FILES["file"];
	$imageFileType = strtolower(pathinfo($file["tmp_name"], PATHINFO_EXTENSION));
	$allowed       = array('jpg', 'jpeg', 'gif', 'png', 'tif');
	$target_file  .= '.'.explode('/', $file['type'])[1];
	// $temp		  .= '.'.explode('/', $file['type'])[1];
	$filename	  .= '.'.explode('/', $file['type'])[1];
	// $temp

	// header('Content-type: ' . $file['type']);

	// echo "File is of type --> ".$target_file."\n";

	// echo "File contents -->".$file['name'];

	ft_makedir('../images/uploads/');
	// ft_makedir('../images/tmp/');

	// ft_print_r($content);
	file_put_contents($target_file, file_get_contents($file['tmp_name']));

	move_uploaded_file($file['tmp_name'], $target_file);

	try {
		$q      = "CREATE TABLE IF NOT EXISTS `camagru`.`images` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `name` VARCHAR(120) NOT NULL , `date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB";
		$result = $dbc->prepare($q);
		$result = $result->execute();


		$q      = "INSERT INTO images (user_id, name) VALUES (?, ?)";
		$result = $dbc->prepare($q);
		$result = $result->execute([$_SESSION['id'], $filename]);

		$id = $dbc->lastInsertId();
		echo '{"image": "' . $id . '" }';
		// ft_redirectuser('../image_uploads.php');
	} catch (PDOException $e) {
<<<<<<< HEAD
		echo "Something went wrong!";
	}
				// unlink($target_file);

	// if

=======
		echo '{"image": "null" }';
	}
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648

}