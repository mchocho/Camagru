<?php
session_start();
require_once ('ft_util.php');
require_once ('sql_connect.php');
scream();

// if (issetstr($_GET['key'])) {
$key = $_GET['key'];
// $key = "61c2abf45b87d5c0f20e76a0c1a8a2130064319eec56ccf84328eb92d8fb5724";

try {
	$q      = 'SELECT * FROM tokens WHERE token = ?';
	$result = $dbc->prepare($q);
	$result->execute([$key]);
	$token = $result->fetch(PDO::FETCH_ASSOC);

	// print_r($token);

	$q      = 'UPDATE users SET validated = ?  WHERE id = ?';
	$result = $dbc->prepare($q);
	$result->execute(['T', $token['user_id']]);

	$q      = 'SELECT * FROM users WHERE id = ?';
	$result = $dbc->prepare($q);
	$result->execute([$token['user_id']]);
	$result = $result->fetch(PDO::FETCH_ASSOC);

	ft_redirectuser('../signin.php');
} catch (PDOException $e) {
	echo "Error: ".$e->getMessage();
	$errors[] = "Your email or password was incorrect.";
	ft_print_r($errors);
	//In reality you should just redirect user back to index
}
// }