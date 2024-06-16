<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();


$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_projectrecent();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Alegra Heights</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Oswald', sans-serif;
    }

    .w3-bar,
    h1,
    button {
        font-family: "Montserrat", sans-serif
    }

    .fa-anchor,
    .fa-coffee {
        font-size: 200px
    }
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
    <div  style="background-color: #f9f8f2;" class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-row" style="margin: 5px 15% 5px 15%;">
                <h1 style="font-family: 'Oswald', sans-serif; font-size: 48px;">&nbsp; ALEGRA HEIGHTS' PROJECT</h1>
                <br>
                <?php
      while ($asd = mysqli_fetch_assoc($prj1)) {
    ?>
                <div class="w3-quarter w3-container w3-margin-bottom">
                    <a href="view_project.php?status=view&&id=<?php echo $asd['id'] ?>"><img
                            src="admin/project_img/<?php echo $asd['site_pic']?>" alt="Norway"
                            style="width: 315px; height: 300px;" class="w3-hover-opacity"></a>
                    <div class="w3-container w3-white" style="width: 315px; height: 100px; overflow-y: scroll;">
                        <p><b><?php echo $asd['project']?></b></p>
                        <p><?php echo $asd['description']?></p>
                    </div>
                </div>
                <?php } ?>
                <a href="projects.php">
                <div class="w3-quarter w3-center">
                <i style="font-size: 150px; padding-top: 25%;" class="fa-solid fa-angles-right w3-text-green"></i>
                <br>
                <p style="margin: 0; font-size: 25px; color: #8bc349;">View All Project</p>
                </div>
      </a>
            </div>
        </div>
    </div>
    </div>

    <!-- Second Grid -->
    <div class="w3-row-padding w3-padding-64 w3-container">

        <div class="w3-row" style="margin: 5px 15% 5px 15%;">
        <h1 style="font-family: 'Oswald', sans-serif; font-size: 48px;">&nbsp; ALEGRA HEIGHTS' FACILITY</h1>
        <br>
            <div class="w3-third w3-center">
            <img src="assets/img/bas.jpg" alt="Norway" style="margin-left: 20px; width: 550px; height: 100%;" class="w3-hover-opacity"/>
            </div>

            <div class="w3-twothird">
                <h5 class="w3-padding-32" style="margin-left: 200px; font-size: 28px;">
                <p>Covered courts serve the community a standard of care
                 where people of all ages and skill levels can enjoy a variety of
                 activities and amenities aimed at enhancing learning and enjoyment.</p>
                 <p>Basketball, volleyball, badminton, and martial arts competitions
                  can all take place here. You can also book the place to host some events</p>
                  <a href="reserve.php" style="color: #8bc349;"><p>BOOK NOW<i class="fa-solid fa-angles-right"></i></p></a>
                </h5>
            </div>
        </div>
    </div>

    <!-- First Grid -->
    <div class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-row" style="margin: 5px 25% 5px 15%;">
            <div class="w3-twothird">
            <h5 class="w3-padding-32" style="margin-left: 40px; margin-right: 40px; font-size: 28px;">
                <p>Clubhouses offer the ideal location for social events including weddings,
                  parties, and family get-togethers. Residents can organize their events in
                  the clubhouse's event areas by making a simple reservation.</p>
                  <a href="reserve.php" style="color: #8bc349;"><p>BOOK NOW<i class="fa-solid fa-angles-right"></i></p></a>
                </h5>
            </div>

            <div class="w3-third w3-center">
            <img src="assets/img/pool.jpg" alt="Norway" style="margin-right: 90px; width: 550px; height: 100%;" class="w3-hover-opacity"/>
            </div>
        </div>
    </div>

    <!-- Second Grid -->
    <div style="background-color: #f9f8f2;" class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-content">
            <div class="w3-third w3-center">
                <i style="font-size: 200px;" class="fa-solid fa-comments w3-text-green w3-padding-64 w3-margin-right"></i>
            </div>

            <div class="w3-twothird">
            <h1 style="font-family: 'Oswald', sans-serif; font-size: 48px;">&nbsp; ALEGRA HEIGHTS' FORUM</h1>
                <h5 class="w3-padding-32" style="margin-left: 40px; margin-right: 40px; font-size: 28px;">
                    <p> Forums is a platforms which are virtual discussion boards where users
                      can post questions and comments or share information on specific topics of interest.</p>
                  <a href="forum.php" style="color: #8bc349;"><p>VIEW FORUM<i class="fa-solid fa-angles-right"></i></p></a>
                </h5>
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
                <a href="report.php"><p style="color: black; font-size: 18px; padding-left: 5%;">Send Complaints</p></a>
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