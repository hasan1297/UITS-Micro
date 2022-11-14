<?php

////   selecting user   ////
require 'partials/_user.php';

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
            <img src="pic/avaterT.png" height="91px" width="91px" style="margin-left:10px;"/>
          </div>
        </div>
        <nav class="navbar">
          <ul>
            <li><a href="/isp/Home.php">Home</a></li>';
    if($driver){
      echo '<li><a href="/isp/passenger.php">Passenger</a></li>';
    }
    if($teacher){
      echo '<li><a href="/isp/MicroInfo.php">Micro Info</a></li>
            <li><a href="/isp/BookMicro.php">Book Micro</a></li>';
    }
      echo '<li><a href="/isp/myinfoBT.php">My Profile</a></li>
            <!-- <li><a href="/Isp/logout.php">Log out</a></li> -->
          </ul>
        </nav>
      </header>';


?>