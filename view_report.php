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


    if(isset($_GET['status'])){
    if($_GET['status']=='view'){
    $rep_id = $_GET['id'];
    $rep = $obj->display_rep_id($rep_id);
    $reply = $obj->display_reply_id($rep_id);
    $us = mysqli_fetch_assoc($reply);
    }
    }

    if(isset($_POST['reply'])){
        $msg = $obj->reply_user($_POST);

    }

    if(isset($_POST['update_rep'])){
        $profile = $obj->update_rep_stat_id($_POST);
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Import jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="admin/clndr/fullcalendar/fullcalendar.min.css" />
    <script src="admin/clndr/fullcalendar/lib/jquery.min.js"></script>
    <script src="admin/clndr/fullcalendar/lib/moment.min.js"></script>
    <script src="admin/clndr/fullcalendar/fullcalendar.min.js"></script>

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

#calendar {
    padding: 0 10% 0 10%;
    width: 80%;
    background-color: white;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
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
                <a href="bulletin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i
                        class="fa-solid fa-chalkboard"></i> Bulletin</a>
                <a href="gl.php"
                    class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Guideline</a>
            </div>

            <!-- Navbar on small screens -->
            <div id="navDemo" style="background-color:#c8e2a7;"
                class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large">
                <a href="bulletin.php" class="w3-bar-item w3-button w3-padding-large"><i
                        class="fa-solid fa-chalkboard"></i>
                    Bulletin</a>
                <a href="gl.php" class="w3-bar-item w3-button w3-padding-large">Guideline</a>
            </div>
        </div>


        <main id="main" class="main" style="margin: 55px auto 0 auto;">

            <div style="margin-left: 17%;">
                <button style="color:#e9e5d6; background-color: #0080c0;" type="button" onclick="history.back()"
                    class="btn">
                    <div style="font-size: 18px;" class="icon">
                        <i class="bx bx-arrow-back"></i> Go back
                    </div>
                </button>
            </div>
            <div class="pagetitle">

                <br>
                <h2>Report Id: <?php echo $rep['rep_id']; ?></h2>
                <br>

                <br>
                <br>
            </div><!-- End Page Title -->
            <?php
        if(isset($msg)){
            echo $msg;
        }
    ?>
            <section class="section">
                <div style="margin: auto;" class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-6">

                            <div class="card">
                                <img src="admin/report_img/<?php echo $rep['report_img']; ?>">
                            </div>

                        </div>

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h4 style="font-weight:800; text-transform:uppercase;" class="">
                                        <?php echo $rep['title']; ?></h4>
                                    <h5 style="" class="">BY: <?php echo $rep['user']; ?></h5>
                                    <h5 style="" class="">Date:
                                        <?php echo  date("Y-m-d h:i:s a",strtotime($rep['date_added'])) ?></h5>
                                    <br>
                                    <h5><?php echo $rep['description']; ?></h5>
                                    <br>
                                    <h5>STATUS:</h5>
                                    <?php
                            if($rep['status'] =='0'){
                              echo "<span class='badge' style= 'text-align:center;padding:10px; background-color: #f7ce2b ;'>UNREAD</span>";
                            }elseif($rep['status'] =='1'){
                              echo "<span class='badge' style='padding:10px; background-color:rgb(23, 171, 212);'>INVESTIGATING</span>";
                            }elseif($rep['status'] =='2'){
                              echo "<span class='badge' style='padding:10px; background-color:  rgb(106, 163, 55);'>RESOLVED</span>";
                            }elseif($rep['status'] =='3'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(240, 10, 44);'>UNRESOLVE</span>";
                            }
                          ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered">
                                    <i class="fa-solid fa-reply"></i> Reply
                                </button>
                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#res"
                                                    class="btn btn-warning edit-item-btn"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                <hr>
                                <?php

                    $query = mysqli_query($conn,"SELECT * FROM reply
                                                LEFT JOIN members ON members.id = reply.user_id
                                                LEFT JOIN users ON users.id = reply.user_id where report_id = '$rep_id'")or die(mysqli_error($conn));

                while ($mem = mysqli_fetch_array($query)) {

                ?>
                                <?php
                    if($mem['user_id'] == 0){
                            echo "<img style='position: absolute; border-radius: 50%; width: 100px; height: 100px;' src='admin/user_img/admin.png' alt=''>";
                                }
                                else{

                            ?>
                                <img style="position: absolute; border-radius: 50%; width: 100px; height: 100px;"
                                    src="admin/user_img/<?php echo $mem['user_image']; ?>" alt="">
                                <?php } ?>
                                <p style="position: relative; margin-left: 120px;" class=""><?php echo $mem['reply']; ?>
                                </p>
                                <p style="position: relative;margin-left: 120px; font-size: 15px; color: #6c6c6c;"
                                    class="">BY: <?php echo $mem['user']; ?></p>
                                <p style="position: relative;margin-left: 120px; font-size: 15px; color: #6c6c6c;"
                                    class=""><?php echo date("Y-m-d h:i:s a",strtotime($mem['date'])) ?></p>
                                    <img style="" src="admin/report_img/<?php echo $mem['img']; ?>" alt="">
                                <hr>
                                <?php
                } ?>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
                </div>
            </section>
            <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
                enctype="multipart/form-data">
                <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title">
                                    <div style="font-size: 24px;" class="icon">
                                        <i class="bx bxs-comment-dots"></i>
                                    </div>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <label style=" margin-left: 4%;" for="validationCustom02" class="form-label">Reply</label>
                                    <textarea  style=" margin-left: 4%; width: 90%;" name="des" type="text" class="form-control" id="validationCustom02"
                                        required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter valid reply.
                                    </div>

                            <div class="col-md-12">
                                <label for="Email" class="col-form-label">Upload Image (when requested)</label>
                                <input type="file" class="form-control" name="proof" placeholder="Subject">
                            </div>

                                    <input name="user" type="hidden" value="<?php echo $mem_name; ?>" required>
                                    <input name="report_id" type="hidden" value="<?php echo $rep_id; ?>" required>
                                    <input name="u_id" type="hidden" value="<?php echo $mem_id; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="reply" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main><!-- End #main -->
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

    <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal fade" id="res" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Report Status</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                <input name="report_id" type="hidden" value="<?php echo $rep_id; ?>" required>
                                                    <label class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">

                                                        <select name="stat" class="form-select" multiple
                                                            aria-label="multiple select example">
                                                            <option value="2">Resolved</option>
                                                            <option value="3">Unresolve</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                                <button name="update_rep" class="btn btn-warning" type="submit"><i
                                                        class="fa-solid fa-pen"></i> Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

    </body>

    </html>