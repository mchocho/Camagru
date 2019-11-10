<?php
require_once('ft_util.php');
require_once('sql_connect.php');
require_once('getusers.php');
ft_session_start();


function compose_message($username, $commenter, $url) {
	$msg  = '<h2>' . $username . '</h2>';
	$msg .= "<p>$commenter has just commented on your post.</p><br />";
	$msg .= "<p>To view the post, click on the link below</p><br />";
	$msg .= '<a href=""' . $url . '</a>';
	$msg .= '<br /><br /><p align="center">&copy Mojo | 2019</p>';
	return $msg;
}


if (p_action() && isset($_POST['comment'], $_POST['submit'], $_POST['image'], $dbc) && is_array($result)) {
	try {
		$user = $result;

		//Get author of image_id
		$q      = "SELECT user_id FROM images WHERE (id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$_POST['image']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		$q = "INSERT INTO comment (user_id, image_id, message) VALUES (?, ?, ?)";
		$comment = $dbc->prepare($q);
		$comment->execute([$user['id'], $_POST['image'], $_POST['comment']]);
		// $comment = $result->fetch(PDO::FETCH_ASSOC);

		//send email to client
		email_client();
		echo '{"status": "OK"}';
		die();
	} catch(PDOException $e) {
		// echo 'Something went wrong';
		echo '{"status": "FAILED"}';
		ft_print_r($e);
	}
	// ft_redirectuser('../post.php?id='.$_POST['image']);
} else {
	echo '{"status": "FAILED"}';
}