<?php
require_once('ft_util.php');
require_once('sql_connect.php');
require_once('getusers.php');
ft_session_start();


function compose_message($username, $commenter, $url) {
	$msg  = '<h2>Hi' . $username . '</h2>';
	$msg .= "<p>$commenter . has just commented on your post.</p><br />";
	$msg .= "<p>To view the post, click on the link below</p><br />";
	$msg .= '<a href=""' . $url . '</a>';
	$msg .= '<br /><br /><p align="center">&copy Mojo | 2019</p>';
	return $msg;
}


if (p_action() && isset($_POST['comment'], $_POST['submit'], $_POST['image'], $_SESSION['id']) && is_array($result)) {
	try {
		$user = $result;
		
		$q = "INSERT INTO comment (user_id, image_id, message) VALUES (?, ?, ?)";
		$comment = $dbc->prepare($q);
		$comment->execute([$user['id'], $_POST['image'], $_POST['comment']]);
		
		$q      = "SELECT user_id FROM images WHERE (id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$_POST['image']]);
		$user_id = $result->fetch(PDO::FETCH_ASSOC);

			
		$q      = "SELECT username, email, notifications FROM users WHERE (id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$user_id['user_id']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		if ($result['notifications'] === 'T') {
			$url = current_path() . '../post.php?id=' . $_POST['image'];
			email_client($result['email'], $user['username'] . ' commented on your post', compose_message($result['username'], $user['username'], $url));
		}
		//echo '{"status": "OK"}';
	} catch(PDOException $e) {
		//echo '{"status": "FAILED"}';
		ft_print_r($e);
	}
}
ft_redirectuser('../post.php?id='.$_POST['image']);
