<?php

include 'partials/_dbconnect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: loginPage2.php");
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
    <link rel="stylesheet" href="CSS/MyProfileT/BasicInfoT.css" />

    <title>Micro Info</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- body -->
    <div class="body">
      <!-- Left Side Form -->
      <form action="" method="post">


        <div class="Lcol">
          <!-- <h5 class="h5 mb-3">At Noon:</h5> -->
          <!-- <div class="container my-4">
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">
                    <h5 class="h5 mb-3">At Noon:</h5>
                  </th>
                </tr>
              </thead>
              <tbody>

                <?php
                  // $sql = "SELECT * FROM `bookmicro` WHERE `time` LIKE 'Noon' ";
                  // $result = mysqli_query($conn,$sql);
                  // // $num = mysqli_num_rows($result);
                  // while($row = mysqli_fetch_assoc($result)){
                  //   echo '<tr>
                  //           <td>
                            
                  //           </td>
                  //         </tr>';
                  // }
                ?>

              </tbody>
            </table>
          </div> -->


          <div>
            <label for="microNo">Micro No <span style="color: red"> *</span></label>
            <input type="text" name="microNo" class="form-control" id="microNo" value="<?php echo $row['busNo']; ?>"/>
          </div>
          <div>
            <label for="root">Root</label>
            <input type="text" name="root" class="form-control" id="root" value="<?php //echo $row['']; ?>"/>
          </div>
          <div>
            <label for="driverName">Drivers Name</label>
            <input type="text" name="driverName" class="form-control" id="driverName" value="<?php echo $row['name']; ?>"/>
          </div>
          <div>
            <label for="driverMobile">Mobile</label>
            <input type="text" name="driverMobile" class="form-control" id="driverMobile" value="<?php echo $row['mobile']; ?>"/>
          </div>
        </div>

        <!-- Right Side Form -->
        <div class="Rcol">
          <h5 class="h5 mb-3">At Afternoon:</h5>
          <div>
            <label for="microNo">Micro No <span style="color: red"> *</span></label>
            <input type="text" name="microNo" class="form-control" id="microNo" value="<?php echo $row['busNo']; ?>"/>
          </div>
          <div>
            <label for="root">Root</label>
            <input type="text" name="root" class="form-control" id="root" value="<?php //echo $row['']; ?>"/>
          </div>
          <div>
            <label for="driverName">Drivers Name</label>
            <input type="text" name="driverName" class="form-control" id="driverName" value="<?php echo $row['name']; ?>"/>
          </div>
          <div>
            <label for="driverMobile">Mobile</label>
            <input type="text" name="driverMobile" class="form-control" id="driverMobile" value="<?php echo $row['mobile']; ?>"/>
          </div>

          <!-- <div>
            <input
              type="submit"
              name="submit"
              class="btn"
              id="submit"
              value="Save"
            />
          </div> -->

        </div>
      </form>
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
  </body>
</html>