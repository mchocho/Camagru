<?php

//require_once('./ft_util.php');

//error_reporting();
//scream();

echo "Hello signin.php<br />";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$errors = array();
	$session_ready = (session_start()) ? true : false;

	print_r($_POST);

	if (issetstr($_POST['username']))
		$u = trim($_POST['username']);
	else

	if (issetstr($_POST['password']))
		$p = trim($_POST['password']);
	else
		$errors[] = 'Please enter your password.';

	if (!empty($errors)) {
		print_r($errors);
		die();
	} else if ( {
		echo "Failed to connect to database.";
		die();
	} 

	echo "It works here<br />";

	try {
		$dbc = sql_connect();
		$q = "SELECT * FROM users WHERE (username=? AND password=?) OR (email=? AND password=?)";
		$result = $dbc->prepare($q);
		$p = hash_password($p);
		$result->execute([$u, $p, $u, $p]);

		
		if ($dbc->rowCount() === 1) {
			$result = $result->fetch(PDO::FETCH_ASSOC);
			//while ($row = $result->fetch())
			//{
			echo "Hello John";
			$result = $result->fetch();
				print_r($result);
			//}
		} else {
			echo "No results were found!";
			//die();
		}
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		$errors[] = "Your email or password was incorrect.";
		print_r($errors);
	}



/*	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

		//You need to handle the result
		//return array(true, $row);
	}*/
	//$errors[] = "Your email or password was incorrect.";
	//return array(false, errors);
}

