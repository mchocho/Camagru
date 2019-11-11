<?php
require_once ('ft_util.php');
require_once ('sql_connect.php');
ft_session_start();
scream();

function compose_letter($str) {
	if (issetstr($str)) {
		$letter = "<h1>Verify Your Email</h1>";
		$letter .= "<p>Please confirm that you want to use this email address for your Mojo account. Once it's done you will be able to start using this service.</p>";
		$letter .= '<button><a href="' . $str . '" target="_blank">Verify my email</a></button><br />';
		$letter .= 'Or copy and paste the link below into the address bar<br />';
		$letter .= $str . '<br />';
		$letter .= '<br /><p align="center">&copy Mojo | 2019</p>';
		return $letter;
	}
}

if (!isset($_SESSION['email'])) {
	$result = array(false, 'Please enter your email address');
	echo json_encode($result);
	die();
}
$date= date_create();
$e   = trim($_SESSION['email']);
$key = hash('sha256', date_timestamp_get($date) . $_SESSION['id']);
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$url = rtrim($url) . '/validate_user.php?key=' . $key;

try {
	$q      = "INSERT INTO tokens (user_id, token, request) VALUES (?, ?, ?)";
	$result = $dbc->prepare($q);
	$result->execute([$_SESSION['id'], $key, 'registration']);

	email_client($e, "Email verification | Camagru", compose_letter($url));
	ft_redirectuser('../verify_email.php');
} catch (PDOException $err) {
	ft_print_r($err);
}
