<?php
session_start();
include_once("class/adminback.php");
include_once("class/db.php");
$obj = new adminback();

$msg = $_GET['message'];
if(isset($msg)){
    echo "<script>alert('$msg');</script>";
}

$admin_id = $_SESSION['id'];
$admin_name = $_SESSION['name'];
$profile = $_SESSION['profile'];

if (empty($admin_id)) {
  header("location:admin-login.php");
}




$project = $obj->display_projectadmin();


if(isset($_POST['add_prj'])){
  $msg = $obj->add_project($_POST);

}

if(isset($_GET['status'])){
    $id = $_GET['id'];
    if($_GET['status']=="delete"){
       $del_msg = $obj->delete_project($id);
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
<!-- ======= Sidebar ======= -->
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
    <a class="nav-link" data-bs-target="#prj-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-bars-progress"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="prj-nav" class="nav-content " data-bs-parent="#sidebar-nav">
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
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
    <a class="nav-link collapsed" data-bs-target="#fac-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-warehouse"></i><span>Reservation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="fac-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                      <h5 class="modal-title">Add New Project</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_prj" class="btn btn-primary" type="submit"><i class="fa-solid fa-folder-plus"></i> Add Project</button>

                    </div>
                  </div>
                </div>
              </div>
              </form>



<div class="pagetitle">
  <h1>PENDING PROJECTS</h1>
  <br>
  <button style="color:#e9e5d6; background-color: #008000;" type="button"  data-bs-toggle="modal" data-bs-target="#verticalycentered" class="btn"><i class="fa-solid fa-folder-plus"></i> Add Project</button>
</div><!-- End Page Title -->
<br>
</div>

      <div class="card">
        <div class="card-body" style="overflow-x:auto;">
            <br>
          <!-- Table with stripped rows -->
          <div class="table-wrapper">
          <table id="example" class="table table-hover datatable">

            <thead>
                <th scope="col"></th>
                <th scope="col">Project Name</th>
                <th scope="col">Location</th>
                <th scope="col">Status</th>
                <th scope="col">Budget Requested</th>
                <th scope="col">Action</th>
            </thead>

            <?php
                $i = 1;
                $stat = array("Pending", "Started","On-Progress","Cancelled","Over Due","Done");
                $where = "";

                $qry = $conn->query("SELECT * FROM projects WHERE status = 0 order by deadline desc");
                while($row= $qry->fetch_assoc()):
                $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                $cc = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 2")->num_rows;
                $budget = $conn->query("SELECT overall_cost FROM projects where id = {$row['id']}");
                $budget = $budget->num_rows > 0 ? $budget->fetch_assoc()['overall_cost'] : 0;
                $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;
                $dur = $conn->query("SELECT sum(time_rendered) as duration FROM user_productivity where project_id = {$row['id']}");
                $dur = $dur->num_rows > 0 ? $dur->fetch_assoc()['duration'] : 0;
                if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                if($cprog > 0)
                  $row['status'] = 2;
                else
                  $row['status'] = 0;
                elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['deadline'])):
                  $row['status'] = 4;

                endif;
                  ?>
                  <tr>
                      <td>
                        <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php echo ucwords($row['project']) ?>
                          </a>
                          <br>
                          <small>
                              Started: <?php echo date("Y-m-d",strtotime($row['start_date'])) ?>
                          </small>
                          <br>
                          <small>
                              Due: <?php echo date("Y-m-d",strtotime($row['deadline'])) ?>
                          </small>
                      </td>

                      <td>
                        <?php echo ucwords($row['location']) ?>
                      </td>

                     

                      <td style="text-transform: uppercase;" class="project-state">

                          <?php

                            if($stat[$row['status']] =='Pending'){
                              echo "<span class='badge' style=' padding:10px; background-color: #f7ce2b;'>{$stat[$row['status']]}</span>";
                            }
                            elseif($stat[$row['status']] =='Started'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(106, 163, 55);'>{$stat[$row['status']]}</span>";
                            }
                            elseif($stat[$row['status']] =='On-Progress'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(23, 171, 212);'>{$stat[$row['status']]}</span>";
                            }
                            elseif($stat[$row['status']] =='Cancelled'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(240, 10, 44);'>{$stat[$row['status']]}</span>";
                            }
                            elseif($stat[$row['status']] =='Done'){
                              echo "<span class='badge' style=' padding:10px;background-color: rgb(51, 145, 87);'>{$stat[$row['status']]}</span>";
                            }

                          ?>

                      </td>
                    
                      <td class="project_progress">
                          
                      ₱<?php echo number_format($budget) ?>
                      </td>

                      <td>
                      
                      <a href="approve_project.php?status=1&&id=<?php echo $row['id'] ?>" type="button" class="btn btn-success"><i class="fa-solid fa-check"></i></a>
                      <a href="reject_project.php?status=5&&id=<?php echo $row['id'] ?>" type="button" class="btn btn-danger"><i class="fa-solid fa-times"></i></a>
                      </td>
                    
                      </td>

                  </tr>
                <?php endwhile; ?>
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