<?php

require_once ('ft_util.php');
scream();

//echo "Hello signin.php<br />";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$errors        = array();
	$session_ready = (session_start())?true:false;

	//print_r($_POST);

	if (issetstr($_POST['username'])) {
		$u = trim($_POST['username']);
	} else {
		$errors[] = 'Please enter your password';
	}

	if (issetstr($_POST['password'])) {
		$p = trim($_POST['password']);
	} else {
		$errors[] = 'Please enter your password.';
	}

	if (!empty($errors)) {
		print_r($errors);
		die();
	}

	try {
		require_once ('sql_connect.php');

		$q      = "SELECT * FROM users WHERE (username=?) OR (email=?)";
		$result = $dbc->prepare($q);
		//$p      = hash_password($p);
		$result->execute([$u, $u]);

		// if ($result->rowCount() === 1) {
		$result = $result->fetch(PDO::FETCH_ASSOC);

		// print_r($result);

		if (is_validpassword($p, $result['password'])) {
			if ($result['validated'] === 'F') {
				//Handle validation process
				ft_redirectuser('../verify_email.php');
			} else {
				//echo generate_token()."<br />";
				if (session_ready()) {
					$_SESSION['username'] = $result['username'];
					$_SESSION['id']       = $result['id'];
					$_SESSION['admin']    = $result['admin'];
				}
				//ft_print_r($result);
				ft_redirectuser();
			}
		} else {
			echo "No results were found!";
		}
	} catch (PDOException $e) {
		echo "Error: ".$e->getMessage();
		$errors[] = "Your email or password was incorrect.";
		ft_print_r($errors);
	}
}
