<?php
session_start();
require ('ft_util.php');
require ('sql_connect.php');
scream();

if (p_action() && isset($_POST['submit'], $_POST['file'], $_SESSION['user_id']) ) {

	$content 	   = file_get_contents("php://input");
	$filename      = uniqid();
	$target_file   = "../images/uploads/".$filename;
	$file          = $_FILES["file"];
	$imageFileType = strtolower(pathinfo($file["tmp_name"], PATHINFO_EXTENSION));
	$allowed       = array('jpg', 'jpeg', 'gif', 'png', 'tif');
	$temp		   = '../images/tmp/';

	echo("Hello upload_file_json.php");

	ft_makedir($temp);
	file_put_contents($temp . 'file_name', $my_blob);
}