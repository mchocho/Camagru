<?php

require_once('ft_util.php');
require_once('sql_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!is_email($_POST['email'])) {
		$result = array(false, 'Please enter your email address');
		echo json_encode($result);
		die();
	}
	$email = trim($_POST['email']);
	$key = hash('sha256', $email);
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url) . '/verify_email.php?key=' . $key;

}
