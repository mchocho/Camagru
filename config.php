<?php
require_once("env.php");

define("DB", getenv("DB_NAME"));
define("DB_INIT", getenv("DB_INIT"));
define("SERVER", getenv("SERVER"));
define("USERNAME", getenv("USERNAME"));
define("PASSWORD", getenv("PASSWORD"));

//App variables
define("APP_NAME", getenv("APP_NAME"));
define("ALERT_ERROR", "Check your console for errors.");
define("MAX_UPLOAD_SIZE", 500000);

