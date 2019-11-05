<?php
$session_ready = (session_start())?true:false;
require_once ('ft_util.php');
scream();

//echo "Hello signin.php<br />";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$errors        = array();
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
		$result->execute([$u, $u]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		if (is_validpassword($p, $result['password'])) {
			$_SESSION['email'] = $e;
			if ($result['validated'] === 'F') {
				ft_redirectuser('../verify_email.php');
			} else {
				if ($session_ready) {
					$_SESSION['username'] = $result['username'];
					$_SESSION['id']       = $result['id'];
					$_SESSION['admin']    = $result['admin'];
				}
				ft_redirectuser('../');
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
