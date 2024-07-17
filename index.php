<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Alegra Heights</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        font-family: "Lato", sans-serif
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
     <a href="admin/admin-login.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i class="fa-solid fa-right-to-bracket"></i> Login</a>

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
    <header class="" style="margin-bottom: 5vh;">
         <br /></header>

    <!-- First Grid -->
    <div class="w3-row-padding w3-white w3-padding-64 w3-container">
        <div class="w3-content">
            <div class="w3-twothird">
                <h1>Welcome Home</h1>
                <h5 class="w3-padding-32">
                Alegra Heights is a residential neighborhood in Santa Maria, Bulacan. A project of Borland Development Corporation, 
                the village features multiple townhouse units available at an affordable price. Living here puts you at the center of 
                Bulacan’s most promising municipalities, Santa Maria. Most essentials and modern conveniences are available to you the 
                minute you step outside your door.
                </h5>

                <p class="w3-text-grey"></p>
            </div>

            <div class="w3-third w3-center">
                <i style="font-size: 200px;" class="fa fa-home w3-padding-64 w3-text-green"></i>
            </div>
        </div>
    </div>

    <!-- Second Grid -->
    <div style="background-color: #e9e5d6;" class="w3-row-padding w3-padding-64 w3-container">
        <div class="w3-content">
            <div class="w3-third w3-center">
                <i style="font-size: 200px;" class="fa fa-users w3-text-green w3-padding-64 w3-margin-right"></i>
            </div>

            <div class="w3-twothird">
                <h1>Hello Pipol</h1>
                <h5 class="w3-padding-32">Santa Maria is a municipality in the province of Bulacan. 
                    With a population of over 250,000 people, it’s the most populous municipality in Central
                     Luzon and the 5th most populous in the country. The center of the city is a busy commercial 
                     and financial center that comprises more than half of the municipality’s economic activities.
                      The area also benefits from a thriving agricultural and industrial sector, with many food processing, 
                      textile, and rubber factories scattered throughout the vicinity. Many people visit the town because of its 
                      resorts and historical landmarks such as the Huseng Batute Marker and La Purisima Concepcion Parish Church.</h5>

                <p class="w3-text-black">Why Alegra Heights is the perfect choice? for you
                You can achieve your dream of becoming a proud homeowner in Alegra Heights 
                by Borland Development Corporation.  The community offers quality homes for 
                reasonable prices that don’t skimp on quality and comfort. These homes are made
                 easier to purchase thanks to the many flexible payment schemes offered to you. 
                 Whether you’re seeking to buy your first property or upgrading from a small residential 
                 property, you’re sure to find your dream home here.</p>
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
                <a href="report.php"><p style="color: black; font-size: 18px; padding-left: 5%;">Complaints</p></a>
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