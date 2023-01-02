<?php

$update = false;
$delete = false;
$dlogin = false;
$dcontactinfo = false;
$basicinfod = false;
$bookmicro = false;
$microinfo = false;
$picpostd = false;
$counter = false;

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>

<?php
if(isset($_GET['delete'])){
  $ID = $_GET['delete'];
  $sql = "DELETE FROM `dlogin` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
  $dlogin = true;
  }
  $sql = "DELETE FROM `dcontactinfo` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $dcontactinfo = true;
  }
  $sql = "DELETE FROM `basicinfod` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $basicinfod = true;
  }
  $sql = "DELETE FROM `bookmicro` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $bookmicro = true;
  }
  $sql = "DELETE FROM `microinfo` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $microinfo = true;
  }
  $sql = "DELETE FROM `picpostd` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $picpostd = true;
  }
  $sql = "DELETE FROM `counter` WHERE `loginIdD` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $counter = true;
  }
  if($result){
    $delete = true;
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['loginIdDEdit'])){
    // Update the record
    $ID = $_POST['loginIdDEdit'];
    // $title = $_POST['titleEdit'];
    $newPassword = $_POST['passwordEdit'];
    //sql query to be executed
    $sql ="UPDATE `dlogin` SET `password` = '$newPassword' WHERE `dlogin`.`loginIdD` = '$ID'";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
    }
    else{
      echo "Failed to Updated record successfully! <br>";
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
    <link rel="stylesheet" href="CSS/MyProfileNav.css" />
    <link rel="stylesheet" href="CSS/infoEntry.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <title>Home</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/isp/adDLoginTable.php" method="POST" style="min-width: fit-content;">
            <div class="modal-body">
              <input type="hidden" name="loginIdDEdit" id="loginIdDEdit">
              <div class="form-group">
                <label for="passwordEdit">Password</label>
                <input type="text" name="passwordEdit" class="form-control" id="passwordEdit" />
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- Inner Navigation Bar -->
    <nav class="Pnavbar mb-5">
      <ul>
        <li><a href="adDdata.php">Data Entry</a></li>
        <li><a href="adDBasicTable.php">Basic</a></li>
        <li><a href="adDContactTable.php">Contact</a></li>
        <li><a href="adDPost&EducationTable.php">Post &amp; Education</a></li>
        <li><a class="active" href="adDLoginTable.php">Password</a></li>
      </ul>
    </nav>

    <?php
      if($dlogin){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table dlogin in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($dcontactinfo){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table dcontactinfo in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($basicinfod){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table basicinfod in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($bookmicro){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table bookmicro in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($microinfo){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There was a problem with Table microinfo in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($picpostd){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There was a problem with Table picpostd in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($counter){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There was a problem with Table counter in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($delete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your selected ID has been deleted successfully from the DataBase!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Password has been Updated successfully in the DataBase!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    ?>

    <!-- body -->

    <div class="body" style="max-width: 1000px;">

        <h3>Drivers's Login Table</h3>

      <div class="container my-4" style="max-width: 1400px; min-width: 1000px;">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">SN.</th>
              <th scope="col">ID</th>
              <th scope="col">Password</th>
              <th scope="col">Bus No</th>
              <th scope="col">Root</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- php MySQL query -->
            <?php
              $sql = "SELECT * FROM `dlogin`";
              $result = mysqli_query($conn,$sql);
              $sn = 0;
              while($row = mysqli_fetch_assoc($result)){
                $sn = $sn + 1;
                echo "<tr>
                        <th scope='row'>". $sn. "</th>
                        <td>". $row['loginIdD']. "</td>
                        <td>". $row['password']. "</td>
                        <td>". $row['busNo']. "</td>
                        <td>". $row['root']. "</td>
                        <td><button class='edit btn btn-sm btn-primary' id=". $row['loginIdD'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d". $row['loginIdD'].">Delete</button></td>
                      </tr>";
              }
            ?>

          </tbody>
        </table>
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
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ");
          tr = e.target.parentNode.parentNode;
          password = tr.getElementsByTagName("td")[1].innerText;
          console.log(password);
          passwordEdit.value = password;
          loginIdDEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })


      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click", (e) => {
          console.log("edit ");
          loginIdD = e.target.id.substr(1);
          if(confirm("Are you sure you want to remove this booking!")){
            console.log("yes");
            window.location = `/isp/adDLoginTable.php?delete=${loginIdD}`;
          }
          else{
            console.log("no");
          }
        })
      })
    </script>
  </body>
</html>