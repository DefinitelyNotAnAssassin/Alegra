<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
</head>

<?php include('header.php')?>
<body>

    <!-- Navbar -->
    <div style="background-color:#c8e2a7;" class="w3-top">
        <div class="w3-bar w3-card w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
  <?php          if(isset($_SESSION['id'])){

?>
<div class="w3-dropdown-hover" style="padding-top:4px; padding-bottom:4px;">
                <button class="w3-button w3-hover-white">Profile <i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block">
                    <a href="profile.php" class="w3-bar-item w3-button">My account</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
                </div>
            </div>
<?php
}else{
    ?>
     <a href="mem_login.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i class="fa-solid fa-right-to-bracket"></i> Login</a>

    <?php

} ?>


            <a href="bulletin.php"
                class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i class="fa-solid fa-chalkboard"></i> Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Guideline</a>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" style="background-color:#c8e2a7;"
            class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="bulletin.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa-solid fa-chalkboard"></i> Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-padding-large">Guideline</a>
        </div>
    </div>

<!-- Header -->
<header class="" style="margin: 0;">
  <img src="assets/img/banner.png" style=" max-width: 110%; height: auto;">
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Logging In</h1>
      <h5 class="w3-padding-32">
      <p> Visit the system's login page.</p>
      <p> Enter your username and password in the provided input fields.</p>
      <p> Click on the "Log In" button to access your account.</p>
      <p> If you forget your password, click on the "Forget Password" link and follow the instructions to reset it.</p>

      </h5>

      <p class="w3-text-grey"></p>
    </div>

    <div class="w3-third w3-center">
      <i style="font-size: 200px;" class="fa fa-sign-in w3-padding-64 w3-text-green"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div style="background-color: #f9f8f2;" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i style="font-size: 200px;" class="fa fa-user-circle w3-text-green w3-padding-64 w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>User Profiles</h1>
      <h5 class="w3-padding-32">
      <p> After logging in, navigate to your user profile section.</p>
      <p> Update your profile information, such as your profile picture and contact number.</p>
      <p> Ensure that all required fields are filled out correctly.</p>
      <p> Save your changes to update your profile.</p>
      </h5>
    </div>
  </div>
</div>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Navigating the System</h1>
      <h5 class="w3-padding-32">
      <p> Familiarize yourself with the main navigation menu or sidebar.</p>
      <p> Use the menu options to access different sections and features of the system.</p>
      <p> Pay attention to any dropdown menus or submenus that provide additional options.</p>

      </h5>

      <p class="w3-text-grey"></p>
    </div>

    <div class="w3-third w3-center">
      <i style="font-size: 200px;" class="fa fa-sitemap w3-padding-64 w3-text-green"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div style="background-color: #f9f8f2;" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i style="font-size: 200px;" class="fa fa-tasks w3-text-green w3-padding-64 w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>Project Progress Tracking</h1>
      <h5 class="w3-padding-32">
      <p> Access the project progress tracking section or webpage.</p>
      <p> View the project reports to monitor contributions, project status, and events.</p>
      <p> Utilize the provided filter and search options to narrow down the displayed information based on specific criteria.</p>
      <p> Track individual task completion status to stay updated on project progress.</p>
      </h5>
    </div>
  </div>
</div>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Problem Reporting</h1>
      <h5 class="w3-padding-32">
      <p> If you encounter any issues or need assistance, access the help page provided in the system.</p>
      <p> Use the text box to describe the problem or concern you are facing.</p>
      <p> Provide all necessary details and information to help the administrators understand the issue better.</p>
      <p> Submit your message and await a response from the administrators for review and resolution.</p>

      </h5>

      <p class="w3-text-grey"></p>
    </div>

    <div class="w3-third w3-center">
      <i style="font-size: 200px;" class="fa fa-exclamation-triangle w3-padding-64 w3-text-green"></i>
    </div>
  </div>
</div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-light-grey w3-opacity w3-xlarge" style=" margin-top:128px">
        <div class="w3-row w3-mobile" style="padding-left: 15%; ">

            <div class="w3-half w3-container">
                <a href="index.php"><img src="admin/assets/img/banner2.png" alt="" style=" margin-top:0; width: 20%; height: 10%;"></a>
                <p style="font-size: 25px;"><b>Quick Links</b></p>
                <a href="reserve.php"><p style="color: black;font-size: 18px; padding-left: 5%;">Reservation</p></a>
                <a href="report.php"><p style="color: black; font-size: 18px; padding-left: 5%;">Report Issue</p></a>
            </div>

            <div class="w3-half w3-container">
                <p><i class="fa fa-phone"></i><b>Contact Us</b></p>
                <p style="font-size: 18px; padding-left: 5%;">09123456789</p>
                <p><i class="fa fa-location-arrow"></i><b>Address</b></p>
                <p style="font-size: 18px; padding-left: 5%;">#123 ABCDE Street Sample Subdivision, Manila , Philippines
                    1123</p>

            </div>
        </div>
    </footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>

