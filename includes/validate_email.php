<?php

require_once('ft_util.php');
require_once('verification_letter.php');

if (is_p_action()) {
	if (!is_email($_POST['email'])) {
		$result = array(false, 'Please enter your email address');
		echo json_encode($result);
		die();
	}
	$e = trim($_POST['email']);
	$key = hash('sha256', $email);
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url) . '/verify_email.php?key=' . $key;

	if (sql_connect()) {
		$query = "SELECT email FROM users WHERE email=?";
		$result = $dbc->prepare($q);
		$result->execute([$e]);

		if ($dbc->rowCount() === 1) 
			email_client($e, "Email verification | Camagru", compose_letter($url));
	}
}
