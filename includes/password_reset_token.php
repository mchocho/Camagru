<?php
session_start();
require_once ('ft_util.php');
// require_once ('getusers.php');
require_once ('sql_connect.php');
scream();

function compose_letter($str) {
	if (issetstr($str)) {
		$letter = '<h1>Hi There</h1>';
		$letter .= '<p>We received a request to reset your password for your Mojo account.</p>';
		$letter .= '<p>Simply click on the button below to set a new password:</p>';
		$letter .= '<button><a href="' . $str . '" target="_blank">Reset my password</a></button><br />';
		$letter .= 'Or copy and paste the link below into the address bar<br />';
		$letter .= $str . '<br />';
		$letter .= '<br /><p align="center">&copy Mojo | 2019</p>';
		return $letter;
	}
}

if (!isset($_POST['submit'])) 
	ft_redirectuser('../index.php');
else if (!isset($_POST['email'])) {
	echo 'Please enter your email address';
	die();
}

$date= date_create();
$e   = trim($_SESSION['email']);
$key = hash('sha256', date_timestamp_get($date) . $_SESSION['id']);
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$url = rtrim($url) . '/validate_user.php?redirect=&key=' . $key;

try {



	$q      = "INSERT INTO tokens (user_id, token, request) VALUES (?, ?, ?)";
	$result = $dbc->prepare($q);
	$result->execute([$_SESSION['id'], $key, 'password_reset']);

	email_client($e, "Email verification | Camagru", compose_letter($url));
	ft_redirectuser('../verify_email.php');
} catch (PDOException $err) {
	ft_print_r($err);
}