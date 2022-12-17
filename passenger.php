<?php

$submit = false;
$duplicate = false;
$date = date('Y-m-d');

$datetime = new DateTime( "now", new DateTimeZone( "Asia/Dhaka" ) );
if(((int) $datetime->format( 'H')) >= 14){
  echo 'yes';
}else{
  echo 'no';
}

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage2.php");
  exit;
}

?>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['select'])){
      $date = $_POST['date'];
    }
    if(isset($_POST['submit'])){
      // $time = $_POST['time'];
      $subDate = $_POST['subDate'];
      $sql = "SELECT * FROM `counter` WHERE `loginIdD` = '{$_SESSION['loginID']}' AND `date` = '$subDate' ";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if($num>0){
        $duplicate = true;
        // echo $date;
        // echo $subDate;
      }
      else{
        $sql = "INSERT INTO `counter` (`sn`, `loginIdD`, `date`, `done`) VALUES (NULL, '{$_SESSION['loginID']}', '$subDate', 'done'); ";
        $result = mysqli_query($conn, $sql);
        $submit = true;
        // echo $date;
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
    ?>
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
                    $sql = "SELECT * FROM `bookmicro` WHERE `busNo` = '{$_SESSION['busNo']}' AND `date` LIKE '$date' AND `time` LIKE '{$_SESSION['shift']}' ";
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
              <input type="submit" name="submit" class="btnS" id="submit" value="Done"/>
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