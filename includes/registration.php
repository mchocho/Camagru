<?php
require ('ft_util.php');
//scream();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
		$q      = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
		$result = $dbc->prepare($q);
		$p      = hash_password($p);
		//$status = $result->execute([$user, $e, $p]);

		try {
			$result->execute([$user, $e, $p]);
		} catch (PDOException $err) {
			//$obj = 

			//header('Content-type: text/plain');
			//echo '<pre>'; print_r($err); echo '</pre>';
			print_r($err->errorInfo);

		}

	}
}

?>
