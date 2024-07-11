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

<!-- MODAL -->
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Member</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
 <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

<h5>Profile Picture: </h5>

<div class="col-md-4">
    <input name="profile" type="file" class="form-control" id="validationCustom01" value="" required>
    <div class="invalid-feedback">
    Please upload profile picture.
    </div>
  </div>


<h5>Personal Information: </h5>

  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">First name</label>
    <input name="fname" type="text" class="form-control" id="validationCustom01" value="" required>
    <div class="invalid-feedback">
    Please enter first name.
    </div>
  </div>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Middle name (Optional)</label>
    <input name="mname" type="text" class="form-control" id="" value="" >
  </div>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input name="lname" type="text" class="form-control" id="validationCustom02" value="" required>
    <div class="invalid-feedback">
    Please enter last name.
    </div>
  </div>

  <div class="col-md-4">
    <label for="validationCustom04" class="form-label">Gender</label>
    <select name="gender" class="form-select" id="validationCustom04" required>
      <option selected disabled value="">Choose Gender</option>
      <option value="Female">Female</option>
      <option value="Male">Male</option>
      <option value="Rather Not Say">Rather Not Say</option>
    </select>
    <div class="invalid-feedback">
      Please select a gender.
    </div>
  </div>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Contact <i class="fa-solid fa-hashtag"></i></label>
    <input name="contact" class="form-control" id="validationCustom02" value="" type="text"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').slice(0, 11);"
                                    maxlength="11" required>
    <div class="invalid-feedback">
    Please provide valid contact number.
    </div>
  </div>


  <div class="col-md-4">
      <label for="validationCustom02" class="form-label">Membership Fee Plan</label>
      <select name="membership_plan" class="form-select" id="validationCustom02" required>
        <option selected disabled value="">Choose Membership Fee Plan</option>
        <option value="monthly">Monthly</option>
        <option value="quarterly">Quarterly</option>
        <option value="semi-annually">Semi-Annually</option>
        <option value="annually">Annually</option>
      </select>
      <div class="invalid-feedback">
        Please select a membership fee plan.
      </div>
  </div>

 <h5>Address: </h5>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Blk <i class="fa-solid fa-hashtag"></i></label>
    <select name="blk" class="form-select" id="validationCustom02" required>
      <option selected disabled value="">Choose Block Number</option>
      <?php
      for ($i = 1; $i <= 10; $i++) {
        echo "<option value=\"$i\">$i</option>";
      }
      ?>
    </select>
    <div class="invalid-feedback">
    Please provide valid block number.
    </div>
  </div>


  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Lot <i class="fa-solid fa-hashtag"></i></label>
    <select name="lot" class="form-select" id="validationCustom02" required>
      <option selected disabled value="">Choose Lot Number</option>
      <?php
      for ($i = 1; $i <= 10; $i++) {
      echo "<option value=\"$i\">$i</option>";
      }
      ?>
    </select><div class="invalid-feedback">
    Please provide valid lot number.
    </div>
  </div>

  <div class="col-md-4">
    <label for="residenceTypeSelect" class="form-label">Residence Type <i class="fa-solid fa-hashtag"></i></label>
    <select name="residence_type" class="form-select" id="residenceTypeSelect" required>
      <option selected disabled value="">Choose Type</option>
      <option value="Homeowner">Homeowner</option>
      <option value="Resident">Resident</option>
      <option value="Renter">Renter</option>
      <option value="Other">Other</option>
    </select>
    <div class="invalid-feedback">
    Please provide valid lot number.
    </div>
</div>

<!-- Placeholder for Lot Type Select -->
<div class="col-md-4" id="lotTypeSelect" style="display: none;">
    <label for="lotType" class="form-label">Lot Type</label>
    <select name="lot_type" class="form-select" id="lotType" required>
      <option selected disabled value="">Choose Lot Type</option>
      <option value="Acquired">Acquired</option>
      <option value="Unacquired">Unacquired</option>
    </select>
</div>

