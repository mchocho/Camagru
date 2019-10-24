<?php

/**
 *
 *  	This function determines an absolute URL and redirects
 *  	the user there. Default argument is index.php
**/

function ft_redirectuser($page='index.php')
{
	//url is "http://" + hostname + current directory
	$url = 'http://' . $_SERVER['HTTPP_HOST'] . dirname($_SERVER['PHP_SELF']);

	//Remove any trailing slashes
	$url = rtrim($url, '/\\');

	//Add the path
	$url .= '/' . $page;

	//Redirect the user
	header("Location: $url");
	exit();	//Quit the script
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
