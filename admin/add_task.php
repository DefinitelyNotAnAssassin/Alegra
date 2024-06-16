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


date_default_timezone_set("Asia/Dhaka");


if(isset($_GET['status'])){
	if($_GET['status']=='add'){
		$id = $_GET['id'];
	   $rsrv_info = $obj->display_projetcbyid($id);
	}
}


    if(isset($_POST['add_task'])){
      $msg = $obj->add_task($_POST);

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
    <h1>Add Task</h1></h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Add Task</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="home-section">

<div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>


    <!-- Custom Styled Validation -->
    <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

    <h6 class="text-success">
   <?php
     if(isset($msg)){
         echo $msg;
     }
   ?>

</h6>
    <h5>Task Information: </h5>

    <input type="hidden"  name="proj_id" value="<?php echo $rsrv_info['id'] ?>">

      <div class="col-md-8">
        <label for="validationCustom01" class="form-label">Task</label>
        <input name="task" type="text" class="form-control" id="validationCustom01" value="" required>
        <div class="invalid-feedback">
        Please enter task title.
        </div>
      </div>


      <div class="col-md-8">
      </div>


      <div class="col-md-8">
      </div>

      <div class="col-md-8">
        <label for="validationCustom02" class="form-label">Description</label>
        <textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required></textarea>
        <div class="invalid-feedback">
        Please enter valid description.
        </div>
      </div>



      <div class="col-md-8">
      </div>



      <div class="col-md-8">
      </div>


      <div class="col-md-8">
        <label for="validationCustomUsername" class="form-label">Deadline</label>
        <div class="input-group has-validation">
          <input name="end" type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
          <div class="invalid-feedback">
            Please choose a deadline.
          </div>
        </div>
      </div>




      <div class="col-12">
        <button name="add_task" class="btn btn-primary" type="submit">Add task</button>
      </div>
    </form><!-- End Custom Styled Validation -->

  </div>
</div>
      </div>
</section>
</main>
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

</footer><!-- End Footer -->

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