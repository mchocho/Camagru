<?php
require ('session_start.php');

function changePassword($dbc, $newpassword)
{
	if (issetstr($newpassword) && isset($_SESSION['id']) /*&& is_decentpw($newpassword)*/)
	{
		try
		{
			$q           = "UPDATE users SET password = ? WHERE id = ?";
			$password	 = hash_password($newpassword);
			$result      = $dbc->prepare($q);
			$result->execute([$password, $_SESSION['id']]);
		}
		catch (PDOException $err)
		{
			echo "something went wrong";
		}
	}
}

function changeEmail($dbc, $newemail)
{
	if (is_email($newemail) && isset($_SESSION['id']))
	{
		try
		{
			$q      = "UPDATE users SET email = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$newemail, $_SESSION['id']]);
		}
		catch (PDOException $err)
		{
			echo "something went wrong";
		}
	}
}

<<<<<<< HEAD
function changeUsername($dbc, $username)
{
	if (issetstr($username) && isset($_SESSION['id']))
	{
		try
		{
			$q      = "UPDATE users SET username = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$username, $_SESSION['id']]);
			$_SESSION['username'] = $username;
		}
		catch (PDOException $err)
		{
=======
function changeUsername($dbc, $newusername) {
	if (issetstr($newusername) && isset($_SESSION['id'])) {
		try {
			$q      = "UPDATE users SET username = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$newusername, $_SESSION['id']]);
			$_SESSION['username'] = $newusername;
		} catch (PDOException $err) {
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648
			echo "something went wrong";
		}
	}
}

<<<<<<< HEAD
function changeNotifications($dbc, $value)
{
	if (isset($_SESSION['id']) && ($value === 'T' || $value === 'F'))
	{
		try
		{
			$q      = "UPDATE users SET notifications = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$value, $_SESSION['id']]);
		}
		catch (PDOException $err)
		{
=======
function changeNotifications($dbc, $value) {
	if (isset($_SESSION['id']) && ($value === 'T' || $value === 'F')) {
		try {
			$q      = "UPDATE users SET notifications = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$value, $_SESSION['id']]);
		} catch (PDOException $err) {
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648
			echo "something went wrong";
		}
	}
}

<<<<<<< HEAD
if (p_action() && isset($_POST['password']))
{
	try
	{
=======
if (p_action() && isset($_POST['password'])) {
	try {
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648
		$q      = "SELECT password FROM users WHERE id = ?";
		$result = $dbc->prepare($q);
		$result->execute([$_SESSION['id']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

<<<<<<< HEAD
		if (is_correctpassword($_POST['password'], $result['password'])) {
=======
		if (is_validpassword($_POST['password'], $result['password'])) {
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648
			if (isset($_POST['resetpassword'], $_POST['passwordconfirm'], $_POST['password'])) {
				if ($_POST['newpassword'] !== $_POST['passwordconfirm']) {
					echo "The passwords provided don't match.";
				} else {
					changePassword($dbc, $_POST['newpassword']);
					ft_echo('Your password has been reset to: '.$_POST['newpassword']);
				}
			} else if (isset($_POST['resetemail'], $_POST['email'])) {
				changeEmail($dbc, $_POST['email']);
			} else if (isset($_POST['resetusername'], $_POST['username'])) {
				changeUsername($dbc, $_POST['username']);
			}
		} else {
			echo "The password you entered was incorrect.";
		}
	} catch (PDOException $err) {
		echo "something went wrong";
	}
} else if (p_action() && isset($_POST['setnotifications'])) {
	$notifications = 'F';
	if (isset($_POST['notifications']))
		if ($_POST['notifications'] == 'on')
			$notifications = 'T';
	changeNotifications($dbc, $notifications);
}
ft_redirectuser('../settings.php');
