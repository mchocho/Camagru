<?php
/*
 * This script performs an INSERT query to add a new record
 * to the users table
 */

//function ft_registration() {
	//Check for form submission
	//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$errors = array();	//Init an error array

		//Check for firstname:
		if (!empty($_POST['username']))
			$fn = trim($_POST['username']);
		else
			$errors[] = 'Please enter your username';

		//Check for lastname:
		/*if (!empty($_POST['lastname']))
			$ln = trim($_POST['lastname']);
		else
			$errors[] = 'Please enter your lastname';
		*/

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
		} else echo "The input you provided was correct. Now fuck off!";
//}

//ft_registration();
?>
