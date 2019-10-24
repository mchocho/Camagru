<?php

//This function validates login form data

//function ft_check_logins($dbc, $email='', $pass='')
//{
	$errors = array();

	//Check email first
	if (empty($username))
		$errors[] = 'Please enter your email address.';
	else
		$e = trim($username);

	//Validate password
	if (empty($pass))
		$errors[] = 'Please enter your password.';
	else
		$p = trim($pass);

	//Terminate on error
	if (!empty($errors))
		return array(false, $error);

	//Create the query
	//$q = "SELECT user_id, first_name FROM users WHERE email='$e' AND pass=SHA1('$p')";
	//$r = @mysqli_query($dbc, $q);

	//Connect to DB
	require_once('sql_connect.php');
	try {
		//$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		////$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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



	//Check the result:
	if (mysqli_num_rows($r) == 1) {
		//Fetch the record
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

		//Return record
		return array(true, $row);
	}
	errors[] = 'Sorry, your email or password was incorrect.';
	return array(false, errors);
//}

?>
