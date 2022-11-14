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
    <link rel="stylesheet" href="CSS/MyProfileT/MyInfoT.css" />
    <link rel="stylesheet" href="CSS/MyProfileT/BasicInfoT.css" />

    <title>Hello, world!</title>
  </head>
  <body>
        <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <nav class="Pnavbar">
      <ul>
        <li><a href="myinfoBT.php">Basic Information</a></li>
        <li><a class="active" href="T_familyinfo.php">Family Information</a></li>
        <li><a href="T_contactinfo.php">Contact Information</a></li>
        <li><a href="T_post&eduinfo.php">Post &amp; Educational Info</a></li>
      </ul>
    </nav>



    <!-- footer -->
    <?php require 'partials/_footer.php'?>

  </body>
</html>