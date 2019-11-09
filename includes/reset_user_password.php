<?php
require_once('ft_util.php');
require_once('sql_connect.php');
ft_session_start();

if (p_action() && isset($_SESSION['email']) && !isset($_SESSION['id'])) {
	if (!isset($_POST['password'])) {
		echo 'Please enter a new password.';
		die();
	} else if (!isset($_POST['password_confirm'])) {
		echo 'Please confirm your new password.';
		die();
	} else if ($_POST['password'] !== $_POST['password_confirm']) {
		echo 'The passwords provided don\'t match.';
		die();
	}

	try {
		$password = hash_password($_POST['password']);
		$q		  = 'UPDATE users SET password = ?  WHERE email = ?';
		$result = $dbc->prepare($q);
		$result->execute([$password, $_SESSION['email']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		session_destroy();
		ft_redirectuser('../signin.php');
	} catch (PDOException $e) {
		// echo "Error: ".$e->getMessage();
		// $errors[] = "Your email or password was incorrect.";
		ft_print_r($errors);
		//In reality you should just redirect user back to index
	}

}
// ft_redirectuser('../index.php');