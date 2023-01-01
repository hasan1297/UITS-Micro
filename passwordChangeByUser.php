<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>

<?php
  ////    selecting user    ////
  require 'partials/_user.php';

  $showAlert = false;
  $NotSame = false;
  $Error = false;
  $Error2 = false;
  $WrongPassword = false;
  if(isset($_POST['submit'])){
    $CurrentPassword = $_POST['CurrentPassword'];
    $NewPassword = $_POST['NewPassword'];
    $NewPasswordRetype = $_POST['NewPasswordRetype'];

    if($teacher){
      $sql = "SELECT * FROM `tlogin` WHERE `loginIdT` = '{$_SESSION['loginID']}' ";
    }
    if($driver){
      $sql = "SELECT * FROM `dlogin` WHERE `loginIdD` = '{$_SESSION['loginID']}' ";
    }
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
        $password = $row['password'];
      }
        if($CurrentPassword == $password){
          if($NewPassword == $NewPasswordRetype){
            if($teacher){
              $sql = "UPDATE `tlogin` SET `password` = '$NewPassword' WHERE `tlogin`.`loginIdT` = '{$_SESSION['loginID']}' ";
            }
            if($driver){
              $sql = "UPDATE `dlogin` SET `password` = '$NewPassword' WHERE `dlogin`.`loginIdD` = '{$_SESSION['loginID']}' ";
            }
            $result = mysqli_query($conn, $sql);
            if($result){
              $showAlert = true;
            }
            else{
              $Error2 = true;
            }
          }
          else{
            $NotSame = true;
          }
        }
        else{
          $WrongPassword = true;
        }
      
    }
    else{
      $Error = true;
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="CSS/homet2.css" />
    <link rel="stylesheet" href="CSS/MyProfileNav.css" />
    <link rel="stylesheet" href="CSS/password.css" />

    <title>Password Change (Self)</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <nav class="Pnavbar mb-3">
      <ul>
        <li><a href="myinfo.php">Basic Information</a></li>
        <li><a href="contactinfo.php">Contact Information</a></li>
        <li><a href="post&eduinfo.php">Post &amp; Educational Info</a></li>
        <li><a class="active" href="passwordChangeByUser.php">Password Change (self)</a></li>
      </ul>
    </nav>

    <!-- body -->
    <div class="body" style="max-width: 600px;">

      <?php
        if($showAlert){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Password have been Updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        if($NotSame){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> New Password and Retype must be Same!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        if($Error){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please logout then login again!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        if($Error2){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please try again after some time!!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        if($WrongPassword){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Your given password does not match with the one in database! Check your old password again!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
      ?>

      <form action="" method="post" style="max-width: 400px; margin-left: auto; margin-right: auto;">
        <h5 class="h5">Password Change (User):</h5>
        <div class="form-group">
          <span style="color: Red">Password must contain eight(8) digits</span>
        </div>
        <div class="form-group">
          <label for="CurrentPassword">Current(Password):</label>
          <input type="password" name="CurrentPassword" class="form-control" id="CurrentPassword" value=""/>
        </div>
        <div class="form-group">
          <label for="NewPassword">Type(New Password):</label>
          <input type="password" name="NewPassword" class="form-control" id="NewPassword" minlength="8" value=""/>
        </div>
        <div class="form-group">
          <label for="NewPasswordRetype">Retype(Password):</label>
          <input type="password" name="NewPasswordRetype" class="form-control" id="NewPasswordRetype" minlength="8" value=""/>
        </div>

        <div>
          <input
            type="submit"
            name="submit"
            class="btn"
            id="submit"
            value="Save"
            style="float:right; margin-right:7px; margin-top:7px;" 
          />
        </div>
      </form>
    </div>
    <!-- css first -->
    <script>0</script>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>