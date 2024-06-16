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


if(isset($_GET['status'])){
  if($_GET['status']=='edit'){
      $id = $_GET['taskid'];
     $tsk = $obj->display_taskbyid($id);
     
  }
}

if(isset($_POST['update_task'])){
  $msg = $obj->update_task($_POST);

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


<div style="margin-left: 17%;">
    <a href="project_progress.php?status=view&&id=<?php echo $tsk['project_id'] ?>">
    <button style="color:#e9e5d6; background-color: #0080c0;" type="button" class="btn">
    <div style="font-size: 18px;"class="icon">
                            <i class="bx bx-arrow-back"></i> Go back
                        </div></button></a>
    </div>
<div class="pagetitle">
    <h1>Edit Task</h1></h1>

</div><!-- End Page Title -->
<section class="home-section">

<div style="margin: auto;" class="col-xl-8">
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

    <input type="hidden"  name="tsk_id" value="<?php echo $tsk['id'] ?>">

      <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Task</label>
        <input name="task" type="text" class="form-control" id="validationCustom01" value="<?php echo $tsk['task'] ?>" required>
        <div class="invalid-feedback">
        Please enter task title.
        </div>
      </div>


      <div class="col-md-12">
      </div>


      <div class="col-md-12">
      </div>

      <div class="col-md-12">
        <label for="validationCustom02" class="form-label">Description</label>
        <textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required><?php echo $tsk['description'] ?></textarea>
        <div class="invalid-feedback">
        Please enter valid description.
        </div>
      </div>



      <div class="col-md-12">
      </div>



      <div class="col-md-12">
      </div>


      <div class="col-md-12">
        <label for="validationCustomUsername" class="form-label">Deadline</label>
        <div class="input-group has-validation">
          <input name="end" type="date" class="form-control" value="<?php echo $tsk['deadline'] ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
          <div class="invalid-feedback">
            Please choose a deadline.
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <label for="validationCustomUsername" class="form-label">Project Status</label>
        <div class="input-group has-validation">
        <select required name="task_status" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
            <option selected disabled value="">Select Status</option>
            <option value="1" <?php if($tsk['status']==1) ?> >Pending</option>
            <option value="2" <?php if($tsk['status']==2) ?> >On Progress</option>  
            <option value="3" <?php if($tsk['status']==3) ?> >Done</option>
        </select>
          <div class="invalid-feedback">
            Please choose a status.
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <label for="start_date" class="form-label">Start Date</label>
        <div class="input-group has-validation">
            <input name="start_date" type="date" class="form-control" id="start_date"
                aria-describedby="inputGroupPrepend" value="<?php echo $tsk['start_date'] ?>">
        </div>
      </div>

      <div class="col-md-12">
        <label for="estimated_cost" class="form-label">Estimated Cost</label>
        <div class="input-group has-validation">
            <input name="estimated_cost" type="text" class="form-control" id="estimated_cost"
                aria-describedby="inputGroupPrepend" value="<?php echo $tsk['estimated_cost'] ?>" required>
            <div class="invalid-feedback">
                Please input the estimated cost.
            </div>
        </div>
      </div>

      <div class="col-md-12">
        <label for="actual_cost" class="form-label">Actual Cost</label>
        <div class="input-group has-validation">
            <input name="actual_cost" type="text" class="form-control" id="actual_cost"
                aria-describedby="inputGroupPrepend" value="<?php echo $tsk['actual_cost'] ?>">
            <div class="invalid-feedback">
                Please input the actual cost.
            </div>
        </div>
      </div>


      <div class="col-12">
        <button name="update_task" class="btn btn-primary" type="submit">Update Task</button>
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