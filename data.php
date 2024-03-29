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
$sql = 'DROP DATABASE isp';
$retval = mysqli_query($conn,$sql);
if ($retval){
  echo "yes droped DB ISP (Imtiaz Sir Project) if existed<br>";
}

//creating database
$sql = "CREATE DATABASE isp; ";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes creating database ISP (Imtiaz Sir Project)<br>";
}

//connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "isp";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn){
  echo "yes database ISP (Imtiaz Sir Project) connect<br><br><br>Creating tables--><br><br>";
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
root  VARCHAR(255) NOT NULL,
password  VARCHAR(255) NOT NULL,
dt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes dlogin<br>";
}

// contactinfoAd
$sql = "CREATE TABLE contactinfoAd(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginId INT(10) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email   VARCHAR(50) NOT NULL,
Amobile   VARCHAR(20) NOT NULL,
Aemail   VARCHAR(50) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes contactinfoAd<br>";
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
$sql = "CREATE TABLE basicinfoAd
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginId INT(10) NOT NULL,
name   VARCHAR(50) NOT NULL,
DoB   DATETIME NULL DEFAULT NULL,
BG   VARCHAR(10) NOT NULL DEFAULT '-Select-',
gender   VARCHAR(10) NOT NULL DEFAULT 'Male',
MS   VARCHAR(10) NOT NULL DEFAULT '-Select-',
religion   VARCHAR(15) NOT NULL DEFAULT 'Islam',
nationality   VARCHAR(50) NOT NULL DEFAULT 'Bangladesh',
nid   VARCHAR(20) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes basicinfoAd<br>";
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
loginIdD INT(10) NOT NULL,
name   VARCHAR(50) NOT NULL,
dept   VARCHAR(20) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
busNo   INT(2) NOT NULL,
date   DATE NULL,
time   VARCHAR(15) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes bookmicro<br>";
}

// microinfo
$sql = "CREATE TABLE microinfo(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdD INT(10) NOT NULL,
busNo    INT(11) NOT NULL,
shift     VARCHAR(20) NOT NULL,
root    TEXT NOT NULL,
name     VARCHAR(50) NOT NULL,
mobile  VARCHAR(20) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes microinfo<br>";
}

//  picpost
$sql = "CREATE TABLE picpost
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdT INT(10) NOT NULL,
photo   VARCHAR(255) NOT NULL DEFAULT 'nn',
name   VARCHAR(50) NOT NULL,
dept   VARCHAR(50) NOT NULL,
post  VARCHAR(50) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email  VARCHAR(50) NOT NULL,
degree1  VARCHAR(255) NOT NULL,
degree2 VARCHAR(255) NOT NULL,
degree3  VARCHAR(255) NOT NULL,
degree4  VARCHAR(255) NOT NULL,
degree5  VARCHAR(255) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes picpost<br>";
}

//  picpostd
$sql = "CREATE TABLE picpostd
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginIdD INT(10) NOT NULL,
photo   VARCHAR(255) NOT NULL DEFAULT 'nn',
name   VARCHAR(50) NOT NULL,
busNo   INT(11) NOT NULL,
shift  VARCHAR(20) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email  VARCHAR(50) NOT NULL,
degree1  VARCHAR(255) NOT NULL,
degree2 VARCHAR(255) NOT NULL,
degree3  VARCHAR(255) NOT NULL,
degree4  VARCHAR(255) NOT NULL,
degree5  VARCHAR(255) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes picpostd<br>";
}

//  picpostAd
$sql = "CREATE TABLE picpostAd
(
sn INT(11) AUTO_INCREMENT PRIMARY KEY,
loginId INT(10) NOT NULL,
photo   VARCHAR(255) NOT NULL DEFAULT 'nn',
name   VARCHAR(50) NOT NULL,
mobile  VARCHAR(20) NOT NULL,
email  VARCHAR(50) NOT NULL,
degree1  VARCHAR(255) NOT NULL,
degree2 VARCHAR(255) NOT NULL,
degree3  VARCHAR(255) NOT NULL,
degree4  VARCHAR(255) NOT NULL,
degree5  VARCHAR(255) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes picpostAd<br>";
}

//  counter
$sql = "CREATE TABLE counter
(
sn INT(255) AUTO_INCREMENT PRIMARY KEY,
loginIdD INT(10) NOT NULL,
date   DATE NOT NULL,
time   VARCHAR(15) NOT NULL,
done   VARCHAR(7) NOT NULL
)";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes counter<br><br><br>connecting foreign keys--><br><br>";
}


