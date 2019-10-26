<?php

function ft_redirectuser($page='index.php')
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	header("Location: $url");
	exit();
}

function scream() {
	error_reporting();
}

function issetstr($value) {
	return (is_string($value) && !empty($value));
}

function presetinput_text($name) {
	if (is_string($name) && isset($name))
		echo $name;
	return;
}

function presetinput_radio($name, $value) {
	if (is_string($name) && isset($name) && $name === $value)
		echo 'checked="checked"';
	return;
}

function presetinput_select($name, $value) {
	if ($is_string($name) && isset($name) && $name === $value))
		echo 'selected="selected"';
	return;
}

function is_email($value) {
	return (is_string($value) && isset($value) && filter_var($value, FILTER_VALIDATE_EMAIL) );
}

function is_validpassword($password, $hash) {
	return (is_string($password) && is_string($hash) && isset($password, $hash) && password_verify($password, $hash));
}

function hash_password($password) {
	$opt = [
		'salt' => password_hash($password, PASSWORD_DEFAULT), //. more_salt_from_an_island();
		'cost' => 12
	];
	return password_hash($password, PASSWORD_BCRYPT, $opt);
}

function email_client($to, $subject, $body) {
	if (is_email($to) && issetstr($subject) && issetstr($body) )
		return mail($to, $subject, wordwrap($body, 70), 'From: Camagru@hotmail.com');
	return false;
}
