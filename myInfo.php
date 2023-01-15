<?php

  include 'partials/_dbconnect.php';
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: loginPage.php");
    exit;
  }

?>

<?php

  ////    selecting user    ////
  require 'partials/_user.php';

  $showAlert = false;
  if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $DoB = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
    $BG = mysqli_real_escape_string($conn, $_POST['bloodGroup']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $MS = mysqli_real_escape_string($conn, $_POST['maritalStatus']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $nid = mysqli_real_escape_string($conn, $_POST['nid']);
    
    if($admin){
      $sql = "UPDATE `picpostAd` SET `name` = '$name' WHERE `picpostAd`.`loginId` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      // $sql = "UPDATE `microinfo` SET `name` = '$name' WHERE `microinfo`.`loginIdD` = '{$_SESSION['loginID']}' ";
      // $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `basicinfoAd` SET `name` = '$name', `DoB` = '$DoB', `BG` = '$BG', `gender` = '$gender',`MS` = '$MS', `religion` = '$religion', `nationality` = '$nationality', `nid` = '$nid' WHERE `basicinfoAd`.`loginId` = '{$_SESSION['loginID']}' ";
    }
    if($teacher){
      $shift = mysqli_real_escape_string($conn, $_POST['DayEvening']);
      $sql = "UPDATE `picpost` SET `name` = '$name' WHERE `picpost`.`loginIdT` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `basicinfot` SET `name` = '$name', `DoB` = '$DoB', `BG` = '$BG', `gender` = '$gender', `shift` = '$shift', `MS` = '$MS', `religion` = '$religion', `nationality` = '$nationality', `nid` = '$nid' WHERE `basicinfot`.`loginIdT` = '{$_SESSION['loginID']}' ";
    }
    if($driver){
      $sql = "UPDATE `picpostd` SET `name` = '$name' WHERE `picpostd`.`loginIdD` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `microinfo` SET `name` = '$name' WHERE `microinfo`.`loginIdD` = '{$_SESSION['loginID']}' ";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE `basicinfod` SET `name` = '$name', `DoB` = '$DoB', `BG` = '$BG', `gender` = '$gender',`MS` = '$MS', `religion` = '$religion', `nationality` = '$nationality', `nid` = '$nid' WHERE `basicinfod`.`loginIdD` = '{$_SESSION['loginID']}' ";
    }

    $result = mysqli_query($conn, $sql);
    if($result){
      $showAlert = true;
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Try again later.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
  }

?>
<?php
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your Profile have been Updated.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
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
    <link rel="stylesheet" href="CSS/MyProfileBody.css" />

    <style>
      .mi {
        background-color: #575050;
        color: #ffffff !important;
      }
    </style>

    <title>My Info</title>
  </head>
  <body id="Mb">

    <!-- css first -->
    <script>0</script>

    <!-- Header -->
    <?php require 'partials/_navtop.php'?>

    <nav class="Pnavbar mb-5">
      <ul>
        <li><a class="active" href="myInfo.php">Basic Information</a></li>
        <li><a href="contactinfo.php">Contact Information</a></li>
        <li><a href="post&eduinfo.php">Post &amp; Educational Info</a></li>
        <li><a href="passwordChangeByUser.php">Password Change (self)</a></li>
      </ul>
    </nav>

    <!-- Body Content -->
    <div class="body" style="max-width: 1200px;">
      <!-- <h5 class="h5">Basic Information</h5> -->
      <!-- Left Side Form -->
      <form action="" method="post">
        <?php
        if($admin){
          $sql = "SELECT * FROM `basicinfoAd` WHERE `loginId` = '{$_SESSION['loginID']}'";
        }
        if($teacher){
          $sql = "SELECT * FROM `basicinfot` WHERE `loginIdT` = '{$_SESSION['loginID']}'";
        }
        if($driver){
          $sql = "SELECT * FROM `basicinfod` WHERE `loginIdD` = '{$_SESSION['loginID']}'";
        }
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        
        ?>
            <div class="Lcol mt-4">
              <div>
                <label for="name">Name <span style="color: red"> *</span></label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>"/>
              </div>
              <div>
                <label for="dateOfBirth"
                  >Date of Birth <span style="color: red"> *</span>
                </label>
                <input
                  type="date"
                  name="dateOfBirth"
                  class="form-control"
                  id="dateOfBirth"
                  value="<?php echo $row['DoB']; ?>"
                />
              </div>
              <div>
                <label for="bloodGroup">Blood Group </label>
                <select
                  type="select"
                  name="bloodGroup"
                  class="form-control"
                  id="bloodGroup"
                  >
                  <!-- <option value="-select-" selected ><?php //echo $row['BG'];?></option> -->
                  <option value="-Select-">-Select-</option>
                  <option value="A-">A-</option>
                  <option value="A+">A+</option>
                  <option value="B-">B-</option>
                  <option value="B+">B+</option>
                  <option value="AB-">AB-</option>
                  <option value="AB+">AB+</option>
                  <option value="O-">O-</option>
                  <option value="O+">O+</option>
                </select>
                <script type="text/javascript">
                  document.getElementById("bloodGroup").value = "<?php echo $row["BG"];?>";
                </script>
              </div>
              <div>
                <label for="gender"
                  >Gender <span style="color: red"> *</span>
                </label>
                <select
                  type="select"
                  name="gender"
                  class="form-control"
                  id="gender"
                >
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Others">Others</option>
                </select>
                <script type="text/javascript">
                  document.getElementById('gender').value = "<?php echo $row['gender'];?>";
                </script>
              </div>
              <?php
                if($teacher){
                  echo '<div>
                          <label for="DayEvening"
                            >Day/Evening <span style="color: red"> *</span>
                          </label>
                          <select
                            type="select"
                            name="DayEvening"
                            class="form-control"
                            id="DayEvening"
                          >
                            <option value="Day">Day</option>
                            <option value="Evening">Evening</option>
                          </select>
                          <script type="text/javascript">
                            document.getElementById("DayEvening").value = "';?><?php echo $row["shift"];?><?php echo '";
                          </script>
                        </div>                ';
                        }
              ?>
            </div>

            <!-- Right Side Form -->
            <div class="Rcol mt-4">
              <div>
                <label for="maritalStatus">Marital Status </label>
                <select
                  type="select"
                  name="maritalStatus"
                  class="form-control"
                  id="maritalStatus"
                >
                  <option value="-Select-">-Select-</option>
                  <option value="Married">Married</option>
                  <option value="Unmarried">Unmarried</option>
                </select>
                <script type="text/javascript">
                  document.getElementById("maritalStatus").value = "<?php echo $row["MS"];?>";
                </script>
              </div>
              <div>
                <label for="religion">Religion </label>
                <select
                  type="select"
                  name="religion"
                  class="form-control"
                  id="religion"
                >
                  <option value="Islam">Islam</option>
                  <option value="Hinduism">Hinduism</option>
                  <option value="Christianity">Christianity</option>
                  <option value="Buddhism">Buddhism</option>
                  <option value="Other">Other</option>
                </select>
                <script type="text/javascript">
                  document.getElementById("religion").value = "<?php echo $row["religion"];?>";
                </script>
              </div>
              <div>
                <label for="nationality"
                  >Nationality <span style="color: red"> *</span>
                </label>
                <select
                  type="select"
                  name="nationality"
                  class="form-control"
                  id="nationality"
                >
                  <option value="">Select Country</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antarctica">Antarctica</option>
                  <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bosnia And Herzegowina">
                    Bosnia And Herzegowina
                  </option>
                  <option value="Botswana">Botswana</option>
                  <option value="Bouvet Island">Bouvet Island</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Brunei Darussalam">Brunei Darussalam</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Canada">Canada</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Central African Republic">
                    Central African Republic
                  </option>
                  <option value="Chad">Chad</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Christmas Island">Christmas Island</option>
                  <option value="Cocos (Keeling) Islands">
                    Cocos (Keeling) Islands
                  </option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo">Congo</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czech Republic">Czech Republic</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="East Timor">East Timor</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Falkland Islands (Malvinas)">
                    Falkland Islands (Malvinas)
                  </option>
                  <option value="Fiji">Fiji</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Germany">Germany</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong">Hong Kong</option>
                  <option value="Hungary">Hungary</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japan">Japan</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Korea, Dem People'S Republic">
                    Korea, Dem People'S Republic
                  </option>
                  <option value="Korea, Republic O">Korea, Republic Of</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macau">Macau</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Myanmar">Myanmar</option>
                  <option value="Namibia">Namibia</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Palau">Palau</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romania">Romania</option>
                  <option value="Russian Federation">Russian Federation</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Saint Lucia">Saint Lucia</option>
                  <option value="Samoa">Samoa</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Slovakia">Slovakia (Slovak Republic)</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="South Georgia , S Sandwich Is.">
                    South Georgia , S Sandwich Is.
                  </option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                  <option value="Taiwan">Taiwan</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania, United Republic Of">
                    Tanzania, United Republic Of
                  </option>
                  <option value="Thailand">Thailand</option>
                  <option value="Togo">Togo</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Turks And Caicos Islands">
                    Turks And Caicos Islands
                  </option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Viet Nam">Viet Nam</option>
                  <option value="Virgin Islands (British)">
                    Virgin Islands (British)
                  </option>
                  <option value="Virgin Islands (U.S.)">
                    Virgin Islands (U.S.)
                  </option>
                  <option value="Western Sahara">Western Sahara</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Zaire">Zaire</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select>
                <script type="text/javascript">
                  document.getElementById("nationality").value = "<?php echo $row["nationality"];?>";
                </script>
              </div>
              <div>
                <label for="nid">NID</label>
                <input type="text" name="nid" class="form-control" id="nid" value="<?php echo $row['nid']; ?>"/>
              </div>
              <?php
            }
          }
              ?>

              <div>
                <input
                  type="submit"
                  name="submit"
                  class="btn"
                  id="submit"
                  value="Save"
                />
              </div>
            </div>
      </form>
    </div>

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
