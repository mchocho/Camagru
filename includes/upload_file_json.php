<?php

session_start();
require ('ft_util.php');
require ('sql_connect.php');
scream();



if (p_action() /*&& isset($_POST['submit'], $_POST['file'], $_SESSION['id'])*/ ) {

	// $content 	   = file_get_contents("php://input");
	$filename      = uniqid();
	$target_file   = "../images/uploads/" . $filename;
	$temp		   = '../images/tmp/' . $filename;
	$file          = $_FILES["file"];
	$imageFileType = strtolower(pathinfo($file["tmp_name"], PATHINFO_EXTENSION));
	$allowed       = array('jpg', 'jpeg', 'gif', 'png', 'tif');
	$target_file  .= '.'.explode('/', $file['type'])[1];
	$temp		  .= '.'.explode('/', $file['type'])[1];
	// $temp

	// header('Content-type: ' . $file['type']);

	echo "File is of type --> " . $target_file;	

	ft_makedir('../images/uploads/');
	ft_makedir('../images/tmp/');

	// ft_print_r($content);
	file_put_contents($temp, $file['name']);
}