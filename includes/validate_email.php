<?php

require_once ('ft_util.php');

scream();

function compose_letter($str) {
	if (issetstr($str)) {
		$letter = "<h1>Verify Your Email</h1>";
		$letter .= "<p>Please confirm that you want to use this email address for your Mojo account. Once it's done you will be able to start using this service.</p>";
		$letter .= '<button><a href="'.$str.'" target="_blank">Verify my email</a></button>';
		$letter .= "&copy Camagru | 2019";
		return $letter;
	}
}

session_start();

$e = 'mchocho@student.wethinkcode.co.za';

//This is a tester
echo mail($e, "HI There!", wordwrap(compose_letter("Hi welcome back"), 70), 'From: Mojo@hotmail.com');

/*if (session_start() && issetstr($_SESSION['id'])) {
if (!is_email($_SESSION['email'])) {
$result = array(false, 'Please enter your email address');
echo json_encode($result);
die();
}
$e   = trim($_SESSION['email']);
$key = hash('sha256', $_SESSION['email']);
$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$url = rtrim($url).'/verify_email.php?key='.$key;

try {
$q      = "INSERT INTO tokens (user_id, token, request) VALUES (?, ?, ?)";
$result = $dbc->prepare($q);
$result->execute([$_SESSION['id'], $key, 'registration']);

email_client($e, "Email verification | Camagru", compose_letter($url));
ft_redirect('../verify_email.php');
} catch (PDOException $err) {
ft_print_r($err);
}
}*/
