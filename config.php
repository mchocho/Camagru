<?php
require("env.php");

define("DB", getenv("DB"));
define("DB_INIT", getenv("DB_INIT"));
define("SERVER", getenv("SERVER"));
define("USERNAME", getenv("USERNAME"));
define("PASSWORD", getenv("PASSWORD"));

//App variables
define("APP_NAME", "Mojo, Inc");
define("ALERT_ERROR", "Check your console for errors.");
define("MAX_UPLOAD_SIZE", 500000);