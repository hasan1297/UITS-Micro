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
    <link rel="stylesheet" href="CSS/MyProfileBody.css" />
    <link rel="stylesheet" href="CSS/table.css" />

    <title>MicroBus Info</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- body -->
    <div class="body" style="max-width: 600px; margin-top: 0px;">

    <!-- Left Side Form -->
    <!-- <div class="Lcol"> -->
      <div class="container my-4">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th>
                <h5 class="h5" style = "text-align: center;">Microbus info:</h5>
              </th>
            </tr>
          </thead>
          <tbody>

            <?php
            $sql = "SELECT * FROM `microinfo`";
            $result = mysqli_query($conn,$sql);
            $sn = 1;
            while($row = mysqli_fetch_assoc($result)){
              if($row['busNo'] == $sn){
                $sn = $sn + 1;
                echo '<tr>
                        <td>
                          <div>
                          <label for="microNo"><span style="color: green"> Microbus No:</span> </label><span style="color: red"><b>';?>
                            <?php echo $row['busNo']. "<br>"; ?><?php echo '</b></span>
                          </div>
                          <div>
                          <label for="root"><span style="color: green"> Root:</span> </label>';?>
                            <?php echo $row['root']. "<br>"; ?><?php echo '
                          </div>
                          <div>
                          <label for="driverName"><span style="color: green"> 1st return trip :</span> </label><b>Noon</b>
                          </div>
                          <div>
                          <label for="driverName"><span style="color: green"> 2nd return trip :</span> </label><b>Evening</b>
                          </div>
                          <div>
                          <label for="driverName"><span style="color: green"> Drivers Name:</span> </label><b>';?>
                            <?php echo $row['name']. "<br>"; ?><?php echo '</b>
                          </div>
                          <div>
                          <label for="driverMobile"><span style="color: green"> Mobile:</span> </label><b>';?>
                            <?php echo $row['mobile']. "<br>"; ?><?php echo '</b>
                          </div>
                        </td>
                      </tr>';
                }
              }
            ?>

          </tbody>
        </table>
      </div>
    <!-- </div> -->

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