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
  if(isset($_POST['submit'])){

    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $Amobile = mysqli_real_escape_string($conn, $_POST['Amobile']);
    $Aemail = mysqli_real_escape_string($conn, $_POST['Aemail']);

    if($admin){
      $sql = "UPDATE `picpostAd` SET `mobile` = '$mobile', `email` = '$email' WHERE `picpostAd`.`loginId` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `contactinfoAd` SET `mobile` = '$mobile', `email` = '$email', `Amobile` = '$Amobile', `Aemail` = '$Aemail' WHERE `contactinfoAd`.`loginId` = '{$_SESSION['loginID']}' ";
    }
    if($teacher){
      $sql = "UPDATE `picpost` SET `mobile` = '$mobile', `email` = '$email' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `tcontactinfo` SET `mobile` = '$mobile', `email` = '$email', `Amobile` = '$Amobile', `Aemail` = '$Aemail' WHERE `tcontactinfo`.`loginIdT` = '{$_SESSION['loginID']}' ";
    }
    if($driver){
      $sql = "UPDATE `picpostd` SET `mobile` = '$mobile', `email` = '$email' WHERE `picpostd`.`loginIdD` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `microinfo` SET `mobile` = '$mobile' WHERE `microinfo`.`loginIdD` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `dcontactinfo` SET `mobile` = '$mobile', `email` = '$email', `Amobile` = '$Amobile', `Aemail` = '$Aemail' WHERE `dcontactinfo`.`loginIdD` = '{$_SESSION['loginID']}' ";
    }
    $result = mysqli_query($conn, $sql);
    if($result){
      $showAlert = true;
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Try again later.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
  }
?>
<?php
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your Profile have been Updated.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
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
    <link rel="stylesheet" href="CSS/MyProfileBody.css" />

    <style>
      .mi {
        background-color: #575050;
        color: #ffffff !important;
      }
    </style>

    <title>My Info</title>
  </head>
  <body>
    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <nav class="Pnavbar mb-5">
      <ul>
        <li><a href="myinfo.php">Basic Information</a></li>
        <li><a class="active" href="contactinfo.php">Contact Information</a></li>
        <li><a href="post&eduinfo.php">Post &amp; Educational Info</a></li>
        <li><a href="passwordChangeByUser.php">Password Change (self)</a></li>
      </ul>
    </nav>

    <!-- Body Content -->
    <div class="body" style="max-width: 1200px;">
      <!-- <h5 class="h5">Basic Information</h5> -->
      <!-- Left Side Form -->
      <form action="" method="post">
        <?php
          if($admin){
            $sql = "SELECT * FROM `contactinfoAd` WHERE `loginId` = '{$_SESSION['loginID']}'";
          }
          if($teacher){
            $sql = "SELECT * FROM `tcontactinfo` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
          }
          if($driver){
            $sql = "SELECT * FROM `dcontactinfo` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
          }
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        ?>
            <div class="Lcol mt-4">
              <div>
                <label for="mobile">Mobile <span style="color: red"> *</span></label>
                <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $row['mobile']; ?>"/>
              </div>
              <div>
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>"/>
              </div>
            </div>

            <!-- Right Side Form -->
            <div class="Rcol mt-4">
              <div>
                <label for="Amobile">Mobile (Alternative) </label>
                <input type="text" name="Amobile" class="form-control" id="Amobile" value="<?php echo $row['Amobile']; ?>"/>
              </div>
              <div>
                <label for="Aemail">Email (Alternative) </label>
                <input type="email" name="Aemail" class="form-control" id="Aemail" value="<?php echo $row['Aemail']; ?>"/>
              </div>

            <?php
            }
          }
              ?>
              
              <div>
                <input
                  type="submit"
                  name="submit"
                  class="btn"
                  id="submit"
                  value="Save"
                />
              </div>
            </div>
      </form>
    </div>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        let current_url = document.location;
        document.querySelectorAll(".navbar .color").forEach(function(e){
          if(e.href == current_url){
              e.classList += " current";
          }
        });
    </script>
    
  </body>
</html>