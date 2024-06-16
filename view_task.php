<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();


$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_project();

if(isset($_GET['status'])){
  if($_GET['status']=='task'){
  $task_id = $_GET['id'];
  $pr = $obj->display_taskbyid($task_id);

  }
}

?>

<!DOCTYPE html>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="js/jquery-3.5.1.min.js"></script>
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

.modal-backdrop {background: none;}
 .modal{background: none;}

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


    <main   id="main" class="main" style="margin: 5% auto auto auto; ">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <div style="background-color:#c8e2a7;" class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false" aria-hidden="true">
            <!-- Add this line to your code -->
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel"><?php echo $pr['task']; ?></h3>
                    </div>
                    <div class="modal-body">
                        <label>Task Assigned To:</label> <br><br>
                        <p style="font-weight:800; font-size: 17px;"> <?php echo $pr['staff']; ?> </p>
                        <label>Description:</label> <br><br>
                        <p>
                         <?php echo $pr['description']?>
                        </p>
                        <p> Status :
                            <?php
                            if($pr['status']==1){
                                echo "<p style='background-color:rgb(235, 235, 23); color: white; padding:5px;
                                text-transform: uppercase; font-weight: bold; width: 70%;'> Pending </p>";
                            }
                            elseif ($pr['status']==2){
                                echo "<p style='background-color:rgb(23, 171, 212); color: white; padding:5px;
                                text-transform: uppercase; font-weight: bold;width: 70%;'> On Progress </p>";
                            }
                            elseif ($pr['status']==3){
                                echo "<p style='background-color: rgb(51, 145, 87); color: white; padding:5px;
                                text-transform: uppercase; font-weight: bold; width: 70%;'> Done </p>";

                            }
                            else {
                                echo "<p style='background-color: rgb(51, 145, 87); color: white; padding:5px;
                                text-transform: uppercase; font-weight: bold; width: 70%;'> Done </p>";
                                }?>
                    </p>

                    <p>
                        Progress:
                        <?php
                            if($pr['status']==1){
                                echo "<div class='progress mt-3' style='height: 20px; width: 70%;'>
                                <div class='progress-bar progress-bar-striped bg-success progress-bar-animated' role='progressbar' style='width: 0%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                                </div>";
                            }
                            elseif ($pr['status']==2){
                                echo "<div class='progress mt-3' style='height: 20px; width: 70%;'>
                                <div class='progress-bar progress-bar-striped bg-info progress-bar-animated' role='progressbar' style='width: 50%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                                </div>";
                            }
                            elseif ($pr['status']==3){
                                echo "<div class='progress mt-3' style='height: 20px; width: 70%;'>
                                <div class='progress-bar progress-bar-striped bg-success progress-bar-animated' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                                </div>";

                            }
                            else {
                                echo "<p style='background-color: rgb(51, 145, 87); color: white; padding:5px;
                                text-transform: uppercase; font-weight: bold;'> Done </p>";
                                }?>
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- import jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--Modal JS Script -->
    <script>
    $(document).ready(function(){
        $("#disablebackdrop").modal('show');

    });
</script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>