////  connecting foreign key
//  basicinfoAd and login
$sql = "ALTER TABLE `basicinfoAd` ADD FOREIGN KEY (`loginId`) REFERENCES `login`(`loginId`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfoAd and login <br>";
}

//  contactinfoAd and login
$sql = "ALTER TABLE `contactinfoAd` ADD FOREIGN KEY (`loginId`) REFERENCES `login`(`loginId`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  contactinfoAd and login <br>";
}

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
  echo "yes  dcontactinfo and dlogin <br>";
}

////  picpost and tlogin
$sql = "ALTER TABLE `picpost` ADD FOREIGN KEY (`loginIdT`) REFERENCES `tlogin`(`loginIdT`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  picpost and tlogin <br>";
}

////  picpostd and dlogin
$sql = "ALTER TABLE `picpostd` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  picpostd and dlogin <br>";
}

////  microinfo and dlogin
$sql = "ALTER TABLE `microinfo` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  microinfo and dlogin <br>";
}
////  bookmicro and tlogin
$sql = "ALTER TABLE `bookmicro` ADD FOREIGN KEY (`loginIdT`) REFERENCES `tlogin`(`loginIdT`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  bookmicro and tlogin <br>";
}
////  bookmicro and dlogin
$sql = "ALTER TABLE `bookmicro` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  bookmicro and dlogin <br>";
}
////  counter and dlogin
$sql = "ALTER TABLE `counter` ADD FOREIGN KEY (`loginIdD`) REFERENCES `dlogin`(`loginIdD`) ON DELETE CASCADE ON UPDATE CASCADE";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  counter and dlogin <br><br><br>changing the starting point of auto increment--><br><br>";
}



////  changing the starting point
//  tlogin
$sql = "ALTER TABLE `login` AUTO_INCREMENT=19145501";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  login<br>";
}

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
//  login
$sql = "INSERT INTO `login` (`loginId`, `password`, `dt`) VALUES (NULL, 'admin', current_timestamp())";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  login admin id<br>";
}

//  tlogin
$sql = "INSERT INTO `tlogin` (`loginIdT`, `password`, `dt`) VALUES (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp()), (NULL, '1234', current_timestamp())";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  tlogin 12 ids<br>";
}

//  dlogin
$sql = "INSERT INTO `dlogin` (`loginIdD`, `busNo`, `root`, `password`, `dt`) VALUES (NULL, '1', 'UITS ⇄ Natun Bazar ⇄ Badda ⇄ Rampura ⇄ Malibagh ⇄ Khilgaon ⇄ Bashabo ⇄ Mugda ⇄ Maniknagar ⇄ Sayedabad ⇄ Jatrabari', '1234', current_timestamp()), (NULL, '2', 'UITS ⇄ Natun Bazar ⇄ Nadda ⇄ Bashundhara ⇄ Kuril Bishwa Road ⇄ Shewra Bazar ⇄ MES ⇄  ECB Square ⇄ Kalshi ⇄ Purobi ⇄ Mirpur 11', '1234', current_timestamp()), (NULL, '3', 'UITS ⇄ Notun Bazar ⇄ Uttar Badda ⇄ Shahjadpur ⇄ Bashtola ⇄ Badda Link Road ⇄ Gulshan 1 ⇄ Wireless ⇄ Mohakhali', '1234', current_timestamp()), (NULL, '4', 'UITS ⇄ Notun Bazar ⇄ Nadda ⇄ Bashundhara ⇄ Jamuna Future Park ⇄ Kuril Bishwa Road ⇄ Khilkhet ⇄ Airport ⇄ Jashimuddin (Uttara) ⇄ Rajlakshmi ⇄ Azampur', '1234', current_timestamp())";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dlogin 4 ids<br><br>";
}

//  basicinfoAd
$sql = "INSERT INTO `basicinfoAd` (`sn`, `loginId`, `name`, `DoB`, `BG`, `gender`, `MS`, `religion`, `nationality`, `nid`) VALUES (NULL, '19145501', 'Admin', NULL, '-Select-', 'Male', '-Select-', 'Islam', 'Bangladesh', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfoAd data<br>";
}

