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

$report = $obj->display_report();

if(isset($_GET['status'])){
  $get_id = $_GET['id'];
  if($_GET['status']=="delete"){
     $del_msg = $obj->delete_res($get_id);
  }
}

if(isset($_POST['update_rep'])){
  $profile = $obj->update_rep_stat($_POST);
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


<body class="toggle-sidebar">
<?php include('sidebar.php')?>
    <?php include('headnav.php')?>


    <main id="main" class="main">
        <?php
    $sql = "SELECT * from report";
      if ($result = mysqli_query($conn, $sql)) {
      $rowcount = mysqli_num_rows( $result );
      }
      ?>

        <div class="pagetitle">
            <h1>COMPLAINTS</h1>
            <h5 class="card-title">Total Number of Complaints: <?php echo $rowcount;?> </h5>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div style="margin: auto;" class="col-lg-8">
                    <div class="row">
                        <div style="text-align: center;" class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">All <span>| Complaints</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: #38a3f1; color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from report";
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
                                    <h5 class="card-title">Resolved <span>| Complaints</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: rgb(51, 145, 87); color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-check-to-slot"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from projects WHERE status = 2";
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
                                    <h5 class="card-title">Investigating <span>| Complaints</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color: rgb(23, 171, 212); color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-pause"></i>
                                        </div>
                                        <div class="ps-3">

                                            <?php
    $sql = "SELECT * from report WHERE status= 1";
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
                                    <h5 class="card-title">Unresolve <span>| Complaints</span></h5>

                                    <div style="margin-left: 25%;" class="d-flex align-items-center">
                                        <div style="background-color:  rgb(240, 10, 44); color: white; "
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
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
                                <table id="example" class="stripe" style="width:100%">

                                    <thead>
                                        <th hidden scope="col">Id</th>
                                        <th scope="col">Commplaint Id</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Complaint By</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </thead>

                                    <tbody>
                                        <?php
    while ($rep = mysqli_fetch_assoc($report)){
        ?>
                                        <tr>
                                            <td hidden class="table-id"><?php echo $rep['id'] ?></td>
                                            <td>
                                                <?php echo ucwords($rep['rep_id']) ?>

                                            </td>

                                            <td>
                                                <?php echo ucwords($rep['title']) ?>
                                            </td>

                                            <td class="text-center">
                                                <?php echo ucwords($rep['user']) ?>
                                            </td>

                                            <td class="text-center">
                                                <?php echo  date("Y-m-d h:i:s a",strtotime($rep['date_added'])) ?>
                                            </td>

                                            <td style="" class="text-center">
                                                <?php
                            if($rep['status'] =='0'){
                              echo "<span class='badge' style= 'text-align:center;padding:10px; background-color: #f7ce2b ;'>UNREAD</span>";
                            }elseif($rep['status'] =='1'){
                              echo "<span class='badge' style='padding:10px; background-color:rgb(23, 171, 212);'>INVESTIGATING</span>";
                            }elseif($rep['status'] =='2'){
                              echo "<span class='badge' style='padding:10px; background-color:  rgb(106, 163, 55);'>RESOLVED</span>";
                            }elseif($rep['status'] =='3'){
                              echo "<span class='badge' style='padding:10px; background-color: rgb(240, 10, 44);'>UNRESOLVE</span>";
                            }
                          ?>
                                            </td>

                                            <td>
                                                <a href="view_report.php?status=view&&id=<?php echo $rep['rep_id'] ?>"
                                                    type="button" class="btn btn-primary"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#verticalycentered"
                                                    class="btn btn-warning edit-item-btn"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <a href="?status=delete&&id=<?php echo $rep['id'] ?>"
                                                    onclick="return confirm('Are you sure you want to delete this project? NOTE: This action cannot be undone.')"
                                                    type="button" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash-can"></i></button></a>
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
                                <div class="modal fade" id="verticalycentered" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Complaint Status</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <input hidden name="id" id="call-id">
                                                    <label class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">

                                                        <select name="stat" class="form-select" multiple
                                                            aria-label="multiple select example">
                                                            <option value="0">Unread</option>
                                                            <option value="1">Invesigating</option>
                                                            <option value="2">Resolved</option>
                                                            <option value="3">Unresolve</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                                <button name="update_rep" class="btn btn-warning" type="submit"><i
                                                        class="fa-solid fa-pen"></i> Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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