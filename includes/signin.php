<?php
session_start();
require_once ('ft_util.php');
require_once ('sql_connect.php');
stfu();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$errors        = array();

	if (isset($_POST['username']) && !empty($_POST['username'])) {
		$u = trim($_POST['username']);
	} else {
		$errors[] = 'error_1=1';
	}

	if (isset($_POST['password']) && !empty($_POST['password'])) {
		$p = trim($_POST['password']);
	} else {
		$errors[] = 'error_2=2';
	}

	if (!empty($errors)) {
		$url = '?';

		foreach($errors as $key => $value) {
			$url .= $value . '&';
		}
		ft_redirectuser('../signin.php' . $url);
	}

	try {
		$q      = "SELECT * FROM users WHERE (username=?) OR (email=?)";
		$result = $dbc->prepare($q);
		$result->execute([$u, $u]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		if (is_validpassword($p, $result['password'])) {
			$_SESSION['email'] = $result['email'];
			if ($result['validated'] === 'F') {
				ft_redirectuser('../verify_email.php');
			} else {
				$_SESSION['username'] = $result['username'];
				$_SESSION['id']       = $result['id'];
				$_SESSION['admin']    = $result['admin'];
				ft_redirectuser('../index.php');
				die();
			}
		} else {
			ft_redirectuser('../signin.php?error_3=3' . $url);
		}
	} catch (PDOException $e) {
		ft_redirectuser('../signin.php?error_3=3' . $url);
	}
}//else ft_redirectuser('../');
