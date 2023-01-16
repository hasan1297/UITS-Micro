<?php

////   selecting user   ////
require 'partials/_user.php';

if($admin){
  $sql = "SELECT * FROM `basicinfoAd` WHERE `loginId` = '{$_SESSION['loginID']}'";
}
if($teacher){
  $sql = "SELECT * FROM `basicinfot` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
}
if($driver){
  $sql = "SELECT * FROM `basicinfod` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
}
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
}

echo '<script>0</script>
<!-- Header -->
      <header>
        <div class="top">
          <div class="top left"><img src="pic/bannerT.png" alt="" /></div>
          <div class="top right">
            <div class="top midR">';?>
              <?php echo $row['name']. "<br>"; ?>
              <?php echo $_SESSION['loginID']. "<br>"; ?>
              <?php echo '<a href="/Isp/partials/_logout.php"><strong>Log out</strong></a>
            </div>
            ';?>
  <?php 
  if($admin){
    $sql = "SELECT * FROM `picpostAd` WHERE `loginId` = '{$_SESSION['loginID']}'";
  }
  if($teacher){
    $sql = "SELECT * FROM `picpost` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
  }
  if($driver){
    $sql = "SELECT * FROM `picpostd` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
  }
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    if($row["photo"] == "nn"){
      echo '<img src="uploads/avaterT.png" height="91px" width="91px" style="margin-left:10px;"/>';?><?php
    }
    else{
      echo '<img src="uploads/';?><?php echo $row['photo'];?><?php echo '" height="91px" width="91px" style="margin-left:10px;"/>';?><?php
    }
  }
      echo'</div>
        </div>
        <nav class="navbar">
          <ul>
            <li><a class="color ah" href="/isp/Home.php">Home</a></li>';
    if($driver){
      echo '<li><a class="color ne" href="/isp/passengerNoon.php">Passenger</a></li>';
      echo '<li><a class="color" href="/isp/MyAccount.php">My Account</a></li>';
    }
    if($teacher){
      echo '<li><a class="color" href="/isp/MicroInfo.php">Microbus Info</a></li>
            <li><a class="color" href="/isp/BookMicro.php">Book Micro</a></li>
            <li><a class="color" href="/isp/MyAccount.php">My Account</a></li>';
    }
    if($admin){
      echo '<li><a class="color at" href="/isp/adTdata.php">Teacher</a></li>
            <li><a class="color ad" href="/isp/adDdata.php">Driver</a></li>
            <li><a class="color ada" href="/isp/adTAccount.php">Accounts</a></li>';
    }
      echo '<li><a class="color mi" href="/isp/myinfo.php">My Profile</a></li>
          </ul>
        </nav>
      </header>';

?>
