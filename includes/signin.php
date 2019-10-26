<?php
require('ft_util.php');

//echo "hello siginin.php";
//print_r($_POST);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();
	$session_ready = (session_start()) ? true : false;

	if (issetstr($_POST['username']))
		$u = trim($_POST['username']);
	else
		$errors[] = 'Please enter your username address.';

	if (issetstr($_POST['password']))
		$p = trim($_POST['password']);
	else
		$errors[] = 'Please enter your password.';

	if (!empty($errors))
		return array(false, $error);

	echo "It works here";

	try {
		require_once('sql_connect.php');
		$q = "SELECT * FROM users WHERE (username=? AND pass=?) OR (email=? AND pass=?)";
		$result = $dbc->prepare($q);
		$p = hash_password($p);
		$result->execute([$u, $p, $u, $p]);
		
		if ($dbc->rowCount() === 1) {
			$result = $result->fetch(PDO::FETCH_ASSOC);
			while ($row = $result->fetch())
			{
				print_r($row);
			}
		}
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
		$errors[] = "Your email or password was incorrect.";
		print_r();
	}
}
?>
