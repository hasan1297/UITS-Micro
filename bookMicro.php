<?php
$dublicate = false;
$noseat = false;
$booked = false;
$delete = false;

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>
<?php
if(isset($_GET['delete'])){
  $sn = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `bookmicro` WHERE `sn` = $sn";
  $result = mysqli_query($conn, $sql);
}
?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $busNo = $_POST['busNo'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    //// Finding Drivers ID with busNo
    $sql = "SELECT * FROM `dlogin` WHERE `busNo` = '$busNo'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)){
      $DriverID = $row['loginIdD'];
    }

    ////Checking if already booked or Not
    $sql = "SELECT * FROM `bookmicro` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
      while($row = mysqli_fetch_assoc($result)){
          if(($date == $row['date']) && ($time == $row['time'])){
            //// Already Booked
            $dublicate = true;
          }
      }
    }

    //// If Already Not Booked 
    if(!$dublicate){
      ////  checking if seat is available  ////
      $sql = "SELECT * FROM `bookmicro` WHERE `busNo` = '$busNo' AND `date` LIKE '$date' AND `time` LIKE '$time' ";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);

      if($num < 10){
        ////  book seat  ////
        $sql ="INSERT INTO `bookmicro` (`loginIdT`, `loginIdD`, `name`, `mobile`, `busNo`, `date`, `time`) VALUES ('{$_SESSION['loginID']}', '$DriverID', '$name', '$mobile', '$busNo', '$date', '$time')";
        $result = mysqli_query($conn, $sql);
        $booked = true;
      }
      else{
        //// No  seat
        $noseat = true;  
      }   
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/homet2.css" />
    <link rel="stylesheet" href="CSS/bookmicro.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <title>Book Micro</title>
  </head>

  <body>
    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- alerts -->
    <div class="alert" style="max-width: 1100px;">
      <?php
        if($noseat){
          echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  <strong>Error!</strong> No seat left in the Micro on this day and time. Please choose another day or time!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
        if($booked){
          echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  <strong>Success!</strong> Your seat have been booked.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
        if($dublicate){
          echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  <strong>Error!</strong> You have already booked on this day.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
        if($delete){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your booking has been deleteded successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
        ?>
    </div>
    
    <!-- Body Content -->
    <div class="body" style="max-width: 1200px;">
      <div class="Lcol">
        <form action="/isp/bookMicro.php" method="post">
          <h5 class="h5 mb-3">Book your seat:</h5>
          <h6><span style="color: red">Booking cancelation must be done atleast 1 hour before departure !!!</span></h6>
          <?php
            $sql = "SELECT * FROM `basicinfot` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
    echo '<div>
            <input type="hidden" name="name" class="form-control" id="name" value="';?><?php echo $row['name']; ?> <?php echo '"/>
          </div>';
              }
            }
            $sql = "SELECT * FROM `tcontactinfo` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
    echo '<div>
            <input type="hidden" name="mobile" class="form-control" id="name" value="';?><?php echo $row['mobile']; ?> <?php echo '"/>
          </div>';
              }
            }
          ?>
          <div class="form-group mt-4">
            <label for="busNo"><b>Select Micro number:</b></label>
            <select type="select" name="busNo" class="form-control" id="busNo">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="form-group">
            <label for="time"><b>Select time:</b></label>
            <select type="select" name="time" class="form-control" id="time">
              <option selected value="Noon">Noon</option>
              <option value="Evening">Evening</option>
            </select>
          </div>
          <div class="form-group">
            <label for="date"><b>Select date:</b></label>
            <input
              type="date"
              name="date"
              class="form-control"
              id="date"
              required>
          </div>
          <div>
            <input type="submit" name="submitT" class="btnS" id="submitT" value="Submit" />
          </div>
        </form>
      </div>



      <!-- Right Side Form -->
      <div class="Rcol">
        <h5 class="h5 mb-3">Seat you booked:</h5>
        <div class="container my-4">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th scope="col">SN.</th>
                <th scope="col">Bus No</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- php MySQL query -->
              <?php
                $sql = "SELECT * FROM `bookmicro` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
                $result = mysqli_query($conn,$sql);
                // $num = mysqli_num_rows($result);
                $sn = 0;
                while($row = mysqli_fetch_assoc($result)){
                  $sn = $sn + 1;
                  echo "<tr>
                          <td>". $sn. "</td>
                          <td>". $row['busNo']. "</td>
                          <td>". $row['date']. "</td>
                          <td>". $row['time']. "</td>
                          <td><button class='delete btn btn-sm btn-primary' id=d". $row['sn'].">Delete</button></td>
                          </tr>";
                        }
              ?>
            </tbody>
          </table>
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
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable();
      });
    </script>
    <script>
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click", (e) => {
          console.log("edit ");
          sn = e.target.id.substr(1);
          if(confirm("Are you sure you want to remove this booking!")){
            console.log("yes");
            window.location = `/isp/bookMicro.php?delete=${sn}`;
            //Creat a form and use post method to submit a form
          }
          else{
            console.log("no");
          }
        })
      })
    </script>

  </body>

</html>