//  contactinfoAd
$sql = "INSERT INTO `contactinfoAd` (`sn`, `loginId`, `mobile`, `email`, `Amobile`, `Aemail`) VALUES (NULL, '19145501', '01612971914', 'admin@gmail.com', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  contactinfoAd data<br>";
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
$sql = "INSERT INTO `basicinfod` (`sn`, `loginIdD`, `name`, `DoB`, `BG`, `gender`, `MS`, `religion`, `nationality`, `nid`) VALUES (NULL, '14551001', 'Kala Mia', NULL, '-Select-', 'Male', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551002', 'Dhola Mia', NULL, '-Select-', 'Male', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551003', 'Chan Mia', NULL, '-Select-', 'Male', '-Select-', 'Islam', 'Bangladesh', ''), (NULL, '14551004', 'Shona Mia', NULL, '-Select-', 'Male', '-Select-', 'Islam', 'Bangladesh', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  basicinfod data<br>";
}

//  dcontactinfo
$sql = "INSERT INTO `dcontactinfo` (`sn`, `loginIdD`, `mobile`, `email`, `Amobile`, `Aemail`) VALUES (NULL, '14551001', '01954563521', 'kala@gmail.com', '', ''), (NULL, '14551002', '01355662235', 'dhola@gmail.com', '', ''), (NULL, '14551003', '01614569852', 'chan@gmail.com', '', ''), (NULL, '14551004', '01987654321', 'shonamia@gmail.com', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  dcontactinfo data<br><br><br>microinfo data entry--><br>";
}


////  microinfo data entry
$sql = "INSERT INTO `microinfo` (`sn`, `loginIdD`, `busNo`, `shift`, `root`, `name`, `mobile`) VALUES (NULL, '14551001', '1', 'Noon', 'UITS ⇄ Natun Bazar ⇄ Badda ⇄ Rampura ⇄ Malibagh ⇄ Khilgaon ⇄ Bashabo ⇄ Mugda ⇄ Maniknagar ⇄ Sayedabad ⇄ Jatrabari', 'Kala Mia', '01954563521'), (NULL, '14551002', '2', 'Afternoon', 'UITS ⇄ Natun Bazar ⇄ Nadda ⇄ Bashundhara ⇄ Kuril Bishwa Road ⇄ Shewra Bazar ⇄ MES ⇄  ECB Square ⇄ Kalshi ⇄ Purobi ⇄ Mirpur 11', 'Dhola Mia', '01355662235'), (NULL, '14551003', '3', 'Noon', 'UITS ⇄ Notun Bazar ⇄ Uttar Badda ⇄ Shahjadpur ⇄ Bashtola ⇄ Badda Link Road ⇄ Gulshan 1 ⇄ Wireless ⇄ Mohakhali', 'Chan Mia', '01614569852'), (NULL, '14551004', '4', 'Afternoon', 'UITS ⇄ Notun Bazar ⇄ Nadda ⇄ Bashundhara ⇄ Jamuna Future Park ⇄ Kuril Bishwa Road ⇄ Khilkhet ⇄ Airport ⇄ Jashimuddin (Uttara) ⇄ Rajlakshmi ⇄ Azampur', 'Shona Mia', '01987654321')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  microinfo data<br><br><br>Bookmicro data entry--><br>";
}


