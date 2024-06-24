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
       $del_msg = $obj->deletecon($id);
    }
}

if(isset($_GET['status'])){
  if($_GET['status']=='view'){
  $mem_id = $_GET['id'];
  $mem = $obj->display_mem_id($mem_id);
  $fin = $obj->display_fin_id($mem_id);
  $projc = $obj->display_prjc_id($mem_id);
  $contri = $obj->display_project_con($mem_id);
  $con = $obj->display_mem_con($mem_id);
  }
}

if(isset($_POST['update_fin'])){
  $msg = $obj->update_prjc($_POST);
}

if(isset($_POST['update_mem_con'])){
    $msg = $obj->update_finance($_POST);
  }

  if(isset($_POST['update_profile'])){
    $profile = $obj->update_profile($_POST);
  }
  
  if(isset($_POST['update_mem'])){
    $msg = $obj->update_mem_info($_POST);
  }

if(isset($_POST['add_proj'])){
  $profile = $obj->add_contribution($_POST);
}

if(isset($_POST['mem_fee_add'])){
    $_POST['mem_fee_amount'] = $_POST['mem_fee_amount'] ?? 1000;
    
    $profile = $obj->add_mem_fee($_POST);
  }

$project = $obj->display_project_fin();

?>


<!DOCTYPE html>
<html lang="en">

<?php include('header.php')?>

<style>

</style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js">

