<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $shift = $_POST['shift'];
    $religion = $_POST['religion'];
    $mobile = $_POST['mobile'];
    $busNo = $_POST['busNo'];
    $root = $_POST['root'];

    $sql = "INSERT INTO `dlogin` (`loginIdD`, `busNo`, `password`, `dt`) VALUES (NULL, '$busNo', '1234', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM `dlogin` WHERE `dt` = current_timestamp()";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
        $id = $row['loginIdD'];
        }
      }
      else{
        echo "Error! Reload page and try after some time <br>";
      }
  
    $sql = "INSERT INTO `basicinfod` (`sn`, `loginIdD`, `name`, `DoB`, `BG`, `gender`, `MS`, `religion`, `nationality`, `nid`) VALUES (NULL, '$id', '$name', NULL, '-Select-', '$gender', '-Select-', '$religion', 'Bangladesh', '')";
    $result = mysqli_query($conn, $sql);
    $sql = "INSERT INTO `dcontactinfo` (`sn`, `loginIdD`, `mobile`, `email`, `Amobile`, `Aemail`) VALUES (NULL, '$id', '$mobile', '', '', '')";
    $result = mysqli_query($conn, $sql);
    $sql = "INSERT INTO `picpostd` (`sn`, `loginIdD`, `photo`, `name`, `busNo`, `shift`, `mobile`, `email`, `degree1`, `degree2`, `degree3`, `degree4`, `degree5`) VALUES (NULL, '$id', 'nn', '$name', '$busNo', '', '$mobile', '', '', '', '', '', '')";
    $result = mysqli_query($conn, $sql);

    if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your DataBase has been Updated.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Try again later.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }

    echo $name;
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
    <link rel="stylesheet" href="CSS/infoEntry.css" />


    <title>Home</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- Inner Navigation Bar -->
    <nav class="Pnavbar mb-5">
      <ul>
        <li><a class="active" href="adDdata.php">Data Entry</a></li>
        <li><a href="adDBasicTable.php">Basic</a></li>
        <li><a href="adDContactTable.php">Contact</a></li>
        <li><a href="adDPost&EducationTable.php">Post &amp; Education</a></li>
        <li><a href="adDLoginTable.php">Password</a></li>
      </ul>
    </nav>

    <!-- body -->
    <div class="body" style="max-width: 1200px;">
      <form action="" method="post">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
          </div>
        </div>
        <div class="form-group row">
          <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
          <div class="col-sm-10">
            <select
              type="select"
              name="gender"
              class="form-control"
              id="gender"
            >
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="religion" class="col-sm-2 col-form-label">Religion:</label>
          <div class="col-sm-10">
            <select
              type="select"
              name="religion"
              class="form-control"
              id="religion"
            >
              <option value="Islam">Islam</option>
              <option value="Hinduism">Hinduism</option>
              <option value="Christianity">Christianity</option>
              <option value="Buddhism">Buddhism</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="DayEvening" class="col-sm-2 col-form-label">Shift:</label>
          <div class="col-sm-10">
            <select
              type="select"
              name="shift"
              class="form-control"
              id="DayEvening"
            >
              <option value="Day">Day</option>
              <option value="Evening">Evening</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="mobile" class="col-sm-2 col-form-label">Mobile:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="mobile" name="mobile">
          </div>
        </div>
        <div class="form-group row">
          <label for="busNo" class="col-sm-2 col-form-label">Bus No:</label>
          <div class="col-sm-10">
            <input type="number" min="1" class="form-control" id="busNo" name="busNo">
          </div>
        </div>
        <div class="form-group row">
          <label for="root" class="col-sm-2 col-form-label">Root:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="root" name="root">
          </div>
        </div>
        <div>
          <input
            type="submit"
            name="submit"
            class="btn"
            id="submit"
            value="Save"
            onclick="return confirm('Are you sure?');"
            style="float:right; margin-right:7px; margin-top:7px; background-color: rgba(44, 19, 225, 0.91); color: white;" 
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