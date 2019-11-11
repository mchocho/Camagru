 <?php
$servername = "localhost";
$username   = "root";
$password   = "654321";

try {
	$dbc = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: ".$e->getMessage();
}
?>
