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


if(isset($_GET['status'])){
    if($_GET['status']=='edit'){
        $id = $_GET['id'];
       $srvc = $obj->display_projetcbyid($id);
    }
}
    if(isset($_POST['update_project'])){
        $up_msg = $obj->update_project($_POST);
        header("Location: manage_project.php");
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
    <a href="manage_project.php"><button style="color:#e9e5d6; background-color: #0080c0;" type="button" onclick="history.back()" class="btn">
    <div style="font-size: 18px;"class="icon">
                            <i class="bx bx-arrow-back"></i> Go back
                        </div></button></a>
    </div>
    <div class="pagetitle">
        <h1>Edit Project</h1></h1>
<br>
    </div><!-- End Page Title -->
    <section class="home-section">
    <div class="row">
    <div style="margin: auto;" class="col-lg-8">

    <div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>
       
        <form action="" method="POST" enctype="multipart/form-data" >

    <div class="form-group">
        <label for="u_srvc_name">Project Name</label>
        <input  type="text" name="title" class="form-control" value="<?php echo $srvc['project'] ?>">
    </div>
    <br>
    <div class="form-group">
        <label for="u_srvc_des">Description</label>
        <textarea  name="des" cols="30" rows="10" class="form-control" Placeholder=><?php echo $srvc['description']?> </textarea>
    </div>
    <br>
    <div class="form-group">
        <label for="u_srvc_price">Start Date</label>
        <input required type="date" id="" name="start_date" class="form-control"  value="<?php echo $srvc['start_date'] ?>">
    </div>
    <br>
    <div class="form-group">
        <label for="u_srvc_price">End Date</label>
        <input required type="date" id="txtDate1" name="end_date" class="form-control"  value="<?php echo $srvc['deadline'] ?>">
    </div>
    <br>
    <div class="form-group">
        <label for="u_srvc_status">Project Status</label>
        <select required name="project_status" class="form-control">
            <option selected disabled value="">Select Status</option>
            <option value="0" <?php if($srvc['status']==1) ?> >Pending</option>
            <option value="1" <?php if($srvc['status']==1) ?> >Started</option>
            <option value="2" <?php if($srvc['status']==2) ?> >On Progress</option>
            <option value="3" <?php if($srvc['status']==3) ?> >Cancelled</option>
            <option value="5" <?php if($srvc['status']==5) ?> >Done</option>
        </select>
    </div>

    <br><br>
    <input type="hidden" name="u_id" value="<?php echo $srvc['id'] ?>" >

    <input type="submit" value="Update Project" name="update_project" class="btn btn-success" >
    <a href="javascript:history.go(-1)"><input type="cancel" value="Cancel" name="cancel_update" class="btn btn-danger" ></a>
        </form>
    </section>
</main>


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
    $('#txtDate1').attr('min', maxDate);
});
        </script>

    <!-- ======= Footer ======= -->

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








