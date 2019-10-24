<?php

function ft_redirectuser($page='index.php')
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	header("Location: $url");
	exit();
}

function presetinput_text($name) {
	if (isset($_POST[$name]))
		echo $_POST[$name];
}

function presetinput_radio($name, $value) {
	if (isset($_POST[$name]) && $_POST[$name] == $value)
		echo 'checked="checked"';
}

function ft_presetinput_select($name, $value) {
	if (isset($_POST[$name] && $_POST[$name] == $value))
		echo 'selected="selected"';
}
