<?php
require_once('ft_util.php');
require_once('sql_connect.php');
require_once('getusers.php');

if (g_action() && isset($_GET['image'], $dbc) && is_array($result)) {
	try {
		$user = $result;
		$q = "SELECT * FROM likes WHERE (user_id = ?) AND (image_id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$result['id'], $_GET['image']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		//if (isset())
	} catch(PDOException $e) {
		// echo 'Something went wrong';
		ft_print_r($e);
	}
}