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




$reserve = $obj->display_disreserve();

if(isset($_GET['status'])){
  $get_id = $_GET['id'];
  if($_GET['status']=="0"){
      $obj->reserve_approve($get_id);
  }elseif($_GET['status']=="0"){
      $obj->reserve_disapprove($get_id);
  }elseif($_GET['status']=="delete"){
     $del_msg = $obj->delete_res2($get_id);
  }
}


if(isset($_POST['add_res'])){
    $msg = $obj->add_adminreservation($_POST);
  
  }

  if(isset($_POST['update_date'])){
    $msg = $obj->update_date($_POST);

  }

  if(isset($_POST['update_time'])){
    $msg = $obj->update_time($_POST);

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
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-people-group"></i><span>Census</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="masterlist.php">
        <i class="fa-regular fa-rectangle-list"></i><span>Masterlist</span>
        </a>
      </li>
      <li>
        <a href="in_member.php">
        <i class="fa-solid fa-address-book"></i><span>Active</span>
        </a>
      </li>
      <li>
        <a href="out_member.php">
        <i class="fa-regular fa-address-book"></i><span>Inactive</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#prj-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-bars-progress"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="prj-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="manage_project.php">
        <i class="fa-solid fa-bars-progress"></i><span>Projects</span>
        </a>
      </li>
      <li>
        <a href="done_project.php">
          <i class="bi bi-check2-square"></i><span>Done | Projects</span>
        </a>
      </li>
      <li>
        <a href="canc_project.php">
          <i class="bi bi-x-square"></i><span>Cancelled | Projects</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-coins"></i><span>Finance</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="mem_fee.php">
          <i class="fa-solid fa-money-bills"></i><span>Membership Fee</span>
        </a>
      </li>
      <li>
        <a href="project_fee.php">
          <i class="fa-solid fa-money-bills"></i><span>Project Contribution</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-triangle-exclamation"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content  collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="reports.php">
        <i class="fa-solid fa-circle-exclamation"></i><span>Reports</span>
        </a>
      </li>
      <li>
        <a href="res_report.php">
        <i class="fa-regular fa-folder-open"></i><span>Resolved Reports</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->



  <li class="nav-item">
    <a class="nav-link " data-bs-target="#fac-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-warehouse"></i><span>Reservation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="fac-nav" class="nav-content  " data-bs-parent="#sidebar-nav">
      <li>
        <a href="manage_fac.php">
        <i class="bi bi-table"></i><span>Manage Reseravations</span>
        </a>
      </li>
      <li>
      <a href="app_res.php">
      <i class="fa-solid fa-calendar-check"></i><span>Approved Reseravations</span>
        </a>
      </li>
      <li>
      <a href="dis_res.php">
      <i class="fa-solid fa-calendar-xmark"></i><span>Disapproved Reseravations</span>
        </a>
      </li>

      <li>
      <a href="calendar.php">
      <i class="fa-solid fa-calendar"></i><span>Calendar</span>
        </a>
      </li>
    </ul>
  </li><!-- End Charts Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" href="logout.php">
    <i class="fa-solid fa-arrow-right-from-bracket"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->
    <?php include('headnav.php')?>



    <main id="main" class="main">

        <div class="modal fade" id="verticalycentered" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Reservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
                            enctype="multipart/form-data">

                            <h5>Reservation Information: </h5>

                            <div class="col-md-6">
                                <label class="label" for="email" for="inputTime" class="form-label">Full Name</label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $id?>">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="First Name Last Name" required>
                                <div class="invalid-feedback">
                                    Please provide your name.
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label class="label" for="email" for="inputTime" class="form-label">Contact #
                                    (0912XXXXXXX)</label>
                                <input required name="contact" id="contact" type="text"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').slice(0, 11);"
                                    maxlength="11" class="form-control" id="fullName">
                                <div class="invalid-feedback">
                                    Please provide contact number.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="label" for="email" for="inputTime" class="form-label">Date</label>
                                <input id="date" type="date" min="<?php echo date('Y-m-d'); ?>" name="date"
                                    class="form-control" placeholder="Your Name" required>
                                <div class="invalid-feedback">
                                    Please provide date of reservation.
                                </div>
                            </div>

                            <div class="col-md-6">

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="email" for="inputTime" class="form-label">Start
                                        Time</label>
                                    <input type="time" id="start" name="start" class="form-control" required>
                                </div>
                                <div class="invalid-feedback">
                                    Please provide the reservation time.
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label" for="email" for="inputTime" class="form-label">End
                                        Time</label>
                                    <input type="time" id="end" name="end" class="form-control" required>
                                </div>
                                <div class="invalid-feedback">
                                    Please provide the reservation time.
                                </div>
                            </div>
                    </div>


                    <div class="col-md-6 ">
                        <select class="form-select" name="type" style="margin-left: 4%; padding: 2%; width: 94%;"
                            required>
                            <option disabled>Guest Type</option>
                            <option value="Residents">Residents</option>
                            <option value="Visitor/Outsider">Visitor/Outsider</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <br>
                    <div class="col-md-6 " style="padding-left:0;">
                        <select class="form-select" id="facility" name="facility"
                            style="margin-left:4%; padding: 2%;  width: 94%;" required>
                            <option disabled>Select a facility</option>
                            <option value="Covered Court">Covered Court</option>
                            <option value="Club House">Club House</option>
                            <option value="Other">Other</option>
                        </select>

                    </div>

                    <br>
                    <div class="col-md-12">
                        <textarea style="margin-left:2%; width: 95%;" class="form-control" name="message" rows="5"
                            placeholder="Purpose" required></textarea>
                        <div class="invalid-feedback">
                            Please provide purpose of reservation.
                        </div>
                    </div> <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_res"
                            class="btn btn-primary" type="submit"><i class="fa-solid fa-folder-plus"></i> Add
                            Reservation</button>

                    </div>
                </div>
            </div>
        </div>
        </form>



        <div class="pagetitle">
            <h1>DISAPPROVED RESERVATION</h1>
            <br>
          
        </div><!-- End Page Title -->
        <br>
        <section class="section dashboard">
            <div class="row">
                <div style="margin: auto;" class="col-lg-8">

                    <div class="row">
                        <div style="text-align: center;" class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">All <span>| Reserve</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: #38a3f1; color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from reserve";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

                                            <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="text-align: center;" class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Approved <span>| Reserve</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: rgb(51, 145, 87); color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-check-to-slot"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from reserve WHERE status = 2";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

                                            <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="text-align: center;" class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Pending <span>| Reserve</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: #f7ce2b; color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-pause"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from reserve WHERE status= 1";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

                                            <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="text-align: center;" class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Disapproved <span>| Reserve</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color:  rgb(240, 10, 44); color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from reserve where status = 3";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

                                            <h1 style="font-weight: 800;"><?php echo $rowcount ?></h1>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <br>
                            <!-- Table with stripped rows -->
                            <div class="table-wrapper">
                                <table id="example" class="table table-hover datatable">

                                    <thead>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Guest Type</th>
                                        <th style="width: 20%;" scope="col">Purpose</th>
                                        <th scope="col">Status</th>
                                    </thead>

                                    <tbody>
                                        <?php
    while ($res = mysqli_fetch_assoc($reserve)){
        ?>
                                        <tr>
                                            <td><?php echo $res['u_name']; ?>
                                                <br>
                                                <small>
                                                    <i class="fa-solid fa-phone"></i> <?php echo $res['u_num'] ?>
                                                </small>
                                            </td>
                                            <td><?php echo $res['facility']; ?>
                                                <br>
                                                <small class="table-da">
                                                    Date: <?php echo date("Y-m-d",strtotime($res['start'])) ?>
                                                </small>
                                                <br>
                                                <small>
                                                    Start: <?php echo date("h:ia",strtotime($res['t_start'])) ?>
                                                </small>
                                                <br>
                                                <small>
                                                    End: <?php echo date("h:ia",strtotime($res['t_end'])) ?>
                                                </small>
                                            </td>
                                            <td><?php echo $res['u_type']; ?></td>
                                            <td><?php echo $res['purpose']; ?></td>
                                            <td>
                                                <?php
                            if($res['status'] == 1){
                              echo "<span class='badge' style=' padding:10px; background-color: #f7ce2b;'>Pending</span>";
                            }
                            elseif($res['status'] ==2){
                                echo "<span class='badge' style=' padding:10px;background-color: rgb(51, 145, 87);'>Accepted</span>";
                              }
                              elseif($res['status'] ==3){
                                echo "<span class='badge' style=' padding:10px;background-color: rgb(240, 10, 44);'>Disapproved</span>";
                              }
                          ?>
                                            </td>



                                        </tr>


                                        <?php
            }
              ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->
                            <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal fade" id="edit" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Report Status</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <input hidden name="id" id="call-id">

                                                    <div class="col-md-6">
                                                        <label class="label" for="email" for="inputTime"
                                                            class="form-label">Date</label>
                                                        <input id="date" type="date" min="<?php echo date('Y-m-d'); ?>"
                                                            name="date" id="call-da" class="form-control"
                                                            placeholder="Your Name" required>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="label" for="email" for="inputTime"
                                                            class="form-label"></label>
                                                        <button style="margin-top: 10%;" name="update_date"
                                                            class="btn btn-warning" type="submit"><i
                                                                class="fa-solid fa-pen"></i>
                                                            Update Date</button>
                                                    </div>

                            </form>

                            <div class="col-md-6">

                            </div>
                            <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
                                enctype="multipart/form-data">
                                <input hidden name="id" id="call-di">
                                <hr>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label" for="email" for="inputTime" class="form-label">Start
                                            Time</label>
                                        <input type="time" id="call-st" id="start" name="start" class="form-control "
                                            >
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide the reservation time.
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label" for="email" for="inputTime" class="form-label">End
                                            Time</label>
                                        <input type="time" id="call-en" id="end" name="end" class="form-control"
                                            >
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide the reservation time.
                                    </div>
                                </div>
                        </div>


                        <div style="margin-left:49%;" class="col-md-6">
                                    <div class="form-group">
                                        <label class="label" for="email" for="inputTime" class="form-label"></label>
                                            <button name="update_time" class="btn btn-warning" type="submit"><i
                                    class="fa-solid fa-pen"></i>
                                Update Time</button>
                                </div>

                                </div>

                        <div class="col-md-6">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                    </div>
                </div>
            </div>
            </div>
            </form>

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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script>

$(document).ready(function() {
        $(".edit-item-btn").click(function() {

            var id = $(this).closest('tr').find('.table-id').text();

            $("#call-id").val(id)
            $("#call-di").val(id)

        });
    });

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

        table.columns().every(function() {
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