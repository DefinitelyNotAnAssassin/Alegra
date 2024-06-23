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

$one = $obj->display_memberone();
$two = $obj->display_membertwo();
$three = $obj->display_memberthree();
$four = $obj->display_memberfour();
$five = $obj->display_memberfive();
$six = $obj->display_membersix();
$seven = $obj->display_memberseven();
$eight = $obj->display_membereight();
$nine = $obj->display_membernine();
$ten = $obj->display_memberten();

?>


<!DOCTYPE html>
<html lang="en">

<?php include('header.php')?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js">

    <style>
        .chart-container {
            background-color: white;
            padding: 20px;
            margin: 100px;
        }

        #project_overview_chart { max-height: 440px }
    </style>

    <!-- Lodash - Array Helper -->
    <script src='https://cdn.jsdelivr.net/lodash/4.17.2/lodash.min.js'></script>
    <!-- Moments - Datetime Helper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        moment().format();
    </script>

    <body class="toggle-sidebar">
<!-- ======= Sidebar ======= -->
<?php include('sidebar.php')?>
<?php include('headnav.php')?>

  
  <?php include('dashboard.php') ?>
  
  <script>
    $(document).ready(function () {
    $('#example').DataTable();
});

$(document).ready(function () {
    $('#example2').DataTable();
});

$(document).ready(function () {
    $('#example3').DataTable();
});

$(document).ready(function () {
    $('#example4').DataTable();
});

$(document).ready(function () {
    $('#example5').DataTable();
});

$(document).ready(function () {
    $('#example6').DataTable();
});

$(document).ready(function () {
    $('#example7').DataTable();
});

$(document).ready(function () {
    $('#example8').DataTable();
});

$(document).ready(function () {
    $('#example9').DataTable();
});

$(document).ready(function () {
    $('#example10').DataTable();
});
    </script>

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