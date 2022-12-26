<?php

$submit = false;
$duplicate = false;
$WrongTime = false;
$WrongDate = false;

$date = date('Y-m-d');
//// checking if logged in or not
include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}

?>

<?php
  ////current date tracker
  $NowDate =  new DateTime( "now", new DateTimeZone( "Asia/Dhaka"));
  $NowDateInString = strtotime($NowDate->format( 'Y-m-d'));
  $FixedTimeInString = strtotime(' 12:00');  // Fixed time

?>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['select'])){
      $date = $_POST['date'];
    }
    if(isset($_POST['submit'])){
      //// Current time tracker
      $DriverGivenDate = $_POST['subDate'];
      $DriverGivenDateInString = strtotime($DriverGivenDate);
      $NowTimeInString = strtotime($NowDate->format(' H:i'));
      
      //// Compairing date
      if($DriverGivenDateInString == $NowDateInString){
        //// Compairing time
        if($NowTimeInString >= $FixedTimeInString){
          //// double submission check
          $sql = "SELECT * FROM `counter` WHERE `loginIdD` = '{$_SESSION['loginID']}' AND `date` = '$DriverGivenDate' AND `time` = 'Noon' ";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if($num>0){
            $duplicate = true;
          }
          else{
            $sql = "INSERT INTO `counter` (`sn`, `loginIdD`, `date`, `time`, `done`) VALUES (NULL, '{$_SESSION['loginID']}', '$DriverGivenDate', 'Noon', 'done'); ";
            $result = mysqli_query($conn, $sql);
            $submit = true;
          }
        }
        else{
          // echo 'not done <br>';
          $WrongTime = true;
        }
      }else{
        // echo 'not same <br>';
        $WrongDate = true;
      }
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
    <link rel="stylesheet" href="CSS/passenger.css" />
    <link rel="stylesheet" href="CSS/bookmicro.css" />
    <link rel="stylesheet" href="CSS/MyProfileNav.css" />
    
    <style>
      .Pnavbar {
        max-width:300px; 
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
    </style>

    <title>My passengers</title>
  </head>
  <body>
    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <?php
    if($submit){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You have submitted todays passenger list successfully!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    if($duplicate){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> You have already submitted todays passenger list!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    if($WrongDate){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> You can not submit this days passenger list!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    if($WrongTime){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> You are early. You have to submit after told time!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    ?>

    <nav class="Pnavbar mb-5">
      <ul>
        <li><a class="active" href="PassengerNoon.php">Noon</a></li>
        <li><a href="passengerEvening.php">Evening</a></li>
      </ul>
    </nav>

    <!-- Body Content -->
    <div class="body" style="max-width: 1200px;">
      <div class="Lcol">
        <div class="container my-4">
          <form action="" method="post">
            <label for="date" class="h5 mb-3">Select date:</label>
            <input
              type="date"
              name="date"
              class="form-control"
              id="date"
              value="<?php echo date('Y-m-d'); ?>"
              >
            <div>
              <input type="submit" name="select" class="btnS" id="submitT" value="Select" style = "margin-top:15px; margin-right:20px;"/>
            </div>
          </form>
        </div>
      </div>
      <div class="Rcol">
        <form action="" method="post">
          <div style="max-width: 900px;">
            <div class="container my-4">
              <h5 class="h5 mb-3">Your passengers for <?php echo $date?>:</h5>
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
                    $sql = "SELECT * FROM `bookmicro` WHERE `busNo` = '{$_SESSION['busNo']}' AND `date` LIKE '$date' AND `time` LIKE 'Noon' ";
                    $result = mysqli_query($conn,$sql);
                    // $num = mysqli_num_rows($result);
                    $sn = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $date = $row['date'];
                      // echo $subDate;
                      $sn = $sn + 1;
                      echo "<tr>
                      <th scope='row'>". $sn. "</th>
                      <td>". $row['name']. "</td>
                      <td>". $row['dept']. "</td>
                      <td>". $row['mobile']. "</td>
                      </tr>";
                    }
                  ?>
                  
                <!-- <input type="hidden" name="time"> -->
                <input type="hidden" name="subDate" value="<?php echo $date;?>">
                </tbody>
              </table>
              <input type="submit" name="submit" class="btnS" id="submit" value="Submit"/>
              <!-- onclick="return confirm('Do you really want to submit todays passenger list?\nYou can not resubmit!');" -->
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
      var now = new Date();
      var inputElementTime = document.getElementsByName("time")[0];
      inputElementTime.value = ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2);
    </script>
    
  </body>
  
  </html>