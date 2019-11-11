<?php
session_start();
require ('ft_util.php');
require_once ('sql_connect.php');
stfu();

if (p_action() && !isset($_SESSION['id'])) {
	$errors = array();

	if (issetstr($_POST['username'])) {
		$user = trim($_POST['username']);
	} else {
		$errors[] = 'error_1=1';
	}

	if (isset($_POST['email'])) {
		if (is_email($_POST['email']))
			$e = trim($_POST['email']);
		else
			$errors[] = 'error_2=2';
	} else {
		$errors[] = 'error_2=2';
	}

	if (isset($_POST['password'])) {
		if (!is_securepassword($_POST['password'])) {
			$errors[] = 'error_4=4';
		} else if ($_POST['password'] != $_POST['password2']) {
			$errors[] = 'error_3=3';
		} else {
			$p = $_POST['password2'];
		}
	} else {
		$errors[] = 'error_5=5';
	}

	if (!empty($errors)) {
		$url = '?';

		foreach($errors as $key => $value) {
			$url .= $value . '&';
		}
		ft_redirectuser('../signup.php' . $url);
	} else {
		try {
			$q      = "SELECT id FROM users WHERE email = ?";
			$result = $dbc->prepare($q);
			$result->execute([$e]);
			$result = $result->fetch(PDO::FETCH_ASSOC);

			if (is_array($result)) {
				ft_redirectuser('../signup.php?error_6=6' . $url);
			}

			$q      = "SELECT id FROM users WHERE (username = ?)";
			$result = $dbc->prepare($q);
			$result->execute([$user]);
			$result = $result->fetch(PDO::FETCH_ASSOC);

			if (is_array($result)) {
				ft_redirectuser('../signup.php?error_7=7' . $url);
			}


			$q      = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
			$result = $dbc->prepare($q);
			$p      = hash_password($p);
			$result->execute([$user, $e, $p]);
			$_SESSION['email'] = $e;
			$_SESSION['name']  = $user;
			$_SESSION['id']    = $dbc->lastInsertId();
			require ("validate_email.php");
			session_destroy();
			ft_redirectuser('../verify_email.php');

		} catch (PDOException $err) {
			ft_redirectuser('../signin.php?error_8=8' . $url);
		}
	}
} else ft_redirectuser('../');
?>
