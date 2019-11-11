<?php

session_start();
session_destroy();
require ('ft_util.php');
stfu();
ft_redirectuser('../index.php');