<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage.php");
  exit;
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

    <style>
      .at {
        background-color: #575050;
        color: #ffffff !important;
      }
    </style>

    <title>Teacher's Post & Education Information</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- Inner Navigation Bar -->
    <nav class="Pnavbar mb-5">
      <ul>
        <li><a href="adTdata.php">Data Entry</a></li>
        <li><a href="adTBasicTable.php">Basic</a></li>
        <li><a href="adTContactTable.php">Contact</a></li>
        <li><a  class="active" href="adTPost&EducationTable.php">Post &amp; Education</a></li>
        <li><a href="adTLoginTable.php">Password</a></li>
      </ul>
    </nav>

    <!-- body -->

    <div class="body" style="max-width: 1600px;">

        <h3>Teacher's Picture & Educational Information Table</h3>

      <div class="container my-4" style="max-width: 1600px; min-width: 1600px;">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">SN.</th>
              <th scope="col">ID</th>
              <th scope="col">Picture</th>
              <th scope="col">Name</th>
              <th scope="col">Dept</th>
              <th scope="col">Post</th>
              <th scope="col">Mobile</th>
              <th scope="col">Email</th>
              <th scope="col">Degree 1</th>
              <th scope="col">Degree 2</th>
              <th scope="col">Degree 3</th>
              <th scope="col">Degree 4</th>
              <th scope="col">Degree 5</th>
            </tr>
          </thead>
          <tbody>
            <!-- php MySQL query -->
            <?php
              $sql = "SELECT * FROM `picpost`";
              $result = mysqli_query($conn,$sql);
              $sn = 0;
              while($row = mysqli_fetch_assoc($result)){
                $sn = $sn + 1;
                echo "<tr>
                        <th scope='row'>". $sn. "</th>
                        <td>". $row['loginIdT']. "</td>
                        <td>". $row['photo']. "</td>
                        <td>". $row['name']. "</td>
                        <td>". $row['dept']. "</td>
                        <td>". $row['post']. "</td>
                        <td>". $row['mobile']. "</td>
                        <td>". $row['email']. "</td>
                        <td>". $row['degree1']. "</td>
                        <td>". $row['degree2']. "</td>
                        <td>". $row['degree3']. "</td>
                        <td>". $row['degree4']. "</td>
                        <td>". $row['degree5']. "</td>
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
        let current_url = document.location;
        document.querySelectorAll(".navbar .color").forEach(function(e){
          if(e.href == current_url){
              e.classList += " current";
          }
        });
    </script>
    
  </body>
</html>