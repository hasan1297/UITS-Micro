<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage2.php");
  exit;
}
?>

<?php

  ////    selecting user    ////
  require 'partials/_user.php';

  $showAlert = false;
  if(isset($_POST['submit'])){

    // $loginID = mysqli_real_escape_string($conn, $_POST['{$_SESSION['loggedin']}']);
    //$photo = mysqli_real_escape_string($conn, $_POST['photo']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
        $sql = "UPDATE `picpost` SET `dept` = '$dept', `post` = '$post' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
        $result = mysqli_query($conn, $sql);
        if($result){
          $showAlert = true;
        }

    if(isset($_FILES['photo'])){
      $photo_name = $_FILES['photo']['name'];
      $photo_tmp_name = $_FILES['photo']['tmp_name'];
      $photo_size = $_FILES['photo']['size'];
      $photo_new_name = $rand() . $photo_name;
      
      if($photo_size > 5242880){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> photo is very big! Maximum size is 5MB.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      else{
        $sql = "UPDATE `picpost` SET `photo` = '$photo_new_name', `dept` = '$dept', `post` = '$post' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
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
    <link rel="stylesheet" href="CSS/MyProfileT/MyInfoT.css" />
    <link rel="stylesheet" href="CSS/MyProfileT/BasicInfoT.css" />

    <title>My Info</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <nav class="Pnavbar">
      <ul>
        <li><a href="myinfoBT.php">Basic Information</a></li>
        <!-- <li><a href="T_familyinfo.php">Family Information</a></li> -->
        <li><a href="T_contactinfo.php">Contact Information</a></li>
        <li><a class="active" href="T_post&eduinfo.php">Post &amp; Educational Info</a></li>
      </ul>
    </nav>

        <!-- Body Content -->
    <div class="body">
      <!-- <h5 class="h5">Basic Information</h5> -->
      <!-- Left Side Form -->
      <form action="" method="post">
        <?php
          $sql = "SELECT * FROM `picpost` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        ?>
            <div class="Lcol">
              <div>
                <label for="photo">Photo</label>
                <input type="file" accept="image/*" name="photo" class="form-control" id="photo"/>
              </div>
              <!-- <img src="uploads/<?php //echo $row['photo'];?>" width="150px" height="auto" alt=""> -->
              <!-- <div>
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name"  value="<?php //echo $row['name']; ?>"/>
              </div> -->
              <div>
                <label for="post">Post</label>
                <input type="text" name="post" class="form-control" id="post"/>
              </div>
              <div>
                <label for="dept">Dept</label>
                <input type="text" name="dept" class="form-control" id="dept"/>
              </div>
              <!-- <div>
                <label for="email">Mobile</label>
                <input type="text" name="email" class="form-control" id="email" value="<?php //echo $row['email']; ?>"/>
              </div>
              <div>
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php //echo $row['email']; ?>"/>
              </div> -->
            </div>

            <!-- Right Side Form -->
            <!-- <div class="Rcol">
              <h5 class="h5">Educational Information:</h5>
              <h6 class="h5 mb-3" style="color: lightgrey;">(From top degree to lower one)</h6>
              <div>
                <input type="text" name="degree1" class="form-control" ivalue="<?php //echo $row['Amobile']; ?>"/>
              </div>
              <div>
                <input type="text" name="degree2" class="form-control" value="<?php //echo $row['Aemail']; ?>"/>
              </div>
              <div>
                <input type="text" name="degree3" class="form-control" value="<?php //echo $row['Aemail']; ?>"/>
              </div>
              <div>
                <input type="text" name="degree4" class="form-control" value="<?php //echo $row['Aemail']; ?>"/>
              </div>
              <div>
                <input type="text" name="degree5" class="form-control" value="<?php //echo $row['Aemail']; ?>"/>
              </div> -->

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
            <!-- </div> -->
      </form>
    </div>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>