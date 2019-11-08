<?php
require_once ('sql_connect.php');
require_once ('ft_util.php');
ft_session_start();
scream();

if (isset($_SESSION['username'])) {
	try {
		$q      = "SELECT * FROM users WHERE username=?";
		$result = $dbc->prepare($q);
		$result->execute([$_SESSION['username']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		$_SESSION['username'] = $result['username'];
		$_SESSION['id']       = $result['id'];
		$_SESSION['admin']    = $result['admin'];
	} catch (PDOException $err) {
		echo "Something went wrong";
	}
}