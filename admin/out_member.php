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




$members = $obj->display_memberout();


if(isset($_GET['status'])){
    $id = $_GET['id'];
    if($_GET['status']=="delete"){
       $del_msg = $obj->delete_member($id);
    }
}

if(isset($_GET['status'])){
    $id = $_GET['id'];
    if($_GET['status']=="update"){
       $del_msg = $obj->update_mem_stat_a($id);
    }
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
  <h1>INACTIVE MEMBERS</h1>

</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div style="margin: auto;" class="col-lg-8">

    <br>
    <br>
      <div class="card">
        <div class="card-body">
            <br>
          <!-- Table with stripped rows -->
          <div class="table-wrapper">
          <table id="example" class="table table-striped table-hover datatable" >

            <thead>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Block #</th>
                <th scope="col">Lot #</th>
                <th scope="col">Action</th>
            </thead>

            <tbody>
            <?php
    while ($mem = mysqli_fetch_assoc($members)){
        ?>
              <tr>
                <th scope="row"><img style="border-radius: 50%; width: 100px; height: 100px;" src="user_img/<?php echo $mem['user_image']; ?>" alt=""></th>
                <td><?php echo $mem['first_name']." ".$mem['last_name'] ?></td>
                <td><?php echo $mem['block_number']; ?></td>
                <td><?php echo $mem['lot_number']; ?></td>
                <td style="text-align: center;">
                <a href="view_member.php?status=view&&id=<?php echo $mem['id'] ?>" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                <a href="view_member.php?status=view&&id=<?php echo $mem['id'] ?>" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="?status=delete&&id=<?php echo $mem['id'] ?>" onclick="return confirm('Are you sure you want to delete this member? NOTE: This action cannot be undone.')"  type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
                <br>
                <br>
                <a href="?status=update&&id=<?php echo $mem['id'] ?>" onclick="return confirm('Are you sure you want activate this member?')"  type="button" class="btn btn-success"><i class="fa-solid fa-user-large"></i> Activate</button></a>
            </td>
              </tr>

            <?php
            }
              ?>
            </tbody>
          </table>
          </div>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

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

  <script>

       
$(document).ready(function() {
    $('#example tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    var table = $('#example').DataTable({
        searchPanes: {
            viewTotal: true
        },
        dom: 'Plfrtip'
    });
 
     table.columns().every( function() {
        var that = this;
  
        $('input', this.footer()).on('keyup change', function() {
            if (that.search() == this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
});
</script>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>