 <?php
$servername = "localhost";
$username = "root";
$password = "654321";

try {
	$dbc = new PDO("mysql:host=$servername;dbname=mysql", $username, $password);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
?> 
