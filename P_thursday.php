<?php
$delete = false;

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage2.php");
  exit;
}
?>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['delete'])){
      $sql = "DELETE FROM `bookmicro` WHERE `busNo` = '{$_SESSION['busNo']}' AND `weekName` LIKE 'thursday' AND `time` LIKE '{$_SESSION['shift']}' ";
      $result = mysqli_query($conn, $sql);
      $delete = true;
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
    <link rel="stylesheet" href="CSS/MyProfileT/weekNav.css" />
    <link rel="stylesheet" href="CSS/passenger.css" />

    <title>My passengers</title>
  </head>
  <body>
    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <?php
    if($delete){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You have deleteded todays passenger list successfully!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    ?>

    <div class="week">
      <nav class="Pnavbar">
        <ul>
          <li><a href="passenger.php">Monday</a></li>
          <li><a href="P_tuesday.php">Tuesday</a></li>
          <li><a href="P_wednesday.php">Wednesday</a></li>
          <li><a class="active" href="P_thursday.php">Thursday</a></li>
          <li><a href="P_friday.php">Friday</a></li>
          <li><a href="P_saturday.php">Saturday</a></li>
          <li><a href="P_sunday.php">Sunday</a></li>
        </ul>
      </nav>
    </div>

    <form action="" method="post">
      <div class="body" style="max-width: 900px;">
        <div class="container my-4">
          <h5 class="h5 mb-3">Your passengers for the day:</h5>
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th >SN.</th>
                <th>Name</th>
                <th>Dept</th>
                <th>Number</th>
              </tr>
            </thead>
            <tbody>
              <!-- php MySQL query -->
              <?php
                $sql = "SELECT * FROM `bookmicro` WHERE `busNo` = '{$_SESSION['busNo']}' AND `weekName` LIKE 'thursday' AND `time` LIKE '{$_SESSION['shift']}' ";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                $sn = 0;
                while($row = mysqli_fetch_assoc($result)){
                  $sn = $sn + 1;
                  echo "<tr>
                          <th scope='row'>". $sn. "</th>
                          <td>". $row['name']. "</td>
                          <td>". $row['dept']. "</td>
                          <td>". $row['mobile']. "</td>
                        </tr>";
                }
              ?>
            </tbody>
          </table>
          <input type="submit" name="delete" class="btnS" id="submit" value="Delete" onclick="return confirm('Do you really want to delete todays passenger list?\nDeletion can not be reverted if you confirm!');"/>
        </div>
      </div>
    </form>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>

</html>