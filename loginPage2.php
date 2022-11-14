<?php

// $login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/_dbconnect.php';
  $LoginId = $_POST['loginID'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `login` WHERE `loginId` = '$LoginId'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    while($row = mysqli_fetch_assoc($result)){
      if ($password == $row['password']){
        // $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['loginID'] = $LoginId;
        $_SESSION['name'] = $name;
        header("location: MyInfo.php");
      }
      else{
      $showError = "Invalid credentials."; 
      }
    }
  }
  elseif($num == 0){
    $sql = "SELECT * FROM `tlogin` WHERE `loginIdT` = '$LoginId'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
        if ($password == $row['password']){
          $name = $row['name'];
          // $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['loginID'] = $LoginId;
          $_SESSION['name'] = $name;
          header("location: myInfoBT.php");
        }
        else{
          $showError = "Invalid credentials."; 
        }
      }
    }
    elseif($num == 0){
      $sql = "SELECT * FROM `dlogin` WHERE `loginIdD` = '$LoginId'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
          if ($password == $row['password']){
            // $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['loginID'] = $LoginId;
            $_SESSION['busNo'] = $row['busNo'];
            $_SESSION['shift'] = $row['shift'];
            header("location: myInfoBT.php");
          }
          else{
          $showError = "Invalid credentials."; 
          }
        }
      }
      else{
          $showError = "Invalid credentials."; 
      } 
    } 
    else{
        $showError = "Invalid credentials."; 
    } 
  }   
  else{
      $showError = "Invalid credentials."; 
  }   
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="CSS/loginPage2.css" />

    <title>UITS Micro login</title>
  </head>
  <body>
    <?php
      if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showError.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      }
    ?>
  <div class="container">
    <form action="/ISP/loginPage2.php" method="post" style="width:100%;">
      <div class="form-group img">
        <img src="pic/uitsLogoT.png" alt="" width="140" height="165" />
      </div>
      <div class="form-group">
        <label for="loginID">Login ID</label>
        <input type="text" class="form-control" id="loginID" name="loginID" placeholder="Login ID">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="10">
      </div>
      <!-- <div class="form-group form-check rm">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <button type="submit" class="btn btn-primary button">Log In</button>
      <div class="kk">
        <p class="kk mt-5 mb-3 text-muted">
          Copyright © 2022 <br />
          Powered by Badhan Consultants Ltd. <br />All rights reserved.
        </p>
      </div>
    </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>