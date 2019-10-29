<?php
require ('ft_util.php');
//scream();

if (p_action() && session_start()) {
	$errors = array();

	if (issetstr($_POST['username'])) {
		$user = trim($_POST['username']);
	} else {

		$errors[] = 'Please enter your username';
	}

	if (is_email($_POST['email'])) {
		$e = trim($_POST['email']);
	} else {

		$errors[] = 'Please enter your email address';
	}

	if (issetstr($_POST['password'])) {
		if ($_POST['password'] != $_POST['password2']) {
			$errors[] = 'The passwords provided don\'t match';
		} else {

			$p = $_POST['password2'];
		}
	} else {

		$erros[] = 'Please enter your password';
	}

	if (!empty($errors)) {
		print_r($errors);
	} else {
		require_once ('sql_connect.php');

		try {
			$q      = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
			$result = $dbc->prepare($q);
			$p      = hash_password($p);
			if ($result->execute([$user, $e, $p])) {
				echo "Registration successful";
				//Send verification email;

			}
		} catch (PDOException $err) {
			if (array_substr_search($err, 'Duplicate entry')) {
				if (array_substr_search($err, "for key 'email'")) {
					echo "This email already exists.";
				}

				if (array_substr_search($err, "for key 'username'")) {
					echo "<br />This username already exists";
				}
			}
		}
	}
}

?>
