<?php
/*
 * This script performs an INSERT query to add a new record
 * to the users table
 */

//Display any errors in the script
error_reporting(); 

	//Check for form submission
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array();	//Init an error array

		//Check for firstname:
		if (!empty($_POST['username']))
			$user = trim($_POST['username']);
		else
			$errors[] = 'Please enter your username';

		//Now check for an email address:
		if (!empty($_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
			$e = trim($_POST['email']);
		else
			$errors[] = 'Please enter your email address';

		//Check for a password and match against confirmation password
		if (!empty($_POST['password'])) {
			if ($_POST['password'] != $_POST['password2'])
				$errors[] = 'The passwords provided don\'t match';
			else
				$p = $_POST['password2'];
		}

		if (!empty($errors) ) {
			print_r($errors);	
		} else {
			require_once('sql_connect.php');
			$sql = "INSERT INTO users (username, email, password) VALUES (? ,? , ?)";
			$result = $dbc->prepare($sql);
			$p = password_hash($p, PASSWORD_DEFAULT);
			$result->execute([$user, $e, $p]);

		   	echo "The input you provided was correct. Now fuck off!";
		}
	}

?>
