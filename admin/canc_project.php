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
<?php include('sidebar.php')?>
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
  <h1>Cancelled | PROJECT</h1>
  <br>
 
</div><!-- End Page Title -->
<br>
<section class="section dashboard">
  <div class="row">
  <div style="margin: auto;" class="col-lg-8">

  <div class="row">
  <div style="text-align: center;" class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">All <span>| Projects</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: #38a3f1; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from projects";
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

                <div  class="card-body">
                  <h5 class="card-title">Done <span>| Projects</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: rgb(51, 145, 87); color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-check-to-slot"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from projects WHERE status = 5";
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

                <div  class="card-body">
                  <h5 class="card-title">Pending <span>| Projects</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: #f7ce2b; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-pause"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from projects WHERE status= 0";
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

                <div  class="card-body">
                  <h5 class="card-title">Cancelled <span>| Projects</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color:  rgb(240, 10, 44); color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from projects where status = 3";
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
                <th scope="col"></th>
                <th scope="col">Project Name</th>
                <th scope="col">Location</th>
                <th scope="col">Task</th>
                <th scope="col">Completed Task</th>
                <th scope="col">Status</th>
                <th scope="col">Progress  </th>
                <th scope="col">Action</th>
            </thead>

            <?php
                $i = 1;
                $stat = array("Pending","Started","On-Progress","Cancelled","Over Due","Done");
                $where = "";

                $qry = $conn->query("SELECT * FROM projects WHERE status = 3  order by deadline desc");
                while($row= $qry->fetch_assoc()):
                $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                $cc = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 2")->num_rows;
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

                      <td class="text-center">
                      	<?php echo number_format($tprog) ?>
                      </td>
                      <td class="text-center">
                      	<?php echo number_format($cprog) ?>
                      </td>

                      <td style="text-transform: uppercase;" class="project-state">
                          <?php
                            if($stat[$row['status']] =='Pending'){
                              echo "<span class='badge' style=' padding:10px; background-color: #f7ce2b;'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Started'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(106, 163, 55);'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='On-Progress'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(23, 171, 212);'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Cancelled'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(240, 10, 44);'>{$stat[$row['status']]}</span>";
                            }
                            elseif($stat[$row['status']] =='Done'){
                                echo "<span class='badge' style=' padding:10px;background-color: rgb(51, 145, 87);'>{$stat[$row['status']]}</span>";
                              }
                          ?>
                      </td>
                    
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                              </div>
                          </div>
                          <small>
                              <?php echo $prog ?>% Complete
                          </small>
                      </td>

                      <td>
                      <a href="view_canc.php?status=view&&id=<?php echo $row['id'] ?>" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                      <a href="edit_project.php?status=edit&&id=<?php echo $row['id'] ?>" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a href="?status=delete&&id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this project? NOTE: This action cannot be undone.')"  type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
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