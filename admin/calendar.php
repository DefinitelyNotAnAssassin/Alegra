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

if(isset($_POST['add_res'])){
    $msg = $obj->add_adminreservation($_POST);
  
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

<link rel="stylesheet" href="clndr/fullcalendar/fullcalendar.min.css" />
<script src="clndr/fullcalendar/lib/jquery.min.js"></script>
<script src="clndr/fullcalendar/lib/moment.min.js"></script>
<script src="clndr/fullcalendar/fullcalendar.min.js"></script>

<style>
#calendar {
    padding: 2%;
    width: 100%;
    background-color: white;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
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
    <h1>RESERVATION</h1>
    <br>
  
</div><!-- End Page Title -->

<h6 class="text-success">
    <?php
if(isset($msg)){
 echo $msg;
}
?>

</h6>

<br>
        <section class="section dashboard">
            <div class="response"></div>
            <div id='calendar'></div>
            <br>
            <br>
            <br>
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

    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            nextDayThreshold: '23:00:00',
            events: "clndr/fetch-event.php",
            displayEventTime: false,
            eventRender: function(event, element, view) {
                if (event.allDay === 'false') {
                    event.allDay = false;

                } else {
                    event.allDay = false;
                }
            },
            selectable: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');

                if (title) {
                    var start = $.fullCalendar.formatDate(start, "HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "HH:mm:ss");

                    $.ajax({
                        url: 'add-event.php',
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function(data) {
                            displayMessage("Added Successfully");
                        }
                    });
                    calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true
                    );
                }
                calendar.fullCalendar('unselect');
            },

            editable: false,
            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: 'edit-event.php',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end +
                        '&id=' + event.id,
                    type: "POST",
                    success: function(response) {
                        displayMessage("Updated Successfully");
                    }
                });
            },
        });
    });

    function displayMessage(message) {
        $(".response").html("<div class='success'>" + message + "</div>");
        setInterval(function() {
            $(".success").fadeOut();
        }, 1000);
    }
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