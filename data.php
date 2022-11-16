<?php

// creating a connection 
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if ($conn){
  echo "yes connection created<br>";
}

//delete database if exist
$sql = 'DROP DATABASE demo';
$retval = mysqli_query($conn,$sql);
if ($retval){
  echo "yes droped DB if existed<br>";
}

//creating database
$sql = "CREATE DATABASE demo; ";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes creating database<br>";
}

//connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn){
  echo "yes database connect<br><br><br>Creating tables--><br><br>";
}


////create table
// login
$sql = "CREATE TABLE login(
loginId INT(10) AUTO_INCREMENT PRIMARY KEY,
password  VARCHAR(255) NOT NULL,
dt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes login<br>";
}

// tlogin
$sql = "CREATE TABLE tlogin(
loginIdT INT(10) AUTO_INCREMENT PRIMARY KEY,
password  VARCHAR(255) NOT NULL,
dt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes tlogin<br>";
}

//dlogin
$sql = "CREATE TABLE dlogin(
loginIdD INT(10) AUTO_INCREMENT PRIMARY KEY,
busNo  VARCHAR(11) NOT NULL,
shift  VARCHAR(20) NOT NULL,
password  VARCHAR(255) NOT NULL,
dt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes dlogin<br>";
}

// tcontactinfo
$sql = "CREATE TABLE tcontactinfo(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdT INT(10) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email   VARCHAR(50) NOT NULL,
Amobile   VARCHAR(20) NOT NULL,
Aemail   VARCHAR(50) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes tcontactinfo<br>";
}

//  dcontactinfo
$sql = "CREATE TABLE dcontactinfo(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdD INT(10) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email   VARCHAR(50) NOT NULL,
Amobile   VARCHAR(20) NOT NULL,
Aemail   VARCHAR(50) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes dcontactinfo<br>";
}

//  basicinfot
$sql = "CREATE TABLE basicinfot
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdT INT(10) NOT NULL,
name   VARCHAR(50) NOT NULL,
DoB   DATETIME NULL DEFAULT NULL,
BG   VARCHAR(10) NOT NULL DEFAULT '-Select-',
gender   VARCHAR(10) NOT NULL DEFAULT 'Male',
shift   VARCHAR(10) NOT NULL DEFAULT 'Day',
MS   VARCHAR(10) NOT NULL DEFAULT '-Select-',
religion   VARCHAR(15) NOT NULL DEFAULT 'Islam',
nationality   VARCHAR(50) NOT NULL DEFAULT 'Bangladesh',
nid   VARCHAR(20) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes basicinfot<br>";
}

//  basicinfod
$sql = "CREATE TABLE basicinfod
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdD INT(10) NOT NULL,
name   VARCHAR(50) NOT NULL,
DoB   DATETIME NULL DEFAULT NULL,
BG   VARCHAR(10) NOT NULL DEFAULT '-Select-',
gender   VARCHAR(10) NOT NULL DEFAULT 'Male',
shift   VARCHAR(10) NOT NULL DEFAULT 'Day',
MS   VARCHAR(10) NOT NULL DEFAULT '-Select-',
religion   VARCHAR(15) NOT NULL DEFAULT 'Islam',
nationality   VARCHAR(50) NOT NULL DEFAULT 'Bangladesh',
nid   VARCHAR(20) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes basicinfod<br>";
}

//  bookmicro
$sql = "CREATE TABLE bookmicro
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdT INT(10) NOT NULL,
name   VARCHAR(50) NOT NULL,
dept   VARCHAR(20) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
busNo   INT(2) NOT NULL,
weekName   VARCHAR(15) NOT NULL,
time   VARCHAR(15) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes bookmicro<br>";
}

//  picpost
$sql = "CREATE TABLE picpost
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdT INT(10) NOT NULL,
photo   VARCHAR(255) NOT NULL,
dept   VARCHAR(20) NOT NULL,
post  VARCHAR(50) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes picpost<br><br><br>connecting foreign keys--><br><br>";
}


////  connecting foreign key
//  basicinfot and tlogin
$sql = "ALTER TABLE `basicinfot` ADD FOREIGN KEY (`loginIdT`) REFERENCES `tlogin`(`loginIdT`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfot and tlogin <br>";
}

//  tcontactinfo and tlogin
$sql = "ALTER TABLE `tcontactinfo` ADD FOREIGN KEY (`loginIdT`) REFERENCES `tlogin`(`loginIdT`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  tcontactinfo and tlogin <br>";
}

//  basicinfod and dlogin
$sql = "ALTER TABLE `basicinfod` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfod and dlogin <br>";
}

//  dcontactinfo and dlogin
$sql = "ALTER TABLE `dcontactinfo` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dcontactinfo and dlogin <br><br><br>changing the starting point of auto increment--><br><br>";
}


////  changing the starting point
//  tlogin
$sql = "ALTER TABLE `tlogin` AUTO_INCREMENT=1914551001";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  tlogin<br>";
}

//  dlogin
$sql = "ALTER TABLE `dlogin` AUTO_INCREMENT=14551001";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dlogin<br><br><br>Inserting data--><br><br>";
}


