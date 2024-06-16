<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();

$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_projectadmin();

if(isset($_GET['status'])){
  if($_GET['status']=='view'){
  $per_id = $_GET['id'];
  $pr = $obj->display_projetcbyid($per_id);
  $tsk = $obj->display_taskmember($per_id);
  $prjcon = $obj->display_prjpgrs_con($per_id);

  }
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


    <main id="main" class="main">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <section class="section">

            <section class="section profile">
                <div class="row">
                    <div style="margin:auto;" class="col-xl-10">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>

                                <!-- Slides with indicators -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="admin/project_img/<?php echo $pr['site_pic']?>"
                                                class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="admin/project_img/<?php echo $pr['site_pic1']?>"
                                                class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="admin/project_img/<?php echo $pr['site_pic2']?>"
                                                class="d-block w-100" alt="...">
                                        </div>
                                    </div>

                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                </div><!-- End Slides with indicators -->

                            </div>
                        </div>

                        <?php

                        if(isset($_SESSION['id'])){

                            ?>
                        <button
                            style="width: 3 q0%;color:#e9e5d6; background-color: #008000; margin-bottom: 10px; margin-right: 12px;"
                            type="button" data-bs-toggle="modal" data-bs-target="#prjhistory" class="btn">
                            <i class="fa-solid fa-eye"></i> View Project
                            Contribution</button>
                        <br>
                        <br>
                        <?php
                                                        }else{

} ?>



                        <div class="col-xl-12">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Overview</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Project Status</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-change-password">Project Members</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <h5 class="card-title">About</h5>
                                            <p class="small fst-italic"><?php echo $pr['description']?></p>

                                            <h5 class="card-title">Project Details</h5>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Date Starded</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <?php echo date('F d Y', strtotime($pr['start_date']))?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Deadline</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <?php echo date('F d Y', strtotime($pr['deadline']));?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Overall Cost</div>
                                                <div class="col-lg-9 col-md-8">₱ <?php echo $pr['overall_cost']?></div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                            <!-- Profile Edit Form -->


                                            <div class="tab-pane fade show active profile-overview"
                                                id="profile-overview">
                                                <h5 class="card-title">Status</h5>
                                                <p class="small fst-italic"><?php
                  if($pr['status']==0){
echo "<p style='background-color:rgb(235, 235, 23); color: white; padding:5px;
text-transform: uppercase; font-weight: bold;'> Pending </p>";
}
elseif ($pr['status']==1){
echo "<p style='background-color:rgb(106, 163, 55); color: white; padding:5px;
text-transform: uppercase; font-weight: bold;'> Started </p>";
}
elseif ($pr['status']==2){
	echo "<p style='background-color:rgb(23, 171, 212); color: white; padding:5px;
	text-transform: uppercase; font-weight: bold;'> On Progress </p>";
	}
elseif ($pr['status']==4){
echo "<p style='background-color:rgb(23, 171, 212); color: white; padding:5px;
text-transform: uppercase; font-weight: bold;'> On Progress </p>";
}
elseif ($pr['status']==3){
echo "<p style='background-color:rgb(240, 10, 44); color: white; padding:5px;
text-transform: uppercase; font-weight: bold;'> Cancelled </p>";
}   else {
echo "<p style='background-color: rgb(51, 145, 87); color: white; padding:5px;
text-transform: uppercase; font-weight: bold;'> Done </p>";
}?></p>

                                                <h5 class="card-title">Task Details</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-condensed m-0 table-hover datatable">

                                                        <thead>
                                                            <th>#</th>
                                                            <th>Task</th>
                                                            <th>Assigned to</th>
                                                            <th style="width: 30%;">Description</th>
                                                            <th>Deadline</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
							$i = 1;
							$tasks = $conn->query("SELECT * FROM task_list where project_id = {$per_id} order by id asc");
							while($row=$tasks->fetch_assoc()):
								$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
								unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
								$desc = strtr(html_entity_decode($row['description']),$trans);
								$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
							?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $i++ ?></td>
                                                                <td class=""><b><?php echo ucwords($row['task']) ?></b>
                                                                </td>
                                                                <td class=""><b><?php echo ucwords($row['staff']) ?></b>
                                                                </td>
                                                                <td class="">
                                                                    <p class="truncate"><?php echo strip_tags($desc) ?>
                                                                    </p>
                                                                </td>
                                                                <td class="">
                                                                    <b><?php echo ucwords($row['deadline']) ?></b>
                                                                </td>
                                                                <td>
                                                                    <?php 
			                        	if($row['status'] == 1){
									  		echo "<span class='badge' style='background-color: rgb(235, 235, 23);'>Pending</span>";
			                        	}elseif($row['status'] == 2){
									  		echo "<span class='badge' style='background-color: rgb(23, 171, 212);'>On-Progress</span>";
			                        	}elseif($row['status'] == 3){
									  		echo "<span class='badge' style='background-color: rgb(59, 168, 37);'>Done</span>";
			                        	}
			                        	?>
                                                                </td>
                                                                <td class="">
                                                                    <a
                                                                        href="view_task.php?status=task&&id=<?php echo $row['id'] ?>">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal" data-bs-target="#two"
                                                                            data-mdb-backdrop="static"
                                                                            data-mdb-keyboard="true">
                                                                            <i class="fa-solid fa-eye"></i>
                                                                        </button></a>
                                                                </td>
                                                            </tr>

                                                            <?php
							endwhile;
							?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <!-- Change Password Form -->
                                            <?php
                                          while ($tt = mysqli_fetch_assoc($tsk)) {
                                              ?>
                                            <p style="padding-left: 10%;"><b><?php echo $tt['staff']?></b></p>
                                            <?php } ?>
                                        </div>


                                    </div>

                                </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Vertically centered Modal -->

            <div class="modal fade" id="prjhistory" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Project Contribution</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <table id="example9" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Contributor</th>
                                        <th>Amount</th>
                                        <th>Date Paid</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
    while ($ni = mysqli_fetch_assoc($prjcon)){
        ?>
                                    <tr>

                                        <td><?php echo $ni['first_name']." ".$ni['last_name'] ?></td>
                                        <td>₱<?php echo $ni['amount']; ?></td>
                                        <td><?php echo $ni['date_paid']; ?></td>

                                        <td style="max-width: 20%;">
                                            <?php
                                                                    if($ni['status'] == 0){
                                                                      echo "<span class='badge' style=' padding:10px; background-color: #f7ce2b;'>Unpaid</span>";
                                                                    }

                                                                    elseif($ni['status'] == 1){
                                                                      ?>
                                            <span class='badge'
                                                style='padding:10px;background-color: rgb(51, 145, 87);'>Paid</span>

                                            <?php

                                                                    }

                                                                    else{
                                                                      echo "<span class='badge' style='padding:10px; background-color: rgb(23, 171, 212);'>Partially Paid</span>";
                                                                    }

                                                                      ?>
                                        </td>

                                    </tr>
                                    <?php }
                 ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div><!-- End Vertically centered Modal-->


            



    </main><!-- End #main -->

    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-light-grey w3-opacity w3-xlarge" style=" margin-top:128px">
        <div class="w3-row w3-mobile" style="padding-left: 15%; ">

            <div class="w3-half w3-container">
                <a href="index.php"><img src="admin/assets/img/banner2.png" alt=""
                        style=" margin-top:0; width: 20%; height: 10%;"></a>
                <p style="font-size: 25px;"><b>Quick Links</b></p>
                <a href="reserve.php">
                    <p style="color: black;font-size: 18px; padding-left: 5%;">Reservation</p>
                </a>
                <a href="report.php">
                    <p style="color: black; font-size: 18px; padding-left: 5%;">Report Issue</p>
                </a>
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