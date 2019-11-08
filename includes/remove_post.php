<?php
require_once('sql_connect.php');
require_once('ft_util.php');
ft_session_start();
scream();

if (isset($_GET['image'], $_SESSION['id'])) {
	try {
		$q      = "DELETE FROM images WHERE (user_id = ?) AND (id = ?)";
		$result = $dbc->prepare($q);
		$result->execute([$_SESSION['id'], $_GET['image']]);

		// echo "Removed image id --> " . $_GET['image'];
		ft_redirectuser('../image_uploads.php');
		// $result = $result->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $err) {
		// echo "Something went wrong</br />";
		ft_print_r($err);
	}
}
?>