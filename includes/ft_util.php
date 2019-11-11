<?php

function ft_session_start() {
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	return;
}

function ft_redirectuser($page = 'index.php') {
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/'.$page;
	header("Location: $url");
	exit();
}

function index() {
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/index.php';
	return ($url);
}

function current_path() {
	$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	return ($url);
}

function scream() {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	return;
}

function stfu() {
	error_reporting(0);
}

function issetstr($value) {
	return (is_string($value) && !empty($value));
}

function presetinput_text($name) {
	if (is_string($name) && isset($name)) {
		echo $name;
	}
	return;
}

function presetinput_radio($name, $value) {
	if (is_string($name) && isset($name) && $name === $value) {
		echo 'checked="checked"';
	}
	return;
}

function presetinput_select($name, $value) {
	if (is_string($name) && isset($name) && $name === $value) {
		echo 'selected="selected"';
	}
	return;
}


function is_email($value) {
	return (is_string($value) && isset($value) && filter_var($value, FILTER_VALIDATE_EMAIL));
}

function contains_lc($str) {
	return ($str !== strtoupper($str));
}

function contains_up($str) {
	return ($str !== strtolower($str));
}

function is_securepassword($password) {
	if (issetstr($password))
		return (contains_lc($password) && contains_up($password) && strlen($password) <= 5);
	return false;
}

function is_validpassword($password, $hash) {
	return (is_string($password) && is_string($hash) && isset($password, $hash) && password_verify($password, $hash));
}

function hash_password($password) {
	return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function email_client($to, $subject, $body) {
	if (is_email($to) && issetstr($subject) && issetstr($body)) {
		return @mail($to, $subject, wordwrap($body, 70), 'From: no-reply@Mojo.com');
	}
	return false;
}

function g_action() {
	return ($_SERVER['REQUEST_METHOD'] === 'GET');
}

function p_action() {
	return ($_SERVER['REQUEST_METHOD'] === 'POST');
}

function array_substr_search($arr, $keyword) {
	foreach ($arr as $index => $string) {
		if (is_string($string)) {
			if (strpos($string, $keyword) !== FALSE) {
				return $index;
			}
		}
	}
	return;
}

function generate_token() {
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	return $token;
}

function ft_print_r($value) {
	header('Content-type: text/plain');
	echo '<pre>';
	print_r($value);
	echo '</pre>';
	return;
}

function ft_echo($str) {
	echo '<script type="text/javascript">console.log("';
	echo $str;
	echo '");</script>';
	return;
}

function ft_makedir($path) {
	if (!file_exists($path)) {
	    mkdir($path, 0777, true);
	}
	return;
}
