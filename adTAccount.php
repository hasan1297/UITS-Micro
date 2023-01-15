<?php

$FDofTmonth = date('Y-m-01'); // hard-coded '01' for first day
// $LDofTmonth  = date('Y-m-t'); // for last day of the month
$LDofTmonth  = date('Y-m-d');
$ID = "00";

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
      $ID = $_POST['ID'];
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
    <link rel="stylesheet" href="CSS/MyProfileNav.css" />
    <link rel="stylesheet" href="CSS/infoEntry.css" />
    <link rel="stylesheet" href="CSS/adAccount.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <style>
      .Pnavbar {
        max-width:440px; 
        min-width: 440px;
        border-radius: 9px; 
        justify-content: center;
      }
      .Pnavbar li a {
        padding-right: 54px; 
        padding-left: 54px;
      }
      .Pnavbar li a:hover {
        background-color: rgb(202, 201, 201);
        border-radius: 0px 9px 9px 0px !important;
      }
      .Pnavbar li a.active {
        background-color: #963fbd;
        color: azure;
        border-radius: 9px 0px 0px 9px !important;
      }
      .ada {
        background-color: #575050;
        color: #ffffff !important;
      }
    </style>

    <title>Home</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- Inner NavBar -->
    <nav class="Pnavbar mb-5">
      <ul>
        <li><a class="active" href="adTAccount.php">Teacher's Account</a></li>
        <li><a href="adDAccount.php">Driver's Account</a></li>
      </ul>
    </nav>

    <!-- body -->

    <div class="body" style="max-width: 1600px; min-width: 1600px; flex-direction: row;">

    <div class="Lcol">
      <div class="container my-4">
        <form action="" method="post">
          <div>
            <label for="ID"><h5 class="mb-3">Specify ID:<span style="color: red"> *</span></h5> </label>
            <input type="text" name="ID" class="form-control" id="ID" min-length="10" maxlength="10" required value="19145510" style="width: 43.5%;"/>
          </div>
          <div>
            <h5 class="mb-3 mt-3">Specify Date:<span style="color: red"> *</span></h5>
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
          </div>
          <div>
            <input type="submit" name="select" class="btnSub" id="submitT" value="Select" style = "margin-top:15px; margin-right:20px;"/>
          </div>
        </form>
      </div>
    </div>

      <!-- Table -->
      <div class="Mcol">
        <div style="max-width: 900px;">
          <div class="container my-4">
            <h5 class="h5 mb-3">BookMicro Table:</h5>
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">SN.</th>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Bus No</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                </tr>
              </thead>
              <tbody>
                <!-- php MySQL query -->
                <?php
                  $sql = "SELECT * FROM `bookmicro`";
                  $result = mysqli_query($conn,$sql);
                  $sn = 0;
                  while($row = mysqli_fetch_assoc($result)){
                    $sn = $sn + 1;
                    echo "<tr>
                            <th scope='row'>". $sn. "</th>
                            <td>". $row['loginIdT']. "</td>
                            <td>". $row['name']. "</td>
                            <td>". $row['busNo']. "</td>
                            <td>". $row['date']. "</td>
                            <td>". $row['time']. "</td>
                            </tr>";
                          }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="Rcol">
        <div class="container my-4">
          <!-- php MySQL query -->
          <h5 class="h5 mb-3">Summary for ID <span style="color: red"><?php if($ID=='00'){echo"";}else{echo $ID;} ?></span> :</h5>
          <?php
            //// Summary
            // Checking ID's existance
            $sql = "SELECT * FROM `tlogin` WHERE `loginIdT` = $ID";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num > 0){

              // Total trip
              $sql = "SELECT * FROM `bookmicro` WHERE `loginIdT` = $ID AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth'";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
              echo '<b>Total Trip:<span style="color: red">'.$num.'</span></b><br>';

              // Total Trip at Noon
              $sql = "SELECT * FROM `bookmicro` WHERE `loginIdT` = $ID AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth' AND `time` = 'Noon' ";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
              echo '<b>Total Trip at Noon:<span style="color: red">'.$num.'</span></b><br>';

              // Total Trip at Evening
              $sql = "SELECT * FROM `bookmicro` WHERE `loginIdT` = $ID AND `date` BETWEEN '$FDofTmonth' AND '$LDofTmonth' AND `time` = 'Evening' ";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
              echo '<b>Total Trip at Evening:<span style="color: red">'.$num.'</span></b><br>';

            }
            if($num == 0){
              if($ID!='00'){
              echo '<b><span style="color: red"> There is no matching ID in The DataBase! Check the TABLE in the middle for existing ID !!! </span></b>';
              }
              if($num == '00'){
              echo '<b>Total Trip:<span style="color: red">'.$num.'</span></b><br>';
              echo '<b>Total Trip at Noon:<span style="color: red">'.$num.'</span></b><br>';
              echo '<b>Total Trip at Evening:<span style="color: red">'.$num.'</span></b><br>';
              }
            }

          ?>
        </div>
      </div>

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
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable();
      });
    </script>

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