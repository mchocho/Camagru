<?php
require_once('sql_connect.php');
require_once('ft_util.php');
ft_session_start();
stfu();

if (isset($_GET['image'], $_SESSION['id'])) {
	try {
		$q      = "DELETE FROM images WHERE (user_id = ?) AND (id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$_SESSION['id'], $_GET['image']]);

	} catch (PDOException $err) {
		ft_print_r($err);
	}
}
ft_redirectuser('../image_uploads.php');
?>