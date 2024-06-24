p<?php
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


$members = $obj->display_prj_fee();



if(isset($_GET['status'])){
    $id = $_GET['id'];
    if($_GET['status']=="delete"){
       $del_msg = $obj->delete_member($id);
    }
}

if(isset($_POST['add_mem'])){
  $profile = $obj->add_member($_POST);
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
  <h1>PROJCET CONTRIBTION PAYMENT LOG</h1>
  <br>
</div><!-- End Page Title -->
<br>
<section class="section dashboard">
  <div class="row">
    <div style="margin: auto;" class="col-lg-8">

    <div class="row">


<br>
      <div class="card">
        <div class="card-body">
            <br>
          <!-- Table with stripped rows -->
          <div class="table-wrapper">
          <table id="example" class="table table-striped table-hover datatable">

            <thead>
                <th scope="col">Name</th>
                <th scope="col">Project Name</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Date Paid</th>
                <th scope="col">Action</th>
            </thead>

            <tbody>
            <?php
    while ($mem = mysqli_fetch_assoc($members)){
        ?>
              <tr>
                <td><?php echo $mem['first_name']." ".$mem['last_name'] ?></td>
                <td><?php echo $mem['project_name']; ?></td>
                <td>₱ <?php echo $mem['amount']; ?></td>
                <td><?php echo $mem['date_paid']; ?></td>
                <td>
                <a href="view_member.php?status=view&&id=<?php echo $mem['id'] ?>" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
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

           <center>
  <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">Overall <span>| Amount</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: #38a3f1; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="ps-3">

                    <?php
 // $type="Membership Fee";
//$result = mysqli_query($conn, "SELECT SUM(amount) AS value_sum FROM payment_log WHERE type='$type'");
//$row = mysqli_fetch_assoc($result);
//$sum = $row['value_sum'];
  // ?>

                      <h1 style="font-weight: 800;">₱ <?php //echo $sum ?></h1>
                    </div>
                  </div>
                </div>

              </div>
            </div>
    </center>
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