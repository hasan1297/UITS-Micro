<?php

//connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "isp";

// creat a connection

// $conn = mysqli_connect($servername, $username, $password);

$conn = mysqli_connect($servername, $username, $password, $database);

//die if connection was not successful
if (!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}


// $sql = "CREATE DATABASE ytdemo";


?>