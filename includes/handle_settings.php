<?php
session_start();
require('sql_connect.php');
require('ft_util.php');
scream();

function changePassword($newpassword) {
	if (issetstr($newpassword) && issetstr($_SESSION['id']) ) {//&& is_decentpw($newpassword)
		try {
			$q = "UPDATE users SET password = ? WHERE id = ?";
			$newpassword      = hash_password($newpassword);
			$result = $dbc->prepare($q);
			$result->execute([$newpassword, $_SESSION['id']]);
			return true;
		} catch(PDOException $err) {
			echo "something went wrong";
		}
	}
}

function changeEmail($newemail) {
	if (is_email($newpassword) && issetstr($_SESSION['id']) ) {
		try {
			$q = "UPDATE users SET email = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$newemail, $_SESSION['id']]);
			return true;
		} catch(PDOException $err) {
			echo "something went wrong";
		}
	}
}

function changeUsername($newusername) {
	if (issetstr($username) && issetstr($_SESSION['id']) ) {
		try {
			$q = "UPDATE users SET username = ? WHERE id = ?";
			$result = $dbc->prepare($q);
			$result->execute([$newusername, $_SESSION['id']]);
			return true;
		} catch(PDOException $err) {
			echo "something went wrong";
		}
	}
}

if (g_action()) {
	if ($_POST['resetpassword'] === 'true') {
		if ($_POST['newpassword'] !== $_POST['passwordconfirm']) {
			echo "The passwords provided don't match.";
		} else {
			changePassword($_POST['newpassword']);
		}
	} else if ($_POST['resetemail'] === 'true') {
		changeEmail($_POST['newemail']);
	}
}
