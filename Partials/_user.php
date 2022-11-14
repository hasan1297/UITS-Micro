<?php
////    selecting the use  ////
$teacher = false;
$driver = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
  //$LoginId = $_SESSION['loginID'];
  $sql = "SELECT * FROM `tlogin` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    $teacher = true; //teacher
  }
  elseif($num == 0){
    $sql = "SELECT * FROM `dlogin` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      $driver = true; //driver
    }
  } 
} 
?>