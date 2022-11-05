<?php

session_start();

session_unset();
session_destroy();

header("location: loginPage2.php");
exit;

?>