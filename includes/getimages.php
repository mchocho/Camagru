<?php
require_once('sql_connect.php');
require_once('ft_util.php');
ft_session_start();
scream();


if (isset($_SESSION['username'])) {
	try {
		$q      = "SELECT name FROM images";
		$result = $dbc->prepare($q);
		$result->execute();
		// $result = $result->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		echo "Something went wrong";
	}
}