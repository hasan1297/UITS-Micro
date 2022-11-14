<?php
$sql = "SELECT * FROM `basicinfot` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
?>