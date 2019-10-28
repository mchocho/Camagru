<?php
require('scream.php');

//echo "hello siginin.php";
//print_r($_POST);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();

	if (empty($_POST['username']))
		$errors[] = 'Please enter your email address.';
	else
		$u = trim($_POST['username']);

	if (empty($_POST['password']))
		$errors[] = 'Please enter your password.';
	else
		$p = trim($_POST['password']);

	if (!empty($errors))
	{
		print_r($errors);
		return array(false, $error);
	}

	echo "It works here<br />";

	try {
		require_once('sql_connect.php');
		$p = $p = password_hash($p, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND pass=?");
		$stmt->execute($u, $p);
		
		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
		}
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}



/*	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

		//You need to handle the result
		//return array(true, $row);
	}*/
	//$errors[] = "Your email or password was incorrect.";
	//return array(false, errors);
}

?>
