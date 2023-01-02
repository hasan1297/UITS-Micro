<?php

$update = false;
$delete = false;
$tlogin = false;
$tcontactinfo = false;
$basicinfot = false;
$bookmicro = false;
$picpost = false;

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
  $sql = "DELETE FROM `tlogin` WHERE `loginIdT` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $tlogin = true;
  }
  $sql = "DELETE FROM `tcontactinfo` WHERE `loginIdT` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $tcontactinfo = true;
  }
  $sql = "DELETE FROM `basicinfot` WHERE `loginIdT` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $basicinfot = true;
  }
  $sql = "DELETE FROM `bookmicro` WHERE `loginIdT` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $bookmicro = true;
  }
  $sql = "DELETE FROM `picpost` WHERE `loginIdT` = $ID";
  $result = mysqli_query($conn, $sql);
  if(!$result){
    $picpost = true;
  }
  if($result){
    $delete = true;
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['loginIdTEdit'])){
    // Update the record
    $ID = $_POST['loginIdTEdit'];
    // $title = $_POST['titleEdit'];
    $newPassword = $_POST['passwordEdit'];
    //sql query to be executed
    $sql ="UPDATE `tlogin` SET `password` = '$newPassword' WHERE `tlogin`.`loginIdT` = '$ID'";
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
          <form action="/isp/adTLoginTable.php" method="POST" style="min-width: fit-content;">
            <div class="modal-body">
              <input type="hidden" name="loginIdTEdit" id="loginIdTEdit">
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
        <li><a href="adTdata.php">Data Entry</a></li>
        <li><a href="adTBasicTable.php">Basic</a></li>
        <li><a href="adTContactTable.php">Contact</a></li>
        <li><a href="adTPost&EducationTableerehsome">Post &amp; Education</a></li>
        <li><a class="active" href="adTLoginTable.php">Password</a></li>
      </ul>
    </nav>

    <?php
      if($tlogin){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table tlogin in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($tcontactinfo){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table tcontactinfo in the DATABASE!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      if($basicinfot){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There were some problem with Table basicinfot in the DATABASE!
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
      if($picpost){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There was a problem with Table picpost in the DATABASE!
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

        <h3>Teacher's Login Table</h3>

      <div class="container my-4" style="max-width: 1400px; min-width: 1000px;">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">SN.</th>
              <th scope="col">ID</th>
              <th scope="col">Password</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- php MySQL query -->
            <?php
              $sql = "SELECT * FROM `tlogin`";
              $result = mysqli_query($conn,$sql);
              $sn = 0;
              while($row = mysqli_fetch_assoc($result)){
                $sn = $sn + 1;
                echo "<tr>
                        <th scope='row'>". $sn. "</th>
                        <td>". $row['loginIdT']. "</td>
                        <td>". $row['password']. "</td>
                        <td><button class='edit btn btn-sm btn-primary' id=". $row['loginIdT'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d". $row['loginIdT'].">Delete</button></td>
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
          loginIdTEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })


      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click", (e) => {
          console.log("edit ");
          loginIdT = e.target.id.substr(1);
          if(confirm("Are you sure you want to remove this booking!")){
            console.log("yes");
            window.location = `/isp/adTLoginTable.php?delete=${loginIdT}`;
          }
          else{
            console.log("no");
          }
        })
      })
    </script>
  </body>
</html>