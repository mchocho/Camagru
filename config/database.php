 <?php
$servername = "localhost";
$username   = "root";
$password   = "654321";

<<<<<<< HEAD
try
{
	$dbc = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
	echo "Connection failed: ".$e->getMessage();
}

=======
try {
	$dbc = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	include('../config/setup.php');
} catch (PDOException $e) {
	echo "Connection failed: ".$e->getMessage();
}
>>>>>>> 3342713f0688a23ed4cc828482fd439d84b1c648
?>
