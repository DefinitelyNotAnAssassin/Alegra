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

date_default_timezone_set("Asia/Dhaka");

    if(isset($_POST['add_prj'])){
      $msg = $obj->add_project($_POST);

    }

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

</style>
<body class="toggle-sidebar">
<?php include('sidebar.php')?>
<?php include('headnav.php')?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Add Project</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Project</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
      <div class="row">
      <div class="col-lg-12">

<div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>


    <!-- Custom Styled Validation -->
    <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

    <h5>Project Picture: </h5>

    <div class="col-md-4">
        <input name="profile" type="file" class="form-control" id="validationCustom01" value="" required>
        <div class="invalid-feedback">
        Please upload project picture.
        </div>
      </div>

      <div class="col-md-4">
        <input name="profile1" type="file" class="form-control" id="validationCustom01" value="" required>
        <div class="invalid-feedback">
        Please upload project picture.
        </div>
      </div>


      <div class="col-md-4">
        <input name="profile2" type="file" class="form-control" id="validationCustom01" value="" required>
        <div class="invalid-feedback">
        Please upload project picture.
        </div>
      </div>



    <h5>Project Information: </h5>

      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Project Title</label>
        <input name="title" type="text" class="form-control" id="validationCustom01" value="" required>
        <div class="invalid-feedback">
        Please enter valid project title.
        </div>
      </div>




      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Location</label>
        <input name="location" type="text" class="form-control" id="validationCustom02" value="" required>
        <div class="invalid-feedback">
        Please provide valid location.
        </div>
      </div>


      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Overall Cost</label>
        <input name="cost" type="number" class="form-control" id="validationCustom02" value="" required>
        <div class="invalid-feedback">
        Please provide valid amount.
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Description</label>
        <textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required></textarea>
        <div class="invalid-feedback">
        Please enter valid description.
        </div>
      </div>






      <div class="col-md-4">
      </div>


      <h5>Date Details: </h5>
      <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label">Start Date</label>
        <div class="input-group has-validation">
          <input name="start" type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
          <div class="invalid-feedback">
            Please choose a starting date.
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label">Deadline</label>
        <div class="input-group has-validation">
          <input name="end" type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
          <div class="invalid-feedback">
            Please choose a deadline.
          </div>
        </div>
      </div>




      <div class="col-12">
        <button name="add_prj" class="btn btn-primary" type="submit">Add Project</button>
      </div>
    </form><!-- End Custom Styled Validation -->

  </div>
</div>
      </div>
    </section>

</main><!-- End #main -->
<script>
        $(document).ready(function()
        {
            setTimeout(function()
            {
                $('#message').hide();
            },3000);
        });
        
        //delete
        $(document).ready(function() {
        $("#deleteBtn").click(function() {
            $.ajax({
            type: "POST",
            url: "delete-service.php",
            data: { id: <?php echo $id; ?> },
            success: function(response) {
                $("#deleteModal").modal("hide");
                location.reload();
            }
            });
        });
        });
    </script>

    <script>
            $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);
    $('#txtDate').attr('min', maxDate);
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