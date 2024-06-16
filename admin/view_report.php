    <?php
    session_start();
    include_once("class/adminback.php");
    include_once("class/db.php");
    $obj = new adminback();

    $admin_id = $_SESSION['id'];
    $admin_name = $_SESSION['name'];
    $profile = $_SESSION['profile'];

    if (empty($admin_id)) {
    header("location:admin-login.php");
    }


    $members = $obj->display_member();



    if(isset($_GET['status'])){
        $id = $_GET['id'];
        if($_GET['status']=="delete"){
        $del_msg = $obj->delete_member($id);
        }
    }

    if(isset($_GET['status'])){
    if($_GET['status']=='view'){
    $rep_id = $_GET['id'];
    $rep = $obj->display_rep_id($rep_id);
    $reply = $obj->display_reply_id($rep_id);
    $us = mysqli_fetch_assoc($reply);
    }
    }

    if(isset($_POST['update_profile'])){
    $profile = $obj->update_profile($_POST);
    }

    if(isset($_POST['update_mem'])){
    $profile = $obj->update_mem_info($_POST);
    }


    if(isset($_POST['reply'])){
        $msg = $obj->reply($_POST);
    
    }

    ?>


    <!DOCTYPE html>
    <html lang="en">

    <?php include('header.php')?>

    <style>

    </style>
<body class="toggle-sidebar">
<?php include('sidebar.php')?>
    <?php include('headnav.php')?>


    <main id="main" class="main">
    <div style="margin-left: 17%;">
    <button style="color:#e9e5d6; background-color: #0080c0;" type="button" onclick="history.back()" class="btn">
    <div style="font-size: 18px;"class="icon">
                            <i class="bx bx-arrow-back"></i> Go back
                        </div></button>
    </div>
    <div class="pagetitle">

    <br>
    <h2>Complaint Id: <?php echo $rep['rep_id']; ?></h2>
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
                <img  src="report_img/<?php echo $rep['report_img']; ?>">
                </div>

            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                    <br>
                    <h4 style="font-weight:800; text-transform:uppercase;" class=""><?php echo $rep['title']; ?></h4>
                    <h5 style="" class="">BY: <?php echo $rep['user']; ?></h5>
                    <h5 style="" class="">Date: <?php echo  date("Y-m-d h:i:s a",strtotime($rep['date_added'])) ?></h5>
                    <br>
                    <h5><?php echo $rep['description']; ?></h5>
                    </div>
                </div>
            </div>
    </div>

    <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                    <i class="fa-solid fa-reply"></i>  Reply
                </button>
                    <hr>
                    <?php

                    $query = mysqli_query($conn,"SELECT * FROM reply
                                                LEFT JOIN members ON members.id = reply.user_id
                                                LEFT JOIN users ON users.id = reply.user_id where report_id = '$id'")or die(mysqli_error($conn));

                while ($mem = mysqli_fetch_array($query)) {

                ?>
                    <?php
                    if($mem['user_id'] == 0){
                            echo "<img style='position: absolute; border-radius: 50%; width: 100px; height: 100px;' src='user_img/admin.png' alt=''>";
                                }
                                else{

                            ?>
                <img style="position: absolute; border-radius: 50%; width: 100px; height: 100px;" src="user_img/<?php echo $mem['user_image']; ?>" alt="">
                <?php } ?>
                <p style="position: relative; margin-left: 120px;" class=""><?php echo $mem['reply']; ?></p>
                <p style="position: relative;margin-left: 120px; font-size: 15px; color: #6c6c6c;" class="">BY: <?php echo $mem['user']; ?></p>
                <p style="position: relative;margin-left: 120px; font-size: 15px; color: #6c6c6c;" class=""><?php echo date("Y-m-d h:i:s a",strtotime($mem['date'])) ?></p>
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
        <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">

                        <h5 class="modal-title">
                        <div style="font-size: 24px;"class="icon">
                            <i class="bx bxs-comment-dots"></i>
                        </div></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
            <label for="validationCustom02" class="form-label">Reply</label>
            <textarea name="des" type="text" class="form-control" id="validationCustom02" required></textarea>
            <div class="invalid-feedback">
            Please enter valid reply.
            </div>
            <input name="admin" type="hidden"  value="Administrator" required>
            <input name="report_id" type="hidden" value="<?php echo $rep_id; ?>" required>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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