////  Book Micro data entry
$sql = "INSERT INTO `bookmicro` (`sn`, `loginIdT`, `loginIdD`, `name`, `dept`, `mobile`, `busNo`, `date`, `time`) VALUES (NULL, '1914551002', '14551001', 'Fahim Kamal', '', '01853152421', '1', CURDATE()-1, 'Noon'), (NULL, '1914551001', '14551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', CURDATE(), 'Evening'), (NULL, '1914551002', '14551001', 'Fahim Kamal', '', '01853152421', '1', CURDATE(), 'Noon'), (NULL, '1914551003', '14551001', 'Fahad Mia', '', '01823546855', '1', CURDATE(), 'Noon'), (NULL, '1914551004', '14551001', 'Shayan Tushar', '', '01753124586', '1', CURDATE(), 'Noon'), (NULL, '1914551005', '14551001', 'Firoz Molla', '', '01645865215', '1', CURDATE(), 'Noon'), (NULL, '1914551006', '14551001', 'Adnan Shuvo', '', '01953124444', '1', CURDATE(), 'Noon'), (NULL, '1914551007', '14551001', 'Shahru Islam', '', '01756864455', '1', CURDATE(), 'Noon'), (NULL, '1914551008', '14551001', 'Ebrahim khan', '', '01325232456', '1', CURDATE(), 'Noon'), (NULL, '1914551009', '14551001', 'Jamil Coudhury', '', '01844445577', '1', CURDATE(), 'Noon'), (NULL, '1914551010', '14551001', 'Jobair Ahmed', '', '01866554499', '1', CURDATE(), 'Noon'), (NULL, '1914551011', '14551001', 'Sadman Khan', '', '01844444444', '1', CURDATE(), 'Noon'), (NULL, '1914551012', '14551001', 'Mithu Hossain', '', '01823325225', '1', CURDATE(), 'Evening'), (NULL, '1914551001', '14551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', CURDATE()+1, 'Noon'), (NULL, '1914551002', '14551001', 'Fahim Kamal', '', '01853152421', '1', CURDATE()+1, 'Noon'), (NULL, '1914551003', '14551001', 'Fahad Mia', '', '01823546855', '1', CURDATE()+1, 'Noon'), (NULL, '1914551004', '14551001', 'Shayan Tushar', '', '01753124586', '1', CURDATE()+1, 'Noon'), (NULL, '1914551005', '14551001', 'Firoz Molla', '', '01645865215', '1', CURDATE()+1, 'Noon'), (NULL, '1914551006', '14551001', 'Adnan Shuvo', '', '01953124444', '1', CURDATE()+1, 'Noon'), (NULL, '1914551007', '14551001', 'Shahru Islam', '', '01756864455', '1', CURDATE()+1, 'Evening'), (NULL, '1914551008', '14551001', 'Ebrahim khan', '', '01325232456', '1', CURDATE()+1, 'Evening'), (NULL, '1914551009', '14551001', 'Jamil Coudhury', '', '01844445577', '1', CURDATE()+1, 'Evening'), (NULL, '1914551010', '14551001', 'Jobair Ahmed', '', '01866554499', '1', CURDATE()+1, 'Evening'), (NULL, '1914551011', '14551001', 'Sadman Khan', '', '01844444444', '1', CURDATE()+1, 'Evening'), (NULL, '1914551012', '14551001', 'Mithu Hossain', '', '01823325225', '1', CURDATE()+1, 'Evening'),(NULL, '1914551001', '14551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', CURDATE()+2, 'Noon'), (NULL, '1914551002', '14551001', 'Fahim Kamal', '', '01853152421', '1', CURDATE()+2, 'Noon'),  (NULL, '1914551003', '14551001', 'Fahad Mia', '', '01823546855', '1', CURDATE()+2, 'Noon'), (NULL, '1914551004', '14551001', 'Shayan Tushar', '', '01753124586', '1', CURDATE()+2, 'Noon'), (NULL, '1914551005', '14551001', 'Firoz Molla', '', '01645865215', '1', CURDATE()+2, 'Noon'), (NULL, '1914551006', '14551001', 'Adnan Shuvo', '', '01953124444', '1', CURDATE()+2, 'Noon'),  (NULL, '1914551007', '14551001', 'Shahru Islam', '', '01756864455', '1', CURDATE()+2, 'Evening'), (NULL, '1914551008', '14551001', 'Ebrahim khan', '', '01325232456', '1', CURDATE()+2, 'Evening'), (NULL, '1914551009', '14551001', 'Jamil Coudhury', '', '01844445577', '1', CURDATE()+2, 'Evening'), (NULL, '1914551010', '14551001', 'Jobair Ahmed', '', '01866554499', '1', CURDATE()+2, 'Evening'), (NULL, '1914551011', '14551001', 'Sadman Khan', '', '01844444444', '1', CURDATE()+2, 'Evening'), (NULL, '1914551012', '14551001', 'Mithu Hossain', '', '01823325225', '1', CURDATE()+2, 'Evening'),(NULL, '1914551001', '14551001', 'Mahamudul Hasan Badhan', '', '01853438156', '1', CURDATE()+3, 'Noon'), (NULL, '1914551002', '14551001', 'Fahim Kamal', '', '01853152421', '1', CURDATE()+3, 'Noon'), (NULL, '1914551003', '14551001', 'Fahad Mia', '', '01823546855', '1', CURDATE()+3, 'Noon'), (NULL, '1914551004', '14551001', 'Shayan Tushar', '', '01753124586', '1', CURDATE()+3, 'Noon'), (NULL, '1914551005', '14551001', 'Firoz Molla', '', '01645865215', '1', CURDATE()+3, 'Noon'), (NULL, '1914551006', '14551001', 'Adnan Shuvo', '', '01953124444', '1', CURDATE()+3, 'Noon'), (NULL, '1914551007', '14551001', 'Shahru Islam', '', '01756864455', '1', CURDATE()+3, 'Evening'), (NULL, '1914551008', '14551001', 'Ebrahim khan', '', '01325232456', '1', CURDATE()+3, 'Evening'), (NULL, '1914551009', '14551001', 'Jamil Coudhury', '', '01844445577', '1', CURDATE()+3, 'Evening'), (NULL, '1914551010', '14551001', 'Jobair Ahmed', '', '01866554499', '1', CURDATE()+3, 'Evening'), (NULL, '1914551011', '14551001', 'Sadman Khan', '', '01844444444', '1', CURDATE()+3, 'Evening'), (NULL, '1914551012', '14551001', 'Mithu Hossain', '', '01823325225', '1', CURDATE()+3, 'Evening')";
$result = mysqli_query($conn,$sql);

