<?php

// For this project to work you will have to
// change the env values to your configurations
// and copy this file to the root directory and 
// rename it to env.php

$host = "127.0.0.1";
$db   = "camagru";

putenv("APP_NAME=Camagru");
putenv("DB_INIT=mysql:host=$host");
putenv("DB=mysql:host=$host;dbname=$db");
putenv("SERVER=localhost");
putenv("USERNAME=root");
putenv("PASSWORD=securepassword");
putenv("DEV=false");