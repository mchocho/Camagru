<?php
session_start();
require_once ('ft_util.php');
require_once ('sql_connect.php');
scream();

if (isset($_GET['key'])) {
$key = $_GET['key'];

	try {
		$q      = 'SELECT * FROM tokens WHERE token = ?';
		$result = $dbc->prepare($q);
		$result->execute([$key]);
		$token = $result->fetch(PDO::FETCH_ASSOC);

		$q      = 'UPDATE users SET validated = ?  WHERE id = ?';
		$result = $dbc->prepare($q);
		$result->execute(['T', $token['user_id']]);

		$q      = 'SELECT * FROM users WHERE id = ?';
		$result = $dbc->prepare($q);
		$result->execute([$token['user_id']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
		// echo "Error: ".$e->getMessage();
		//In reality you should just redirect user back to index
	}
}
ft_redirectuser('../signin.php');