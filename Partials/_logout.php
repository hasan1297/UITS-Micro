<?php

session_start();

session_unset();
session_destroy();

header("location: /isp/loginPage2.php");
exit;

?>