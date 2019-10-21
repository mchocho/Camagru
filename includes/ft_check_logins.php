<?php

//This function validates login form data

print_r($_GET);
//function ft_check_logins($dbc, $email='', $pass='')
//{
	$errors = array();

	//Check email first
	if (empty($username))
		$errors[] = 'Please enter your email address.';
	else
		$e = mysqli_real_escape_string($dbc, trim($username));

	//Validate password
	if (empty($pass))
		$errors[] = 'Please enter your password.';
	else
		$p = mysqli_real_escape_string($dbc, trim($pass));

	//Terminate on error
	if (!empty($errors))
		return array(false, $error);

	//Create the query
	$q = "SELECT user_id, first_name FROM users WHERE email='$e' AND pass=SHA1('$p')";
	$r = @mysqli_query($dbc, $q);

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
