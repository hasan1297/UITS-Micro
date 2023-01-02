<?php

$FDofTmonth = date('Y-m-01'); // hard-coded '01' for first day
// $LDofTmonth  = date('Y-m-t'); // for last day of the month
$LDofTmonth  = date('Y-m-d');

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['select'])){
      $FDofTmonth = $_POST['FDofTmonth'];
      $LDofTmonth = $_POST['LDofTmonth'];
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
    <link rel="stylesheet" href="CSS/myAccount.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">    
    
    <title>My Account</title>
  </head>
  <body>
    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <div class="body" style="max-width: 1200px;">
      <div class="Lcol">
        <div class="container my-4">
          <form action="" method="post">
            <h5 class="mb-3">Specify date yourself:</h5>
            <div class="date">
              <div>
                <label for="FDofTmonth" class="h6 mb-2">Starting date:</label>
                <input
                type="date"
                name="FDofTmonth"
                class="form-control"
                id="FDofTmonth"
                required
                >
              </div>
              <div>
                <label for="LDofTmonth" class="h6 mb-2">Ending date:</label>
                <input
                type="date"
                name="LDofTmonth"
                class="form-control"
                id="LDofTmonth"
                value="<?php echo date('Y-m-d'); ?>"
                >
              </div>
            </div>
            <div>
              <input type="submit" name="select" class="btnSub" id="submitT" value="Select" style = "margin-top:15px; margin-right:20px;"/>
            </div>
          </form>
        </div>
      </div>
      <div class="Mcol">
        <form action="" method="post">
          <div style="max-width: 900px;">
            <div class="container my-4">
              <h5 class="h5 mb-3">All my passengers in this month:</h5>
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th >SN.</th>
                    <th>Name</th>
                    <th>Dept</th>
                    <th>Time</th>
                    <th>Number</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- php MySQL query -->
                  <?php
                    $sql = "SELECT * FROM `bookmicro` WHERE `loginIdD` = '{$_SESSION['loginID']}' AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth'";
                    $result = mysqli_query($conn,$sql);
                    $sn = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $sn = $sn + 1;
                      echo "<tr>
                              <th scope='row'>". $sn. "</th>
                              <td>". $row['name']. "</td>
                              <td>". $row['dept']. "</td>
                              <td>". $row['time']. "</td>
                              <td>". $row['mobile']. "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
      <div class="Rcol">
        <div class="container my-4">
          <!-- php MySQL query -->
          <h5 class="h5 mb-3">Summary:</h5>
          <?php
            //// Summary
            // Total passenger
            $sql = "SELECT * FROM `bookmicro` WHERE `loginIdD` = '{$_SESSION['loginID']}' AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            echo '<b>Total Passenger:<span style="color: red">'.$num.'</span></b><br>';
            // Total Trip
            $sql = "SELECT * FROM `counter` WHERE `loginIdD` = {$_SESSION['loginID']} AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth' ";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            echo '<b>Total Trip:<span style="color: red">'.$num.'</span></b><br>';
            // Total Trip at Noon
            $sql = "SELECT * FROM `counter` WHERE `loginIdD` = {$_SESSION['loginID']} AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth' AND `time` = 'Noon' ";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            echo '<b>Total Trip at Noon:<span style="color: red">'.$num.'</span></b><br>';
            // Total Trip at Evening
            $sql = "SELECT * FROM `counter` WHERE `loginIdD` = {$_SESSION['loginID']} AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth' AND `time` = 'Evening' ";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            echo '<b>Total Trip at Evening:<span style="color: red">'.$num.'</span></b><br>';

          ?>
        </div>
      </div>

    </div>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      } );
    </script>
    
  </body>
  
  </html>