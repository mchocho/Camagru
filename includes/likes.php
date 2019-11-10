<?php
require_once('ft_util.php');
require_once('sql_connect.php');
require_once('getusers.php');
scream();

if (g_action() && isset($_GET['image_id'], $dbc) && is_array($result)) {
	try {
		$user = $result;
		$q = 'SELECT * FROM likes WHERE (user_id = ?) AND (image_id = ?)';
		$result = $dbc->prepare($q);
		$result->execute([$user['id'], $_GET['image_id']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);
		
		if (is_array($result)) {
			$q = 'DELETE FROM likes WHERE (user_id = ?) AND (image_id = ?)';
			$like = $dbc->prepare($q);
			$like->execute([$user['id'], $_GET['image_id']]);
			echo '{"result": "unliked"}';
		} else {
			$q = 'INSERT INTO likes (user_id, image_id) VALUES (?, ?)';
			$like = $dbc->prepare($q);
			$like->execute([$user['id'], $_GET['image_id']]);
			echo '{"result": "liked"}';
		}
	} catch(PDOException $e) {
		echo 'Something went wrong<br />';
		ft_print_r($e);
	}
}
