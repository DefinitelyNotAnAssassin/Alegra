<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();

$mem_id = $_SESSION['id'];
$mem_name = $_SESSION['name'];
$profile = $_SESSION['user_image'];

if (empty($mem_id)) {
  header("location:mem_login.php");
}

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $user_info= $obj->display_member_id($id);
    $mem = mysqli_fetch_assoc($user_info);
    $fin = $obj->display_fin_id($id);
    $projc = $obj->display_prjc_id($id);
    $contri = $obj->display_project_con($id);
    $con = $obj->display_mem_con($id);

}else{
header("location:mem_login.php");
}

if(isset($_POST['update_profile'])){
  $profile = $obj->update_profile($_POST);
}

if(isset($_POST['update_mem'])){
  $msg = $obj->update_mem_info($_POST);
}
$fin = $obj->display_fin_memid($mem_id);



?>


<!DOCTYPE html>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js">

<style>
body,
h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "Lato", sans-serif
}

.w3-bar,
h1,
button {
    font-family: "Montserrat", sans-serif
}

.fa-anchor,
.fa-coffee {
    font-size: 200px
}
</style>
<?php include('header.php')?>

<style>

</style>

<body>

    <!-- Navbar -->
    <div style="background-color:#c8e2a7;" class="w3-top">
        <div class="w3-bar w3-card w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-white w3-large"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white">Home</a>
            <div class="w3-dropdown-hover" style="padding-top:4px; padding-bottom:4px;">
                <button class="w3-button w3-white">Profile <i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block">
                    <a href="profile.php" class="w3-bar-item w3-button">My account</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
                </div>
            </div>
            <a href="bulletin.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i
                    class="fa-solid fa-chalkboard"></i> Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Guideline</a>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" style="background-color:#c8e2a7;"
            class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="bulletin.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa-solid fa-chalkboard"></i>
                Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-padding-large">Guideline</a>
        </div>
    </div>


    <main id="main" class="main" style="margin: 55px auto 0 auto;">

        <div class="pagetitle">
            <h1>MEMBER INFORMATION</h1>
            <br>
        </div><!-- End Page Title -->
        <?php
        if(isset($msg)){
            echo $msg;
        }
      ?>
        <section class="section profile">
            <div style="margin: auto;" class="col-xl-8">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="admin/user_img/<?php echo $mem['user_image']; ?>" alt="Profile"
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
                                            <div class="col-lg-3 col-md-4 label ">Contact</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $mem['contact']; ?></div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form action="" autocomplete="" method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="profileImage"
                                                    class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img src="admin/user_img/<?php echo $mem['user_image']; ?>"
                                                        alt="Profile">
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
                                                    <input style="background-color: #d5e29e;" required readonly
                                                        name="firstname" type="text" class="form-control" id="fullName"
                                                        value="<?php echo $mem['first_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle
                                                    Name (Optional)</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input style="background-color: #d5e29e;" readonly name="midname"
                                                        type="text" class="form-control" id="fullName"
                                                        value="<?php echo $mem['mid_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input style="background-color: #d5e29e;" required readonly
                                                        name="lastname" type="text" class="form-control" id="fullName"
                                                        value="<?php echo $mem['last_name'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select required readonly name="gender" class="form-select"
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
                                                    <i class="fa-solid fa-hashtag"></i> (Format: 0912XXXXXXX) </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input required name="contact" type="text"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').slice(0, 11);"
                                                        maxlength="11" class="form-control" id="fullName"
                                                        value="<?php echo $mem['contact'];?>">
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <label for="company" class="col-md-4 col-lg-3 col-form-label">Block <i
                                                        class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input style="background-color: #d5e29e;" required readonly
                                                        name="blk" type="text" class="form-control" id="company"
                                                        value="<?php echo $mem['block_number'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Lot <i
                                                        class="fa-solid fa-hashtag"></i></label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input style="background-color: #d5e29e;" required readonly
                                                        name="lot" type="text" class="form-control" id="Job"
                                                        value="<?php echo $mem['lot_number'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Country"
                                                    class="col-md-4 col-lg-3 col-form-label">Username</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input required name="username" type="text" class="form-control"
                                                        id="Country" value="<?php echo $mem['username'];?>">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
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


                                        </form><!-- End Profile Edit Form -->



</div>

<div class="tab-pane fade show finance-edit" id="finance-edit">

<h5 class="card-title">Financial Details</h5>

<div class="row">

<button
        style="width: 20%;color:#e9e5d6; background-color: #008000; margin-bottom: 10px; margin-left:auto; margin-right: 12px;"
        type="button" data-bs-toggle="modal" data-bs-target="#memhistory" class="btn">
        <i class="fa-solid fa-eye"></i> View Payment History</button>

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
                                    <b> Date Issued:
                                        <?php echo $ff['date'];?><b>
                                </td>
                                <td>
                                    <?php
                                    if($ff['status'] == 0){
                                        echo "<span class='badge bg-warning'>Unpaid</span>";
                                        
                                    }else{
                                        echo "<span class='badge bg-success'>Paid</span>";
                                    }
                             
                                }
                                    ?>
                                </td>
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
<!-- End #main -->




                                    </div>
                                </div>

                            </div>
                        </div>
        </section>

    </main><!-- End #main -->
    <!-- End #main -->

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

    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-light-grey w3-opacity w3-xlarge" style=" margin-top:128px">
        <div class="w3-row w3-mobile" style="padding-left: 15%; ">

            <div class="w3-half w3-container">
                <a href="index.php"><img src="admin/assets/img/banner2.png" alt=""
                        style=" margin-top:0; width: 20%; height: 10%;"></a>
                <p style="font-size: 25px;"><b>Quick Links</b></p>
                <a href="reserve.php">
                    <p style="color: black;font-size: 18px; padding-left: 5%;">Reservation</p>
                </a>
                <a href="report.php">
                    <p style="color: black; font-size: 18px; padding-left: 5%;">Report Issue</p>
                </a>
            </div>

            <div class="w3-half w3-container">
                <p><i class="fa fa-phone"></i><b>Contact Us</b></p>
                <p style="font-size: 18px; padding-left: 5%;">09123456789</p>
                <p><i class="fa fa-location-arrow"></i><b>Address</b></p>
                <p style="font-size: 18px; padding-left: 5%;">#123 ABCDE Street Sample Subdivision, Manila , Philippines
                    1123</p>

            </div>
        </div>
    </footer>
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
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});

$(document).ready(function() {
    $('#example9').DataTable();
});

$(document).ready(function() {
    $('#example1').DataTable();
});

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</html>