////  inserting data into table
//  tlogin
$sql = "INSERT INTO `tlogin` (`loginIdT`, `password`, `dt`) VALUES (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp())";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  tlogin 12 ids<br>";
}

//  dlogin
$sql = "INSERT INTO `dlogin` (`loginIdD`, `busNo`, `shift`, `password`, `dt`) VALUES (NULL, '1', 'noon', '1234', current_timestamp()), (NULL, '1', 'afternoon', '1234', current_timestamp()), (NULL, '2', 'noon', '1234', current_timestamp()), (NULL, '2', 'afternoon', '1234', current_timestamp())";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dlogin 4 ids<br><br>";
}

//  basicinfot
$sql = "INSERT INTO `basicinfot` (`sn`, `loginIdT`, `name`, `DoB`, `BG`, `gender`, `shift`, `MS`, `religion`, `nationality`, `nid`) VALUES (NULL, '1914551001', 'Mahamudul Hasan Badhan', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551002', 'Fahim Kamal', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551003', 'Fahad Mia', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551004', 'Shayan Tushar', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551005', 'Firoz Molla', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551006', 'Adnan Shuvo', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551007', 'Shahru Islam', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551008', ' 	Ebrahim khan', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551009', 'Jamil Coudhury', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551010', 'Jobair Ahmed', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551011', 'Sadman Khan', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '1914551012', 'Mithu Hossain', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfot data<br>";
}

//  tcontactinfo
$sql = "INSERT INTO `tcontactinfo` (`sn`, `loginIdT`, `mobile`, `email`, `Amobile`, `Aemail`) VALUES (NULL, '1914551001', '01853438156', 'badhan@gmail.com', '', ''), (NULL, '1914551002', '01853152421', 'fahim@gmail.com', '', ''), (NULL, '1914551003', '01823546855', 'fahad@gmail.com', '', ''), (NULL, '1914551004', '01753124586', 'tushar@gmail.com', '', ''), (NULL, '1914551005', '01645865215', 'firoz@gmail.com', '', ''), (NULL, '1914551006', '01953124444', 'adnan@gmail.com', '', ''), (NULL, '1914551007', '01756864455', 'nayeem@gmail.com', '', ''), (NULL, '1914551008', '01325232456', 'ebrahim@gmail.com', '', ''), (NULL, '1914551009', '01844445577', 'jamil@gmail.com', '', ''), (NULL, '1914551010', '01866554499', 'jobair@gmail.com', '', ''), (NULL, '1914551011', '01844444444', 'sadman@gmail.com', '', ''), (NULL, '1914551012', '01823325225', 'mithu@gmail.com', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  tcontactinfo data<br>";
}

//  basicinfod
$sql = "INSERT INTO `basicinfod` (`sn`, `loginIdD`, `name`, `DoB`, `BG`, `gender`, `shift`, `MS`, `religion`, `nationality`, `nid`) VALUES (NULL, '14551001', 'Kala Mia', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551002', 'Dhola Mia', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551003', 'chan Mia', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551004', 'Shona Mia', NULL, '-Select-', 'Male', 'Day', '-Select-', 'Islam', 'Bangladesh', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfod data<br>";
}

//  dcontactinfo
$sql = "INSERT INTO `dcontactinfo` (`sn`, `loginIdD`, `mobile`, `email`, `Amobile`, `Aemail`) VALUES (NULL, '14551001', '01954563521', 'kala@gmail.com', '', ''), (NULL, '14551002', '01355662235', 'dhola@gmail.com', '', ''), (NULL, '14551003', '01614569852', 'chan@gmail.com', '', ''), (NULL, '14551004', '01987654321', 'shonamia@gmail.com', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dcontactinfo data<br><br><br>Bookmicro data entry--><br><br>";
}


////  Book Micro data entry
$sql = "INSERT INTO `bookmicro` (`sn`, `loginIdT`, `name`, `dept`, `mobile`, `busNo`, `weekName`, `time`) VALUES (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Firoz Molla', '', '01645865215', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Adnan Shuvo', '', '01953124444', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Shahru Islam', '', '01756864455', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Ebrahim khan', '', '01325232456', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Jamil Coudhury', '', '01844445577', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Jobair Ahmed', '', '01866554499', '1', 'Monday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Monday', 'Afternoon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Monday', 'Afternoon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Monday', 'Afternoon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Monday', 'Afternoon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Tuesday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Tuesday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Tuesday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Tuesday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Wednesday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Wednesday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Wednesday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Wednesday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Thursday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Thursday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Thursday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Thursday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Friday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Friday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Friday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Friday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Saturday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Saturday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Saturday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Saturday', 'Noon'), (NULL, '1914551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', 'Sunday', 'Noon'), (NULL, '1914551001', 'Fahim Kamal', '', '01853152421', '1', 'Sunday', 'Noon'), (NULL, '1914551001', 'Fahad Mia', '', '01823546855', '1', 'Sunday', 'Noon'), (NULL, '1914551001', 'Shayan Tushar', '', '01753124586', '1', 'Sunday', 'Noon')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  Book Micro data<br><br><br>";
}


?>