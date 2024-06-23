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
  <select name="blk" class="form-control" id="validationCustom01" required>
    <?php for ($i = 1; $i <= 10; $i++): ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
  </select>
  <div class="invalid-feedback">
    Please select a block number.
  </div>
</div>

<div class="col-md-4">
  <label for="validationCustom02" class="form-label">Lot #</label>
  <select name="lot" class="form-control" id="validationCustom02">
    <?php for ($i = 1; $i <= 10; $i++): ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
  </select>
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
                <label for="validationCustom01" class="form-label">Member</label>
                <select  name="member_id" type="text" class="form-control" id="validationCustom02" value="" required>
                <?php foreach ($members as $member): ?>
                    <option value="<?php echo htmlspecialchars($member['id']); ?>">
                        <?php echo htmlspecialchars($member['first_name']) . " " . htmlspecialchars($member['last_name']); ?>
                    </option>
                <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                Please enter first name.
                </div>
              </div>

              

              <div class="col-md-4">
                
              </div>



           
    <div class="form-group col-md-4">
      <label for="relationship_to_head">Relationship to Head:</label>
      <input type="text" class="form-control" id="relationship_to_head" placeholder="(Optional)" name="relationship_to_head">
    </div>
    <div class="form-group col-md-4">
      <label for="occupation">Occupation:</label>
      <input type="text" class="form-control" id="occupation" placeholder="(Optional)" name="occupation">
    </div>
    <div class="form-group col-md-4">
      <label for="national_id">National ID:</label>
      <input type="text" class="form-control" id="national_id" placeholder="(Optional)" name="national_id">
    </div>
    <div class="form-group col-md-4">
      <label for="social_security_number">Social Security Number:</label>
      <input type="text" class="form-control" id="social_security_number" placeholder="(Optional)" name="social_security_number">
    </div>
    <div class="form-group col-md-4">
      <label for="passport_number">Passport Number:</label>
      <input type="text" class="form-control" id="passport_number" placeholder="(Optional)" name="passport_number">
    </div>
    <div class="form-group col-md-4">
      <label>Additional Information:</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="is_ethnic" name="is_ethnic">
        <label class="form-check-label" for="is_ethnic">Is Ethnic</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="is_pwd" name="is_pwd">
        <label class="form-check-label" for="is_pwd">Is PWD</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="is_political_family" name="is_political_family">
        <label class="form-check-label" for="is_political_family">Is Political Family</label>
      </div>
    </div>
    
    <div class="form-group col-md-4">
        <label for="other_id_number">Other ID Number:</label>
        <input type="text" class="form-control" id="other_id_number" placeholder = "(Optional)" name="other_id_number">
    </div>

    <div class="form-group col-md-4">
      <label for="other_id_description">Other ID Description:</label>
      <input type="text" class="form-control" id="other_id_description" placeholder="(Optional)" name="other_id_description">
    </div>
    <div class="form-group col-md-4">
        <label for="social_welfare_programs">Social Welfare Programs:</label>
        <input type="text" class="form-control" id="social_welfare_programs" placeholder = "(Optional)" name="social_welfare_programs">
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


<div class="modal fade"  id="householdDetails" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg" >
                  <div class="modal-content" >
                    <div class="modal-header">
                      <h5 class="modal-title">Household Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"  >
                        <div id="householdMembers"></div>
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
$sql = "SELECT COUNT(*) AS user_count FROM household_members";
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
          $query = "SELECT m.first_name, m.last_name, hm.relationship_to_head, hm.occupation, hm.social_security_number, hm.passport_number, hm.other_id_description, hm.other_id_number, hm.social_welfare_programs, hm.is_pwd, hm.is_political_family, hm.is_ethnic
                FROM household_members hm
                JOIN members m ON hm.member_id = m.id
                WHERE hm.household_id = " . $household['id'];
      $result = mysqli_query($conn, $query);
      if (!$result) {
        // Handle error, e.g., log it or display a message
        echo "Error: " . $conn->error;
        continue; // Skip this iteration of the loop
    }
            $members = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        
      ?>
        <tr>
          <td><?= htmlspecialchars($household['blk']) ?></td>
          <td><?= htmlspecialchars($household['lot']) ?></td>
          <td><?= htmlspecialchars($household['first_name']) ?></td>
          <td><?= htmlspecialchars($household['last_name']) ?></td>
          <td><button data-bs-toggle="modal" data-bs-target="#householdDetails"  onclick="changeMembers('<?php echo htmlspecialchars(json_encode($members), ENT_QUOTES, 'UTF-8'); ?>')">View Members</button></td>
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
  houseMembers.style.overflow = 'auto';
  let tableContent = '';
  householdMembers = JSON.parse(householdMembers);
  householdMembers.forEach(member => {
    tableContent += `
      <tr>
        <td>${member.first_name}</td>
        <td>${member.last_name}</td>
        <td>${member.relationship_to_head}</td>
        <td>${member.occupation}</td>
        <td>${member.social_security_number}</td>
        <td>${member.passport_number}</td>
        <td>${member.other_id_description}</td>
        <td>${member.other_id_number}</td>
        <td>${member.social_welfare_programs}</td>
        <td>${member.is_pwd}</td>
        <td>${member.is_political_family}</td>
        <td>${member.is_ethnic}</td>
      </tr>
    `;
  });

  houseMembers.innerHTML = `
    <table class="table table-striped">
      <thead>
        <tr class = "table-row">
          <th scope = 'col'>First Name</th>
          <th scope = 'col'>Last Name</th>
          <th scope = 'col'>Relationship to Head</th>
          <th scope = 'col'>Occupation</th>
          <th scope = 'col'>Social Security Number</th>
          <th scope = 'col'>Passport Number</th>
          <th scope = 'col'>Other ID Description</th>
          <th scope = 'col'>Other ID Number</th>
          <th scope = 'col'>Social Welfare Programs</th>
          <th scope = 'col'>Is PWD</th>
          <th scope = 'col'>Is Political Family</th>
          <th scope = 'col'>Is Ethnic</th>
        </tr>
      </thead>
      <tbody>
        ${tableContent}
      </tbody>
    </table>
  `;

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