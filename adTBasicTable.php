<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
}
?>

<?php


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
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit this Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/crud/index.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="snEdit" id="snEdit">



              <div class="form-group">
                <label for="titleEdit">Note Title</label>
                <input type="text" name="titleEdit" class="form-control" id="titleEdit" />
              </div>
              <div class="form-group">
                <label for="descriptionEdit">Note Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
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
        <li><a class="active" href="adTBasicTable.php">Basic</a></li>
        <li><a href="adTContactTable.php">Contact</a></li>
        <li><a href="adTPost&EducationTable.php">Post &amp; Education</a></li>
        <li><a href="adTLoginTable.php">Password</a></li>
      </ul>
    </nav>

    <!-- body -->

    <div class="body" style="max-width: 1400px;">

        <h3>Teacher's Basic Information Table</h3>

      <div class="container my-4" style="max-width: 1400px; min-width: 1400px;">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">SN.</th>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Date of Birth</th>
              <th scope="col">Blood Group</th>
              <th scope="col">Gender</th>
              <th scope="col">Shift</th>
              <th scope="col">Marital Status</th>
              <th scope="col">Religion</th>
              <th scope="col">Nationality</th>
              <th scope="col">NID</th>
            </tr>
          </thead>
          <tbody>
            <!-- php MySQL query -->
            <?php
              $sql = "SELECT * FROM `basicinfot`";
              $result = mysqli_query($conn,$sql);
              $sn = 0;
              while($row = mysqli_fetch_assoc($result)){
                $sn = $sn + 1;
                echo "<tr>
                        <th scope='row'>". $sn. "</th>
                        <td>". $row['loginIdT']. "</td>
                        <td>". $row['name']. "</td>
                        <td>". $row['DoB']. "</td>
                        <td>". $row['BG']. "</td>
                        <td>". $row['gender']. "</td>
                        <td>". $row['shift']. "</td>
                        <td>". $row['MS']. "</td>
                        <td>". $row['religion']. "</td>
                        <td>". $row['nationality']. "</td>
                        <td>". $row['nid']. "</td>
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
  </body>
</html>