if ($result){
  echo "yes  Book Micro data<br><br><br>picpost data entry--><br>";
}
// $num = mysqli_num_rows($result);
// echo $num."<br>";
// while($row = mysqli_fetch_assoc($result)){
  
// }


////  picpostAd data entry
$sql = "INSERT INTO `picpostAd` (`sn`, `loginId`, `photo`, `name`, `mobile`, `email`, `degree1`, `degree2`, `degree3`, `degree4`, `degree5`) VALUES (NULL, '19145501', 'nn', 'Admin', '01612971914', 'admin@gmail.com', '', '', '', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  picpostAd data<br><br><br>picpostd data entry--><br>";
}


////  picpost data entry
$sql = "INSERT INTO `picpost` (`sn`, `loginIdT`, `photo`, `name`, `dept`, `post`, `mobile`, `email`, `degree1`, `degree2`, `degree3`, `degree4`, `degree5`) VALUES (NULL, '1914551001', 'nn', 'Mahamudul Hasan Badhan', '', '', '01853438156', 'badhan@gmail.com', '', '', '', '', ''), (NULL, '1914551002', 'nn', 'Fahim Kamal', '', '', '01853152421', 'fahim@gmail.com', '', '', '', '', ''), (NULL, '1914551003', 'nn', 'Fahad Mia', '', '', '01823546855', 'fahad@gmail.com', '', '', '', '', ''), (NULL, '1914551004', 'nn', 'Shayan Tushar', '', '', '01753124586', 'tushar@gmail.com', '', '', '', '', ''), (NULL, '1914551005', 'nn', 'Firoz Molla', '', '', '01645865215', 'firoz@gmail.com', '', '', '', '', ''), (NULL, '1914551006', 'nn', 'Adnan Shuvo', '', '', '01953124444', 'adnan@gmail.com', '', '', '', '', ''), (NULL, '1914551007', 'nn', 'Shahru Islam', '', '', '01756864455', 'nayeem@gmail.com', '', '', '', '', ''), (NULL, '1914551008', 'nn', 'Ebrahim khan', '', '', '01325232456', 'ebrahim@gmail.com', '', '', '', '', ''), (NULL, '1914551009', 'nn', 'Jamil Coudhury', '', '', '01844445577', 'jamil@gmail.com', '', '', '', '', ''), (NULL, '1914551010', 'nn', 'Jobair Ahmed', '', '', '01866554499', 'jobair@gmail.com', '', '', '', '', ''), (NULL, '1914551011', 'nn', 'Sadman Khan', '', '', '01844444444', 'sadman@gmail.com', '', '', '', '', ''), (NULL, '1914551012', 'nn', 'Mithu Hossain', '', '', '01823325225', 'mithu@gmail.com', '', '', '', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  picpost data<br><br><br>picpostd data entry--><br>";
}


////  picpostd data entry
$sql = "INSERT INTO `picpostd` (`sn`, `loginIdD`, `photo`, `name`, `busNo`, `shift`, `mobile`, `email`, `degree1`, `degree2`, `degree3`, `degree4`, `degree5`) VALUES (NULL, '14551001', 'nn', 'Kala Mia', '1', 'Noon', '01954563521', 'kala@gmail.com', '', '', '', '', ''), (NULL, '14551002', 'nn', 'Dhola Mia 	', '2', 'Afternoon', '01355662235', 'dhola@gmail.com', '', '', '', '', ''), (NULL, '14551003', 'nn', 'Chan Mia', '3', 'Noon', '01614569852', 'chan@gmail.com', '', '', '', '', ''), (NULL, '14551004', 'nn', 'Shona Mia', '4', 'Afternoon', '01987654321', 'shonamia@gmail.com 	', '', '', '', '', '')";
$result = mysqli_query($conn,$sql);
if ($result){
  echo "yes  picpostd data<br><br><br>";
}


?>