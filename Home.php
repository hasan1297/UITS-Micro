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

    <title>Home</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <!-- body -->
    <div class="container mt-4">
      <div class="alert alert-success" role="alert" style="margin-left: auto; margin-right: auto;" >
        <h4 class="alert-heading">Welcome -  <?php echo $row['name']. "<br>"; ?></strong></h4>
        <p>Welcome to <strong>UITS Micro Login!</strong> You are logged in as <strong><?php echo $row['name']; ?>, </strong> id <strong><?php echo $_SESSION['loginID']; ?></strong>. This is an important alert message.</p>
        <hr>
        <p class="mb-0">Whenever you need to leave, be sure to log out properly. <strong>Log out</strong> is at the <strong>top right corner</strong>.</a></p>
      </div>
    </div>

    <!-- css first -->
    <script>0</script>

    <!-- footer -->
    <?php require 'partials/_footer.php'?>

  </body>
</html>