<?php

if (session_status() == PHP_SESSION_NONE)
	session_start();

require_once("config.php");
require_once("sql.php");
require_once("ft_util.php");
require_once("validators.php");
require_once("messages.php");
require_once("redirects.php");
require_once("email_templates.php");