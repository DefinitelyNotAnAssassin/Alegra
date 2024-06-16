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
$households = $obj->display_households();



if(isset($_GET['status'])){
    $id = $_GET['id'];
    if($_GET['status']=="delete"){
       $del_msg = $obj->delete_member($id);
    }
}

if(isset($_POST['add_mem'])){
    $add_mem = $obj->add_household($_POST);
    if($add_mem){
        echo "<script>alert('$add_mem')</script>";
    }
}




if(isset($_POST['add_household_member'])){
    $add_member = $obj->add_household_member($_POST);
    if($add_member){
        echo "<script>alert('$add_member')</script>";
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

<!-- MODAL -->
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Household</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
 <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">


  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">Blk #</label>
    <input name="blk" type="text" class="form-control" id="validationCustom01" value="" required>
    <div class="invalid-feedback">
    Please enter first name.
    </div>
  </div>

  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Lot #</label>
    <input name="lot" type="text" class="form-control" id="" value="" >
  </div>

  <div class="col-md-4">
    <label for="validationCustom03" class="form-label">Household Owner</label>
    <select name="household_owner" class="form-control" id="validationCustom03" required>
    <?php foreach ($members as $member): ?>
        <option value="<?php echo htmlspecialchars($member['id']); ?>">
            <?php echo htmlspecialchars($member['first_name']) . htmlspecialchars($member['last_name']); ?>
        </option>
    <?php endforeach; ?>
    </select>
    <div class="invalid-feedback">
    Please enter last name.
    </div>
  </div>


  <div class="col-md-4">
  </div>

  <div class="col-12">

  </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_mem" class="btn btn-primary" type="submit"><i class="fa-solid fa-user-plus"></i> Add Household</button>
                      
                    </div>
                  </div>
                </div>
              </div>
              </form>







              <div class="modal fade" id="addHouseholdMember" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Household Member</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              <form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">


              <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Household</label>
                <select  name="household_id" type="text" class="form-control" id="validationCustom01" value="" required>
                <?php foreach ($households as $household): ?>
                    <option value="<?php echo htmlspecialchars($household['id']); ?>">
                        <?php echo "Blk " . htmlspecialchars($household['Blk']) . " Lot " . htmlspecialchars($household['Lot']); ?>
                    </option>
                <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                Please enter first name.
                </div>
              </div>

              <div class="col-md-4">

                
                <div class="invalid-feedback">
                Please enter last name.
                </div>
              </div>

              <div class="col-md-4">
                
              </div>


              <div class="form-group col-md-4">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="form-group col-md-4">
        <label for="middle_name">Middle Name:</label>
        <input type="text" class="form-control" id="middle_name" name="middle_name">
    </div>
    <div class="form-group col-md-4">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="form-group col-md-4">
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
    </div>
    <div class="form-group col-md-4">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="relationship_to_head">Relationship to Head of Household:</label>
        <select class="form-control" id="relationship_to_head" name="relationship_to_head" required>
            <option value="Head">Head</option>
            <option value="Spouse">Spouse</option>
            <option value="Child">Child</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="occupation">Occupation:</label>
        <input type="text" class="form-control" id="occupation" name="occupation">
    </div>
    <div class="form-group col-md-4">
        <label for="national_id">National ID:</label>
        <input type="text" class="form-control" id="national_id" placeholder = "(Optional)" name="national_id">
    </div>
    <div class="form-group col-md-4">
        <label for="social_security_number">Social Security Number:</label>
        <input type="text" class="form-control" id="social_security_number" placeholder = "(Optional)" name="social_security_number">
    </div>
    <div class="form-group col-md-4">
        <label for="passport_number">Passport Number:</label>
        <input type="text" class="form-control" id="passport_number" placeholder = "(Optional)" name="passport_number">
    </div>
    <div class="form-group col-md-4">
        <label for="other_id_description">Other ID Description:</label>
        <input type="text" class="form-control" id="other_id_description" placeholder = "(Optional)" name="other_id_description">
    </div>
    <div class="form-group col-md-4">
        <label for="other_id_number">Other ID Number:</label>
        <input type="text" class="form-control" id="other_id_number" placeholder = "(Optional)" name="other_id_number">
    </div>
    <div class="form-group col-md-4">
        <label for="social_welfare_programs">Social Welfare Programs:</label>
        <input type="text" class="form-control" id="social_welfare_programs placeholder = "(Optional)"" name="social_welfare_programs">
    </div>
 
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_household_member" class="btn btn-primary" type="submit"><i class="fa-solid fa-user-plus"></i> Add Household Member</button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          </form>


<!-- End Modal -->

<!-- Household Details Modal -->


<div class="modal fade" id="householdDetails" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Household Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1 id="householdMembers"></h1>
                    </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        

<div class="pagetitle">
  <h1>HOUSEHOLD MASTERLIST</h1>
  <br>
  <button style="color:#e9e5d6; background-color: #008000;" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered" class="btn"><i class="fa-solid fa-user-plus"></i> Add Household</button>
  <br>
  <button style="color:#e9e5d6; background-color: #008000; margin-top: 10px;" type="button" data-bs-toggle="modal" data-bs-target="#addHouseholdMember" class="btn"><i class="fa-solid fa-user-plus"></i> Add Household Member</button>
</div><!-- End Page Title -->
<br>
<section class="section dashboard">
  <div class="row">
    <div style="margin: auto;" class="col-lg-8">

    <div class="row">
  <div style="text-align: center;" class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">All <span>| Household Members</span></h5>

                  <div style="" class="d-flex align-items-center justify-content-center">
                    <div style="background-color: #38a3f1; color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">

                   <?php
$sql = "SELECT COUNT(*) AS user_count FROM members WHERE household_id IS NOT NULL";
if ($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['user_count'];
    mysqli_free_result($result);
}

?>

                      <h1 style="font-weight: 800;"><?php echo $userCount ?></h1>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div style="text-align: center;" class="col-xxl-6 col-md-6">
              <div class="card info-card sales-card">

                <div  class="card-body">
                  <h5 class="card-title">Household </h5>

                  <div style="" class="d-flex align-items-center justify-content-center">
                    <div style="background-color: rgb(51, 145, 87); color: white; " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                    </div>
                    <div class="ps-3">

                    <?php
    $sql = "SELECT * from household";
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

   

<br>
      <div class="card">
        <div class="card-body">
            <br>
          <!-- Table with stripped rows -->
          <?php
// Prepare the SQL query
$sql = "SELECT h.blk, h.id, h.lot, m.first_name, m.last_name 
        FROM household h
        LEFT JOIN members m ON h.household_owner = m.id";



$result = mysqli_query($conn, $sql);

// Fetch the results
$households = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="card">
    <div class="card-title">
        <h1 class = "text-center">Households</h1>
    </div>
  <div class="card-body">
    <br>
    <!-- Table with stripped rows -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Block</th>
          <th>Lot</th>
          <th>Owner First Name</th>
          <th>Owner Last Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($households as $household): 
            
           
            $query = "SELECT first_name, last_name FROM household_members WHERE household_id = " . $household['id'];
      $result = mysqli_query($conn, $query);
      if (!$result) {
        // Handle error, e.g., log it or display a message
        echo "Error: " . $conn->error;
        continue; // Skip this iteration of the loop
    }
            $members = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            // Initialize an array to hold member names
            $memberNames = [];
            foreach ($members as $member) {
                // Concatenate each member's first and last name and add to the array
                $memberNames[] = htmlspecialchars($member['first_name']) . ' ' . htmlspecialchars($member['last_name']);
            }
            
            // Convert the array of names into a string
            $membersString = implode(", ", $memberNames);
      ?>
        <tr>
          <td><?= htmlspecialchars($household['blk']) ?></td>
          <td><?= htmlspecialchars($household['lot']) ?></td>
          <td><?= htmlspecialchars($household['first_name']) ?></td>
          <td><?= htmlspecialchars($household['last_name']) ?></td>
          <td><button data-bs-toggle="modal" data-bs-target="#householdDetails" onclick="changeMembers('<?php echo $membersString; ?>')">View Members</button></td>

        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- End Table with stripped rows -->
  </div>
</div>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

</main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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


const changeMembers = (householdMembers) => {
  const houseMembers = document.getElementById('householdMembers');
  const members = householdMembers.split(', ');
  houseMembers.innerHTML = '';
  members.forEach(member => {
    const memberElement = document.createElement('p');
    memberElement.textContent = member;
    houseMembers.appendChild(memberElement);
  });
  

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