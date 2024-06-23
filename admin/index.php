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


<main id="main" class="main">

  
  <?php
    $sql = "SELECT * from household_members";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

    <div class="pagetitle">
      <h1>ALEGRA MEMBER INFORMATION</h1>
      <h5 class="card-title">Total Number of Members: <?php echo $rowcount;?> </h5>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8" style="margin: auto;">

        <div class="search-bar" style="">

        </div><!-- End Search Bar -->

        <br>

      <div class="row">
            <!-- Member Card -->
            <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 1</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from household where blk = 1 order by lot asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">

                    </div>

                  </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#one">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="one" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 1</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($on = mysqli_fetch_assoc($one)){
        ?>
            <tr>

                <td><?php echo ucwords($on['first_name']." ".$on['last_name']) ?></td>
                <td><?php echo $on['block_number']; ?></td>
                <td><?php echo $on['lot_number']; ?></td>

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


            <!-- -->

            <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 2</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 2 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>

                    <div class="ps-3">

                    </div>

                  </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#two">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="two" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 2</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example2" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($tw = mysqli_fetch_assoc($two)){
        ?>
            <tr>

                <td><?php echo ucwords($tw['first_name']." ".$tw['last_name']) ?></td>
                <td><?php echo $tw['block_number']; ?></td>
                <td><?php echo $tw['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 3</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 3 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#three">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="three" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 3</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example3" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($th = mysqli_fetch_assoc($three)){
        ?>
            <tr>

                <td><?php echo ucwords($th['first_name']." ".$th['last_name']) ?></td>
                <td><?php echo $th['block_number']; ?></td>
                <td><?php echo $th['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 4</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 4 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#four">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="four" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 4</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example4" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($fr = mysqli_fetch_assoc($four)){
        ?>
            <tr>

                <td><?php echo ucwords($fr['first_name']." ".$fr['last_name']) ?></td>
                <td><?php echo $fr['block_number']; ?></td>
                <td><?php echo $fr['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 5</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 5 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#five">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="five" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 5</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example5" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($fi = mysqli_fetch_assoc($five)){
        ?>
            <tr>

                <td><?php echo ucwords($fi['first_name']." ".$fi['last_name']) ?></td>
                <td><?php echo $fi['block_number']; ?></td>
                <td><?php echo $fi['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 6</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 6 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#six">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="six" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 6</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example6" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($si = mysqli_fetch_assoc($six)){
        ?>
            <tr>

                <td><?php echo ucwords($si['first_name']." ".$si['last_name']) ?></td>
                <td><?php echo $si['block_number']; ?></td>
                <td><?php echo $si['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 7</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 7 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seven">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="seven" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 7</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example7" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($se = mysqli_fetch_assoc($seven)){
        ?>
            <tr>

                <td><?php echo ucwords($se['first_name']." ".$se['last_name']) ?></td>
                <td><?php echo $se['block_number']; ?></td>
                <td><?php echo $se['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 8</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 8 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eight">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="eight" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 8</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example8" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($ei = mysqli_fetch_assoc($eight)){
        ?>
            <tr>

                <td><?php echo ucwords($ei['first_name']." ".$ei['last_name']) ?></td>
                <td><?php echo $ei['block_number']; ?></td>
                <td><?php echo $ei['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 9</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from members where block_number = 9 order by lot_number asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nine">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="nine" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 9</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example9" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($ni = mysqli_fetch_assoc($nine)){
        ?>
            <tr>

                <td><?php echo ucwords($ni['first_name']." ".$ni['last_name']) ?></td>
                <td><?php echo $ni['block_number']; ?></td>
                <td><?php echo $ni['lot_number']; ?></td>

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

                        <!-- -->

                        <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title"><i class="bi bi-house-fill"></i> BLOCK | 10</h5>

                  <div style="margin-left: 38%;" class="d-flex align-items-center">
                    <div style="background-color:  #8bc349; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <?php
    $sql = "SELECT * from household where blk = 10 order by lot asc";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>
                    <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                    </div>
                    <div class="ps-3">
                    </div>
                    </div>
                  <br>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ten">
                  <i class="fa-solid fa-eye"></i> View
              </button>
                </div>

              </div>
            </div>

             <!-- Vertically centered Modal -->

              <div class="modal fade" id="ten" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Block 10</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example10" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Block</th>
                <th>Lot</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($te = mysqli_fetch_assoc($ten)){
        ?>
            <tr>

                <td><?php echo ucwords($te['first_name']." ".$te['last_name']) ?></td>
                <td><?php echo $te['block_number']; ?></td>
                <td><?php echo $te['lot_number']; ?></td>

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




      </div>
    </section>

  </main><!-- End #main -->


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