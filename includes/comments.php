<?php
require_once('ft_util.php');
require_once('sql_connect.php');
require_once('getusers.php');

if (p_action() && isset($_POST['comment'], $_POST['submit'], $_POST['image'], $dbc) && is_array($result)) {
	try {
		$user = $result;
		$q = "INSERT INTO users (user_id, image_id, message) VALUES (?, ?, ?)";
		$result = $dbc->prepare($q);
		$result->execute([$result['id'], $_POST['image'], $_POST['comment']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
		echo 'Something went wrong';
	}
	ft_redirectuser('../post.php?'.$_POST['image']);
}