<!-- Placeholder for Award Status Select -->
<div class="col-md-4" id="awardStatusSelect" style="display: none;">
    <label for="awardStatus" class="form-label">Award Status</label>
    <select name="award_status" class="form-select" id="awardStatus" required>
      <option selected disabled value="">Choose Award Status</option>
      <option value="Awarded">Awarded</option>
      <option value="Not Yet Awarded">Not Yet Awarded</option>
    </select>
</div>

  <h5>Login credentials: </h5>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input name="username" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please provide a username.
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Password</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend"><i id="togglePassword" class="fa-regular fa-eye fa-l" style="color: #201c18; cursor: pointer;"></i></span>
      <input name="password" type="password" class="form-control" aria-describedby="inputGroupPrepend" id="validationCustom" value="alegraheights" required>
      <div class="invalid-feedback">
        Please provide a password.
      </div>
    </div>
  </div>



  <div class="col-12">

  </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_mem" class="btn btn-primary" type="submit"><i class="fa-solid fa-user-plus"></i> Add Member</button>
                    </div>
                  </div>
                </div>
              </div>
              </form>

<div class="pagetitle">
  <h1>MASTERLIST</h1>
  <br>
  <button style="color:#e9e5d6; background-color: #008000;" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered" class="btn"><i class="fa-solid fa-user-plus"></i> Add Member</button>
</div><!-- End Page Title -->
<br>
<section class="section dashboard">
  <div class="row">
    <div style="margin: auto;" class="col-lg-8">

    <div class="row">
  <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">All <span>| Members</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: #38a3f1; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
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

            <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">Active <span>| Members</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color: rgb(51, 145, 87); color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from members WHERE status = 1";
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

            <div style="text-align: center;" class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">Inactive <span>| Members</span></h5>

                  <div style="margin-left: 25%;" class="d-flex align-items-center">
                    <div style="background-color:  rgb(240, 10, 44); color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-dash"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from members where status = 0";
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

<br>
      <div class="card">
        <div class="card-body">
            <br>
          <!-- Table with stripped rows -->
          <div class="table-wrapper">
          <table id="example" class="table table-striped table-hover datatable">

            <thead>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Block #</th>
                <th scope="col">Lot #</th>
                <th scope="col">Date Added</th>
                <th scope="col">Status</th>
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
                <td><?php echo $mem['date_added']; ?></td>
                <td>

                <?php
                            if($mem['status'] == 1){
                              echo "<span class='badge' style='text-align:center; background-color: rgb(51, 145, 87);'>Active</span>";
                            }
                            elseif($mem['status'] =='0'){
                                echo "<span class='badge' style='text-align:center; background-color: rgb(240, 10, 44);'>Inactive</span>";
                              }
                          ?>
                </td>
                <td>
                <a href="view_member.php?status=view&&id=<?php echo $mem['id'] ?>" type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                <a href="view_member.php?status=view&&id=<?php echo $mem['id'] ?>" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="?status=delete&&id=<?php echo $mem['id'] ?>" onclick="return confirm('Are you sure you want to delete this member? NOTE: This action cannot be undone.')"  type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
                <a href="generate_certificate.php?id=<?php echo $mem['id'] ?>" type="button" class="btn btn-success"><i class="fa-solid fa-certificate"></i></a>
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
document.addEventListener('DOMContentLoaded', function () {
    const residenceTypeSelect = document.getElementById('residenceTypeSelect');
    const lotTypeSelectDiv = document.getElementById('lotTypeSelect');
    const lotTypeSelect = document.getElementById('lotType');
    const awardStatusSelectDiv = document.getElementById('awardStatusSelect');

    residenceTypeSelect.addEventListener('change', function() {
        if (this.value === 'Homeowner') {
            lotTypeSelectDiv.style.display = 'block';
        } else {
            lotTypeSelectDiv.style.display = 'none';
            awardStatusSelectDiv.style.display = 'none'; // Hide this as well if not homeowner
        }
    });

    lotTypeSelect.addEventListener('change', function() {
        if (this.value === 'Acquired') {
            awardStatusSelectDiv.style.display = 'block';
        } else {
            awardStatusSelectDiv.style.display = 'none';
        }
    });
});
</script>


  <script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#validationCustom');

  togglePassword.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
  });
</script>

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