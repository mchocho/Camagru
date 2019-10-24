<?php


	$errors = array();

	if (empty($username))
		$errors[] = 'Please enter your email address.';
	else
		$e = trim($username);

	if (empty($pass))
		$errors[] = 'Please enter your password.';
	else
		$p = trim($pass);

	if (!empty($errors))
		return array(false, $error);

	try {
		require_once('sql_connect.php');
		$p = $p = password_hash($p, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND pass=?");
		$stmt->execute();
		
		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
		}
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}



	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

		//You need to handle the result
		//return array(true, $row);
	}
	errors[] = 'Your email or password was incorrect.';
	return array(false, errors);

?>