<body class="toggle-sidebar">
<?php include('sidebar.php')?>
    <?php include('headnav.php')?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>MEMBER INFO</h1>
            <br>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div style="margin: auto;" class="col-xl-8">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="user_img/<?php echo $mem['user_image']; ?>" alt="Profile"
                                    class="rounded-circle"> <br>
                                <h2><?php echo $mem['first_name']." ".$mem['last_name'] ?></h2>
                                <h3 style="padding-top: 2%;"><i class="fa-solid fa-house"></i>
                                    <?php echo "BLK ".$mem['block_number']." LOT ".$mem['lot_number'] ?></h3>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Edit Profile</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#finance-edit">Financial</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                            <div class="col-lg-9 col-md-8">
                                                <?php echo $mem['first_name']." ".$mem['last_name'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Gender</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $mem['gender']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Membership Plan</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $mem['membership_plan']; ?></div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Username</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $mem['username'];?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Password</div>
                                            <div class="col-lg-9 col-md-8">
                                                <?php echo preg_replace("/(?!^).(?!$)/", "*", $mem['password']);?></div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form action="" autocomplete="" method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="profileImage"
                                                    class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img src="user_img/<?php echo $mem['user_image']; ?>" alt="Profile">
                                                    <div class="pt-2">
                                                        <input hidden name="mem_id" type="text" class="form-control"
                                                            id="fullName" value="<?php echo $mem['id'];?>">
                                                        <input name="profile" type="file" class="form-control"
                                                            id="fullName" value=""> <br>
                                                        <button name="update_profile" type="submit"
                                                            class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <hr>

                                        <form action="" autocomplete="" class="sign-in-form" method="POST"
                                            enctype="multipart/form-data">

                                            <input hidden name="mem_id" type="text" class="form-control" id="fullName"
                                                value="<?php echo $mem['id'];?>">
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="firstname" type="text" class="form-control"
                                                        id="fullName" value="<?php echo $mem['first_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle
                                                    Name (Optional)</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="midname" type="text" class="form-control" id="fullName"
                                                        value="<?php echo $mem['mid_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="lastname" type="text" class="form-control"
                                                        id="fullName" value="<?php echo $mem['last_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select name="gender" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="<?php echo $mem['gender'];?>" selected>
                                                            <?php echo $mem['gender'];?></option>
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Rather Not Say">Rather Not Say</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact
                                                    <i class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input required name="contact" type="text" class="form-control"
                                                        id="fullName" value="<?php echo $mem['contact'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="company" class="col-md-4 col-lg-3 col-form-label">Block <i
                                                        class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="blk" type="text" class="form-control" id="company"
                                                        value="<?php echo $mem['block_number'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Lot <i
                                                        class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="lot" type="text" class="form-control" id="Job"
                                                        value="<?php echo $mem['lot_number'];?>">
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <label for="membership_plan" class="col-md-4 col-lg-3 col-form-label">Membership Plan <i
                                                        class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select name="membership_plan" type="text" class="form-control" id="Job"
                                                        value="<?php echo $mem['membership_plan'];?>">

                                                        <option value="Monthly" <?php echo ($mem['membership_plan'] == 'Monthly') ? 'selected' : ''; ?>>Monthly</option>
                                                        <option value="Quarterly" <?php echo ($mem['membership_plan'] == 'Quarterly') ? 'selected' : ''; ?>>Quarterly</option>
                                                        <option value="Semi-Annually" <?php echo ($mem['membership_plan'] == 'Semi-Annually') ? 'selected' : ''; ?>>Semi-Annually</option>
                                                        <option value="Annually" <?php echo ($mem['membership_plan'] == 'Annually') ? 'selected' : ''; ?>>Annually</option>


</select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Country"
                                                    class="col-md-4 col-lg-3 col-form-label">Username</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="username" type="text" class="form-control" id="Country"
                                                        value="<?php echo $mem['username'];?>">
                                                </div>
                                            </div>

                                            <<div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input required name="password" type="password" class="form-control" id="Address" value="<?php echo $mem['password'];?>">
                                            </div>
                                        </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label"></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input hidden name="email" type="email" class="form-control"
                                                        id="Email" value="k.anderson@example.com">
                                                    <br>
                                                    <button name="update_mem" type="submit" class="btn btn-primary">Save
                                                        Changes</button>
                                                </div>

                                            </div>
                                    </div>


                                    </form><!-- End Profile Edit Form -->



                                    <div class="tab-pane fade show finance-edit" id="finance-edit">

                                        <h5 class="card-title">Financial Details</h5>

                                        <div class="row">
                                        <form action="" autocomplete="" class="sign-in-form" method="POST"
                                            enctype="multipart/form-data" id = "membership_form">
                                            <input hidden name="mem_id" type="text" class="form-control" id="fullName"
                                                value="<?php echo $mem['id'];?>">
                                            <input type="hidden" name="membershipFeeAmount" id = "membershipFeeAmount">
                                                
                                        <button
                                                type="submit" data-bs-toggle="modal"  onclick = "addMembershipFee(event)" name="mem_fee_add" class="btn" style="width: 20%;color:#e9e5d6; background-color: #008000; margin-bottom: 10px; margin-left: 59%;">
                                                <i class="fa-solid fa-square-plus"></i> Add Membership Fee</button>

                                                <script>
                                                function addMembershipFee(e){
                                                    const membershipFee = document.getElementById('membershipFeeAmount');
                                                
                                                    if(membershipFee.value == ""){
                                                        e.preventDefault();
                                                        var amount = prompt("Enter membership fee to be paid", "1000");
                                                        membershipFee.value = amount;
                                                        e.target.click();
                                                    }
                                                    else{
                                                        
                                                    }
                                            
                                                 
                                                }
                                                </script>

                                        <button
                                                style="width: 20%;color:#e9e5d6; background-color: #008000; margin-bottom: 10px;"
                                                type="button" data-bs-toggle="modal" data-bs-target="#memhistory" class="btn">
                                                <i class="fa-solid fa-eye"></i> View Payment History</button>
                                                </form>


                                            <div class="col-lg-12">

                                                <div class="card">
                                                    <div class="card-body" style="overflow-x:auto;">
                                                        <!-- Table with stripped rows -->
                                                        <div class="table-wrapper">
                                                            <table id="example" class="stripe" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th hidden scope="col">ID</th>
                                                                        <th scope="col"></th>
                                                                        
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Action</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while($ff = mysqli_fetch_assoc($fin)){ ?>
                                                                    <tr>
                                                                        <td hidden class="table-id"><?php echo $ff['id']; ?></td>
                                                                        <td><b><?php echo $ff['type'];?></b><br>
                                                                            <small>
                                                                                ₱<?php echo $ff['amount'];?>
                                                                            </small>
                                                                            <br>
                                                                            <b> DUE:
                                                                                <?php echo $ff['deadline'];?><b>
                                                                        </td>
                                                                        <td>
                                                                       
                                                                                    <?php if ($ff['status'] == 0) { ?>
                                                                                        <span class="badge bg-warning p-2">Unpaid</span>
                                                                                    <?php } elseif ($ff['status'] == 1) { ?>
                                                                                        <span class="badge bg-success p-2">Paid</span>
                                                                                    <?php } ?>
                                                                             
                                                                         
                                                                        </td>
                                                                        </td>

                                                                        <td>
                                                                            <button type="button" data-bs-toggle="modal"
                                                                                data-bs-target="#verticalycentered"
                                                                                class="btn btn-warning edit-item-btn"><i
                                                                                    class="fa-solid fa-pen-to-square"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                            <!-- End Table with stripped rows -->

                                                        </div>
                                                    </div>


                                                </div>

                                            </div>

                                        </div>


                                        <br>



                                 

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
        </section>

    </main><!-- End #main -->

    <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
        enctype="multipart/form-data">
        <div class="modal fade" id="verticalycentered" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Membership Fee
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                        <input hidden name="user_id" value="<?php echo $mem_id?>">
                            <input hidden name="id" id="call-id">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-md-8 col-lg-9">
                            <label class="col-sm-6 col-form-label">Status</label>
                                <select name="stat" class="form-select" multiple aria-label="multiple select example">
                                    <option selected value="1">Paid
                                    </option>
                                </select>

                                <label class="col-sm-6 col-form-label">Amount Paid</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="amount" type="number"  class="form-control" id="Address" value = <?php echo 1000 ?>>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button name="update_mem_con" class="btn btn-warning" type="submit"><i class="fa-solid fa-pen"></i>
                            Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- MODAL -->

    </form>


    <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST"
        enctype="multipart/form-data">
        <div class="modal fade" id="finance" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Project Contribution
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input hidden name="id" id="cll-id">
                            <input hidden name="user_id" value="<?php echo $mem_id?>">
                            <input hidden name="proj_name" id="cll-name">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-md-8 col-lg-9">
                            <label class="col-sm-6 col-form-label">Status</label>
                                <select name="stat" class="form-select" multiple aria-label="multiple select example">
                                    <option value="0">Unpaid
                                    </option>
                                    <option value="1">Paid
                                    </option>
                                    <option value="2">Partially Paid
                                    </option>
                                </select>

                                <label class="col-sm-6 col-form-label">Amount Paid</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="amount" type="number" class="form-control" id="Address" value="0">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button name="update_fin" class="btn btn-warning" type="submit"><i class="fa-solid fa-pen"></i>
                            Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

                 <!-- Vertically centered Modal -->

                 <div class="modal fade" id="prjhistory" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo $mem['first_name']." ".$mem['last_name'] ?> Payment History</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example9" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($ni = mysqli_fetch_assoc($contri)){
        ?>
            <tr>

                <td><?php echo ucwords($ni['project_name']) ?></td>
                <td>₱<?php echo $ni['amount']; ?></td>
                <td><?php echo $ni['date_paid']; ?></td>

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

                               <!-- Vertically centered Modal -->

                               <div class="modal fade" id="memhistory" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo $mem['first_name']." ".$mem['last_name'] ?> Payment History</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                    <table id="example1" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($no = mysqli_fetch_assoc($con)){
        ?>
            <tr>

                <td>₱<?php echo $no['amount']; ?></td>
                <td><?php echo $no['date_paid']; ?></td>

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
        });
    });


    $(document).ready(function() {
        $(".edit-fin-btn").click(function() {

            var id = $(this).closest('tr').find('.tbl-id').text();
            var name = $(this).closest('tr').find('.tbl-name').text();

            $("#cll-id").val(id)
            $("#cll-name").val(name)
        });
    });


    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    $(document).ready(function () {
    $('#example9').DataTable();
});

$(document).ready(function () {
    $('#example1').DataTable();
});

    </script>

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