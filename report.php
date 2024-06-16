<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();

$mem_id = $_SESSION['id'];
$mem_name = $_SESSION['name'];
$profile = $_SESSION['user_image'];

if (empty($mem_id)) {
  header("location:mem_login.php");
}

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $user_info= $obj->display_member_id($id);
    $mem = mysqli_fetch_assoc($user_info);
}else{
header("location:mem_login.php");
}

$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_project();


if(isset($_POST['send_rep'])){
  $msg = $obj->add_report($_POST);

}
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


@media (min-width: 1025px) {
    .main {
        margin: 55px 15% 0 15%;
    }
}

@media (max-width: 480px) {
    .main {
        margin: 55px auto auto auto;

    }
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
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white">Home</a>
            <div class="w3-dropdown-hover" style="padding-top:4px; padding-bottom:4px;">
                <button class="w3-button w3-hover-white">Profile <i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block">
                    <a href="profile.php" class="w3-bar-item w3-button">My account</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
                </div>
            </div>
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


    <header class="" style="margin-top: 50px;">
        <img src="assets/img/talk.png" style=" max-width: 110%; height: auto;">
    </header>
    <main id="main" class="main">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <?php
        if(isset($msg)){
            echo $msg;
        }
      ?>

        <section class="section contact">
            <div style="margin: auto;" class=" col-xl-10">
                <div class="card p-4">
                    <form action="" method="post" class="row g-3 needs-validation" enctype="multipart/form-data"
                        novalidate>
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $id?>">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $mem_name?>"
                                    placeholder="Your Name" required>
                                <div class="invalid-feedback">
                                    Please provide a valid name.
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Type of Report</label>
                                <select name="type" class="form-select" style="padding: 2%;" required>
                                    <option selected>Type of report</option>
                                    <option value="Financial Matters">Financial Matters</option>
                                    <option value="Board Governance">Board Governance</option>
                                    <option value="Dispute Among Members">Dispute Among Members</option>
                                    <option value="Property Maintenance">Property Maintenance</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide type of reprot.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Subject of the
                                    report</label>
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                <div class="invalid-feedback">
                                    Please provide the subject of your report.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Description</label>
                                <textarea class="form-control" name="message" rows="6" placeholder="Message"
                                    required></textarea>
                                <div class="invalid-feedback">
                                    Please provide description of the report.
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Upload Image</label>
                                <input type="file" class="form-control" name="proof" placeholder="Subject">
                            </div>

                            <?php
                    $n = 10;
                    function getName($n)
                    {
                      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                      $randomString = '';

                      for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                      }

                      return $randomString;
                    }


              ?>
                            <input type="hidden" name="rep_id" value="<?php echo getName($n); ?>">

                            <div class="col-md-12 text-center">
                                <button name="send_rep" type="submit" class="btn btn-primary">Send Report</button>
                            </div>


                        </div>
                    </form>
                </div>

            </div>

            </div>

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