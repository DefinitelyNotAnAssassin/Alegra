<?php
session_start();
include_once("admin/class/adminback.php");
include_once("admin/class/db.php");
$obj = new adminback();


$prj = $obj-> display_projectrecent();


$prj1 = $obj-> display_project();


if(isset($_POST['add_res'])){
  $msg = $obj->add_reservation($_POST);

}
?>



<!DOCTYPE html>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- Import jquery cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="admin/clndr/fullcalendar/fullcalendar.min.css" />
<script src="admin/clndr/fullcalendar/lib/jquery.min.js"></script>
<script src="admin/clndr/fullcalendar/lib/moment.min.js"></script>
<script src="admin/clndr/fullcalendar/fullcalendar.min.js"></script>

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

@media (min-width: 1025px) {
    .main {
        margin: 55px 15% 0 15%;
    }
}

@media (max-width: 480px) {
    .main {
        margin: 55px auto auto auto;

    }
}

#calendar {
    padding: 0 10% 0 10%;
    width: 80%;
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
<?php include('header.php')?>

<body>

    <!-- Navbar -->
    <div style="background-color:#c8e2a7;" class="w3-top">
        <div class="w3-bar w3-card w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
  <?php          if(isset($_SESSION['id'])){

?>
<div class="w3-dropdown-hover" style="padding-top:4px; padding-bottom:4px;">
                <button class="w3-button w3-hover-white">Profile <i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block">
                    <a href="profile.php" class="w3-bar-item w3-button">My account</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Log out</a>
                </div>
            </div>
<?php
}else{
    ?>
      <a href="mem_login.php" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i class="fa-solid fa-right-to-bracket"></i> Login</a>

    <?php

} ?>


            <a href="bulletin.php"
                class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"><i class="fa-solid fa-chalkboard"></i> Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Guideline</a>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" style="background-color:#c8e2a7;"
            class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="bulletin.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa-solid fa-chalkboard"></i> Bulletin</a>
            <a href="gl.php" class="w3-bar-item w3-button w3-padding-large">Guideline</a>
        </div>
    </div>


    <header class="" style="margin-top: 50px;">
        <img src="assets/img/book.png" style=" max-width: 110%; height: auto;">
    </header>


    <main id="main" class="main">

        <div class="pagetitle">
        <button style="color:#e9e5d6; background-color: #008000; margin-left: 70%;" type="button" data-bs-toggle="modal"
                data-bs-target="#verticalycentered" class="btn"> <i class="fa-solid fa-calendar-day"></i> View
                Calendar</button>
        </div><!-- End Page Title -->


        <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Community Calendar</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="response"></div>
                        <div id='calendar'></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->

        <?php
        if(isset($msg)){
            echo $msg;
        }
      ?>
        <section class="section ">
            <div style="margin: auto;" class=" col-xl-10">
                <div class="card p-4">
                    <form action="" method="post" class="row g-3 needs-validation" novalidate>
                        <div class="row gy-4">

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
                                    maxlength="11" class="form-control" id="fullName"
                                    value="">
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
                            <select class="form-select" name="type" style="padding: 2%; width: 97%;" required>
                                <option disabled>Guest Type</option>
                                <option value="Residents">Residents</option>
                                <option value="Visitor/Outsider">Visitor/Outsider</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 " style="padding-left:0;">
                            <select class="form-select" id="facility" name="facility"
                                style="margin-left:0; padding: 2%;  width: 95%;" required>
                                <option disabled>Select a facility</option>
                                <option value="Covered Court">Covered Court</option>
                                <option value="Club House">Club House</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>


                        <div class="col-md-12">
                            <textarea style=" width: 97.5%;" class="form-control" name="message" rows="5"
                                placeholder="Purpose" required></textarea>
                            <div class="invalid-feedback">
                                Please provide purpose of reservation.
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button style="padding: 5px 3% 5px 3%;" type="button" class="btn btn-primary
                            btn-sm" data-toggle="modal" data-target="#exampleModal" id="submit">
                                Submit
                            </button>

                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                ×
                                            </span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 style="text-align: center;">Thank you for making your reservation. Please
                                            note that your reservation will be reviewed and approved
                                            by our admin team before it is confirmed. We appreciate your patience and
                                            you will recieve a message once
                                            your reservation is approved.
                                        </h6>
                                        <hr>
                                        <p id="modal_body"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-gray" data-dismiss="modal"
                                            aria-label="Close">
                                            Cancel
                                        </button>
                                        <button type="submit" data-dismiss="modal" name="add_res"
                                            class="btn btn-primary">Submit Reservation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-light-grey w3-opacity w3-xlarge" style=" margin-top:128px">
        <div class="w3-row w3-mobile" style="padding-left: 15%; ">

            <div class="w3-half w3-container">
                <a href="index.php"><img src="admin/assets/img/banner2.png" alt="" style=" margin-top:0; width: 20%; height: 10%;"></a>
                <p style="font-size: 25px;"><b>Quick Links</b></p>
                <a href="reserve.php"><p style="color: black;font-size: 18px; padding-left: 5%;">Reservation</p></a>
                <a href="report.php"><p style="color: black; font-size: 18px; padding-left: 5%;">Report Issue</p></a>
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

    <script type="text/javascript">
    $("#submit").click(function() {
        var name = $("#name").val();
        var facility = $("#facility").val();
        var date = $("#date").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var str = "<h4>RESERVATION DETAILS</h4> <br>" +
            "Name: " + name +
            "<br>Facility: " + facility +
            "<br>Date: " + date +
            "<br>Hours of usage: " + start + " to " + end;
        $("#modal_body").html(str);
    });
    </script>

    <script>
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

<script>
     $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            nextDayThreshold: '23:00:00',
            events: "admin/clndr/fetch-event.php",
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

</body>

</html>