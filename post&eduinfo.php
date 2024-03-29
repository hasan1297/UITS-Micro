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

    // $loginID = mysqli_real_escape_string($conn, $_POST['{$_SESSION['loggedin']}']);
    // $photo = mysqli_real_escape_string($conn, $_POST['photo']);
    if($teacher){
      $dept = mysqli_real_escape_string($conn, $_POST['dept']);
      $post = mysqli_real_escape_string($conn, $_POST['post']);
    }
    $degree1 = mysqli_real_escape_string($conn, $_POST['degree1']);
    $degree2 = mysqli_real_escape_string($conn, $_POST['degree2']);
    $degree3 = mysqli_real_escape_string($conn, $_POST['degree3']);
    $degree4 = mysqli_real_escape_string($conn, $_POST['degree4']);
    $degree5 = mysqli_real_escape_string($conn, $_POST['degree5']);
    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";

    if(isset($_FILES['photo'])){
      $photo_name = $_FILES['photo']['name'];
      $photo_tmp_name = $_FILES['photo']['tmp_name'];
      $photo_size = $_FILES['photo']['size'];
      $photo_new_name = rand() . $photo_name;
      
      if($photo_size > 5242880){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> photo is very big! Maximum size is 5MB.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      else{
        if(!empty($photo_name)){ //new image
          if($teacher){
          $sql = "UPDATE `picpost` SET `photo` = '$photo_new_name', `dept` = '$dept', `post` = '$post', `degree1` = '$degree1', `degree2` = '$degree2', `degree3` = '$degree3', `degree4` = '$degree4', `degree5` = '$degree5' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
          }
          if($driver){
          $sql = "UPDATE `picpostd` SET `photo` = '$photo_new_name', `degree1` = '$degree1', `degree2` = '$degree2', `degree3` = '$degree3', `degree4` = '$degree4', `degree5` = '$degree5' WHERE `picpostd`.`loginIdD` = '{$_SESSION['loginID']}' ";
          }
          $result = mysqli_query($conn, $sql);
          if($result){
            $showAlert = true;
            move_uploaded_file($photo_tmp_name, "uploads/" . $photo_new_name);
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
        else{ //no image
          if($admin){
          $sql = "UPDATE `picpostAd` SET `dept` = '$dept', `post` = '$post', `degree1` = '$degree1', `degree2` = '$degree2', `degree3` = '$degree3', `degree4` = '$degree4', `degree5` = '$degree5' WHERE `picpostAd`.`loginId` = '{$_SESSION['loginID']}' ";
          }
          if($teacher){
          $sql = "UPDATE `picpost` SET `dept` = '$dept', `post` = '$post', `degree1` = '$degree1', `degree2` = '$degree2', `degree3` = '$degree3', `degree4` = '$degree4', `degree5` = '$degree5' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
          }
          if($driver){
          $sql = "UPDATE `picpostd` SET `degree1` = '$degree1', `degree2` = '$degree2', `degree3` = '$degree3', `degree4` = '$degree4', `degree5` = '$degree5' WHERE `picpostd`.`loginIdD` = '{$_SESSION['loginID']}' ";
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
      }
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

    <title>My profile</title>
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
        <li><a class="active" href="post&eduinfo.php">Post &amp; Educational Info</a></li>
        <li><a href="passwordChangeByUser.php">Password Change (self)</a></li>
      </ul>
    </nav>
    
    <!-- Body Content -->
    <div class="body" style="max-width: 1200px;">
      <!-- Left Side Form -->
      <form action="" method="post" enctype ="multipart/form-data" style="min-width: 1060px;">
        <?php
        if($teacher){
          $sql = "SELECT * FROM `picpost` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
        }
        if($driver){
          $sql = "SELECT * FROM `picpostd` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
        }
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
              ?>
            <div class="Lcol2">
              <h5 class="h5">Picture & Post:</h5>
              <div class="form-group2">
                <label for="photo"><span style="color: black"><b>Photo:</b></span></label><br>
                <img src="uploads/<?php echo $row['photo'];?>" width="150px" height="auto" alt="">
                <input type="file" accept="image/*" name="photo" class="form-control" id="photo" value="<?php echo $row['photo']; ?>"/>
              </div>
              <div>
                <label for="name"><span style="color: black"><b>Name:</b></span> </label>
              <?php echo $row['name']. "<br>"; ?>
              </div>
      <?php
        if($teacher){
          echo'<div class="form-group">
                <label for="dept"><span style="color: black"><b>Post:</b></span></label>
                <input type="text" name="post" class="form-control" id="post" value="'?><?php echo $row["post"]; ?><?php echo '"/>
              </div>
              <div class="form-group">
                <label for="dept"><span style="color: black"><b>Dept:</b></span></label>
                <input type="text" name="dept" class="form-control" id="dept" value="'?><?php echo $row["dept"]; ?><?php echo '"/>
              </div>';
        }
      ?>
      <?php
        if($driver){
        echo '<div>
                <label for="busNo"><span style="color: black"><b>Bus No:</b></span> </label>'?><?php echo $row["busNo"]; ?><?php echo '
              </div>
              <div>
                <label for="Shift"><span style="color: black"><b>Shift:</b></span> </label>'?><?php echo $row["shift"]; ?><?php echo '
              </div>';
        }
      ?>
              <div>
                <label for="mobile"><span style="color: black"><b>Mobile:</b></span> </label>
              <?php echo $row['mobile']. "<br>"; ?>
              </div>
              <div>
                <label for="email"><span style="color: black"><b>Email:</b></span> </label>
              <?php echo $row['email']. "<br>"; ?>
              </div>
            </div>

            <!-- Right Side Form -->
            <div class="Rcol2">
              <h5 class="h5">Educational Information:</h5>
              <h6 class="h6 mb-3" style="color: lightgrey;">(From top degree to lower one)</h6>
              <div class="degree-group">
                <input type="text" name="degree1" class="form-control" placeholder=" Top degree" value="<?php echo $row['degree1']; ?>"/>
              </div>
              <div class="degree-group">
                <input type="text" name="degree2" class="form-control" placeholder="2nd top degree" value="<?php echo $row['degree2']; ?>"/>
              </div>
              <div class="degree-group">
                <input type="text" name="degree3" class="form-control" placeholder="3rd top degree" value="<?php echo $row['degree3']; ?>"/>
              </div>
              <div class="degree-group">
                <input type="text" name="degree4" class="form-control" placeholder="4th top degree" value="<?php echo $row['degree4']; ?>"/>
              </div>
              <div class="degree-group">
                <input type="text" name="degree5" class="form-control" placeholder="5th top degree" value="<?php echo $row['degree5']; ?>"/>
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
                  style="float:right; margin-right:7px; margin-top:7px;" 
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