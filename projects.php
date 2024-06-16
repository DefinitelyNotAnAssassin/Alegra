<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();


$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_project();
?>



<!DOCTYPE html>

<html lang="en">
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

    <main id="main" class="main" style="margin: 5% auto auto auto;">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <section class="section">

            <form action="" autocomplete="" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="row" >
                        <div class="container"  >
                            <div class="input-group">
                                <input style="border-radius: 0; -webkit-border-radius: 0; -moz-border-radius: 0; margin-left: auto; margin-right: 0; max-width: 300px;" name="search" placeholder="Search Project Name" type="text"
                                    minlength="4" class="form-control w3-mobile" autocomplete="off" required />
                                <div class="input-group-append">
                                    <button style="border-radius: 0; -webkit-border-radius: 0; -moz-border-radius: 0;" class="btn btn-primary" type="submit"><i
                                            class="fa-solid fa-search"></i></button>
                                    <a href="projects.php"><button class="btn btn-danger" type="button" style=" border-radius: 0; -webkit-border-radius: 0; -moz-border-radius: 0;">Clear</button></a>
                                </div>
                            </div>

                            <br>
                        </div>

            </form>


            <?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $keyword = $_POST['search'];

    $query1 = mysqli_query($conn, "SELECT * FROM `projects` WHERE `project` LIKE '%$keyword%'");

    if (mysqli_num_rows($query1) > 0) {
      while ($row = mysqli_fetch_array($query1)) {

        $p_id = $row["id"];
        $p_name1 = $row["project"];
        $p_img1 = $row["site_pic"];
        $p_des = $row["description"];
      }
    } else {
      echo "<center><h3 style=' font-size: 1.5rem;  opacity: 0.9; font-weight: 400; color: #e0a24e!important;'>Project</h3></center>";
      $p_id = "";
      $p_name1 = "";
      $p_img1 = "";
      $p_des = "";
    }

  ?>
            <div class="w3-row-padding">


                <div class="w3-third w3-container w3-margin-bottom">
                    <a href="view_project.php?status=view&&id=<?php echo $p_id ?>"><img
                            src="admin/project_img/<?php echo $p_img1 ?>" alt="Norway"
                            style="width: 400px; height: 300px;" class="w3-hover-opacity"></a>
                    <div class="w3-container w3-white" style="height: 100px; overflow-y: scroll;">
                        <p><b><?php echo $p_name1 ?></b></p>
                        <p><?php echo $p_des ?></p>
                    </div>
                </div>
            </div>


            <?php
  } else {
    ?>
            <div class="w3-row-padding">
                <?php
      while ($mem = mysqli_fetch_assoc($prj1)) {
    ?>
                <div class="w3-third w3-container w3-margin-bottom">
                    <a href="view_project.php?status=view&&id=<?php echo $mem['id'] ?>"><img
                            src="admin/project_img/<?php echo $mem['site_pic']?>" alt="Norway"
                            style="width: 415px; height: 300px;" class="w3-hover-opacity"></a>
                    <div class="w3-container w3-white" style="width: 415px; height: 100px; overflow-y: scroll;">
                        <p><b><?php echo $mem['project']?></b></p>
                        <p><?php echo $mem['description']?></p>
                    </div>
                </div>
                <?php } ?>
            </div>

            <?php
  }


  ?>


        </section>



    </main><!-- End #main -->

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
    <!--
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits"> -->
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    <!--  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer> End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

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