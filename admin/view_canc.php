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

$staff = $obj-> display_memberin();

date_default_timezone_set("Asia/Dhaka");

$qry = $conn->query("SELECT * FROM projects where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
$tprog = $conn->query("SELECT * FROM task_list where project_id = {$id}")->num_rows;
$cprog = $conn->query("SELECT * FROM task_list where project_id = {$id} and status = 3")->num_rows;
$prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
$prog = $prog > 0 ?  number_format($prog,2) : $prog;
$prod = $conn->query("SELECT * FROM user_productivity where project_id = {$id}")->num_rows;

$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");

ini_set('display_errors',0);
if($status == 0 && strtotime(date('Y-m-d')) >= strtotime($start_date)):
    if($prod  > 0  || $cprog > 0)
      $status = 0;
    else
      $status = 0;
    elseif($status == 0 && strtotime(date('Y-m-d')) > strtotime($end_date)):
    $status = 0;
    endif;


if(isset($_GET['status'])){
    if($_GET['status']=='view'){
        $id = $_GET['id'];
       $prj = $obj->display_projetcbyid($id);
    }
}

if(isset($_GET['status'])){
    if($_GET['status']=='edit'){
        $id = $_GET['id'];
       $prj = $obj->display_projetcbyid($id);
    }
}


if(isset($_POST['add_task'])){
	$msg = $obj->add_task($_POST);

  }

  
if(isset($_GET['status'])){

ini_set('display_errors',0);
  $get_id = $_GET['taskid'];
  if($_GET['status']=="delete"){
     $del_msg = $obj->delete_task($get_id);
  }
}


//    $service = $obj-> display_service();
  //  $reservation = $obj-> display_reservation();
	//  $staff = $obj-> show_staff_user();
	  $task = $obj-> display_task();
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
                      <h5 class="modal-title">Add New Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

					<form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

					<h5>Task Information: </h5>

<input type="hidden"  name="proj_id" value="<?php echo $id ?>">

  <div class="col-md-12">
	<label for="validationCustom01" class="form-label">Task</label>
	<input name="task" type="text" class="form-control" id="validationCustom01" value="" required>
	<div class="invalid-feedback">
	Please enter task title.
	</div>
  </div>


  <div class="col-md-8">
  </div>


  <div class="col-md-8">
  </div>

  <div class="col-md-12">
	<label for="validationCustom02" class="form-label">Description</label>
	<textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required></textarea>
	<div class="invalid-feedback">
	Please enter valid description.
	</div>
  </div>



  <div class="col-md-8">
  </div>



  <div class="col-md-12">

                  <label class="col-sm-2 col-form-label">Member</label>
                  <div class="col-sm-12">
                    <select name="staff" class="form-select" aria-label="Default select example">
					<option value=""  selected disabled >Select a Staff</option>
					<?php while($st = mysqli_fetch_assoc($staff)){ ?>
        			<option value="<?php echo $st['first_name']." ".$st['last_name'] ?>"><?php echo $st['first_name']." ".$st['last_name'] ?></option> <?php }?>
                    </select>
					<div class="invalid-feedback">
					Please choose a member.
	  				</div>
                  </div>
                </div>



  <div class="col-md-12">
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
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_task" class="btn btn-primary" type="submit"><i class="fa-solid fa-folder-plus"></i> Add Task</button>

                    </div>
                  </div>
                </div>
              </div>
              </form>


<div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

					<form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

					<h5>Task Information: </h5>

<input type="hidden"  name="proj_id" value="<?php echo $id ?>">

  <div class="col-md-12">
	<label for="validationCustom01" class="form-label">Task</label>
	<input name="task" type="text" class="form-control" id="validationCustom01" value="" required>
	<div class="invalid-feedback">
	Please enter task title.
	</div>
  </div>


  <div class="col-md-8">
  </div>


  <div class="col-md-8">
  </div>

  <div class="col-md-12">
	<label for="validationCustom02" class="form-label">Description</label>
	<textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required></textarea>
	<div class="invalid-feedback">
	Please enter valid description.
	</div>
  </div>



  <div class="col-md-8">
  </div>



  <div class="col-md-12">

                  <label class="col-sm-2 col-form-label">Member</label>
                  <div class="col-sm-12">
                    <select name="staff" class="form-select" aria-label="Default select example">
					<option value=""  selected disabled >Select a Staff</option>
					<?php while($st = mysqli_fetch_assoc($staff)){ ?>
        			<option value="<?php echo $st['first_name']." ".$st['last_name'] ?>"><?php echo $st['first_name']." ".$st['last_name'] ?></option> <?php }?>
                    </select>
					<div class="invalid-feedback">
					Please choose a member.
	  				</div>
                  </div>
                </div>



  <div class="col-md-12">
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
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_task" class="btn btn-primary" type="submit"><i class="fa-solid fa-folder-plus"></i> Add Task</button>

                    </div>
                  </div>
                </div>
              </div>
              </form>

			  <!-- -->


			  <div class="modal fade" id="edit" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add New Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

					<form class="row g-3 needs-validation" novalidate action="" autocomplete="" method="POST" enctype="multipart/form-data">

					<h5>Task Information: </h5>

<input type="hidden"  name="proj_id" value="<?php echo $id ?>">

  <div class="col-md-12">
	<label for="validationCustom01" class="form-label">Task</label>
	<input name="task" type="text" class="form-control" id="validationCustom01" value="" required>
	<div class="invalid-feedback">
	Please enter task title.
	</div>
  </div>


  <div class="col-md-8">
  </div>


  <div class="col-md-8">
  </div>

  <div class="col-md-12">
	<label for="validationCustom02" class="form-label">Description</label>
	<textarea name="des" type="text" class="form-control" id="validationCustom02" value="" required></textarea>
	<div class="invalid-feedback">
	Please enter valid description.
	</div>
  </div>



  <div class="col-md-8">
  </div>



  <div class="col-md-12">

                  <label class="col-sm-2 col-form-label">Member</label>
                  <div class="col-sm-12">
                    <select name="staff" class="form-select" aria-label="Default select example">
					<option value=""  selected disabled >Select a Staff</option>
					<?php while($st = mysqli_fetch_assoc($staff)){ ?>
        			<option value="<?php echo $st['first_name']." ".$st['last_name'] ?>"><?php echo $st['first_name']." ".$st['last_name'] ?></option> <?php }?>
                    </select>
					<div class="invalid-feedback">
					Please choose a member.
	  				</div>
                  </div>
                </div>



  <div class="col-md-12">
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
                      <button style="color:#e9e5d6; background-color: #008000; border: none;" name="add_task" class="btn btn-primary" type="submit"><i class="fa-solid fa-folder-plus"></i> Add Task</button>

                    </div>
                  </div>
                </div>
              </div>
              </form>

<div style="margin-left: 17%;">
    <a href="canc_project.php"><button style="color:#e9e5d6; background-color: #0080c0;" type="button" onclick="history.back()" class="btn">
    <div style="font-size: 18px;"class="icon">
                            <i class="bx bx-arrow-back"></i> Go back
                        </div></button></a>
    </div>
<div class="pagetitle">
    <h1>View Project</h1></h1>

</div><!-- End Page Title -->

<?php
        if(isset($msg)){
            echo $msg;
        }
    ?>

<div class="col-lg-8" style="margin: auto;">
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-info">


<div class="card">
  <div class="card-body">
    <h5 class="card-title"></h5>

				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<dl>


								<dt><b class="border-bottom border-primary">Project Name</b></dt>
								<br>
								<dd><h4><?php echo $prj['project'] ?></h4></dd>


        </dl>
        <br>

								<dt><b class="border-bottom border-primary">Description</b></dt>
								<dd><?php echo $prj['description'] ?></dd> <br>
							</dl>
						</div>

						<div class="col-md-6">

						<dl>
								<dt><b class="border-bottom border-primary">Project Date Added</b></dt>
								<dd><?php echo $prj['date_added'] ?></dd>
							</dl>

							<dl>
								<dt><b class="border-bottom border-primary">Start Date</b></dt>
								<dd><?php echo $prj['start_date'] ?></dd>
							</dl>

							<dl>
								<dt><b class="border-bottom border-primary">End Date</b></dt>
								<dd><?php echo $prj['deadline'] ?></dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Status</b></dt>
								<dd>
                <td class="project-state">
                <dd>
<?php
if($status==0){
echo "<p style='background-color:rgb(235, 235, 23); color: white; padding:2px;
text-transform: uppercase; font-weight: bold;'> Pending </p>";
}
elseif ($status==1){
echo "<p style='background-color:rgb(106, 163, 55); color: white; padding:2px;
text-transform: uppercase; font-weight: bold;'> Started </p>";
}
elseif ($status==2){
	echo "<p style='background-color:rgb(23, 171, 212); color: white; padding:2px;
	text-transform: uppercase; font-weight: bold;'> On Progress </p>";
	}
elseif ($status==4){
echo "<p style='background-color:rgb(23, 171, 212); color: white; padding:2px;
text-transform: uppercase; font-weight: bold;'> On Progress </p>";
}
elseif ($status==3){
echo "<p style='background-color:rgb(240, 10, 44); color: white; padding:2px;
text-transform: uppercase; font-weight: bold;'> Cancelled </p>";
}   else {
echo "<p style='background-color: rgb(51, 145, 87); color: white; padding:2px;
text-transform: uppercase; font-weight: bold;'> Done </p>";
}?>
</dd>
                      </td>
								</dd>
																</div>
</div>
      </div>
                                </dl>
                                </div>
                                </div>
                                <div class="row">


		<div class="col-md-12">
		<div class="row">
			<div class="col-sm-12">

		<div class="card">
            <div class="card-body">
              <h5 class="card-title">Site Pictures</h5>

              <!-- Slides with indicators -->
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="project_img/<?php echo $prj['site_pic'] ?>" class="d-block w-100" alt="...">

                  </div>
                  <div class="carousel-item">
                    <img src="project_img/<?php echo $prj['site_pic1'] ?>" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="project_img/<?php echo $prj['site_pic2'] ?>" class="d-block w-100" alt="...">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with indicators -->

            </div>
          </div>

</div>

<div class="col-sm-12">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<span><b>Task List:<br><br></b></span>

					<div class="card-tools">
					<button style="color:#e9e5d6; background-color: #008000;" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered" class="btn"><i class="fa-solid fa-folder-plus"></i> Add Task</button>
					</div>
		
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
					<table class="table table-condensed m-0 table-hover">

						<thead>
							<th>#</th>
							<th>Task</th>
							<th>Assigned to</th>
							<th>Description</th>
                            <th>Deadline</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							$tasks = $conn->query("SELECT * FROM task_list where project_id = {$id} order by id asc");
							while($row=$tasks->fetch_assoc()):
								$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
								unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
								$desc = strtr(html_entity_decode($row['description']),$trans);
								$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
							?>
								<tr>
			                        <td class="text-center"><?php echo $i++ ?></td>
			                        <td class=""><b><?php echo ucwords($row['task']) ?></b></td>
									<td class=""><b><?php echo ucwords($row['staff']) ?></b></td>
			                        <td class=""><p class="truncate"><?php echo strip_tags($desc) ?></p></td>
                  <td class=""><b><?php echo ucwords($row['deadline']) ?></b></td>
                  <td>
			                        	<?php 
			                        	if($row['status'] == 1){
									  		echo "<span class='badge' style='background-color: rgb(235, 235, 23);'>Pending</span>";
			                        	}elseif($row['status'] == 2){
									  		echo "<span class='badge' style='background-color: rgb(23, 171, 212);'>On-Progress</span>";
			                        	}elseif($row['status'] == 3){
									  		echo "<span class='badge' style='background-color: rgb(59, 168, 37);'>Done</span>";
			                        	}
			                        	?>
			                        </td>
			                        <td>
                                    <a href="edit_task.php?status=edit&&taskid=<?php echo $row['id'] ?>" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="?status=delete&&id=<?php echo $id ?>&&taskid=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this task? NOTE: This action cannot be undone.')"  type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
        </td>
		                    	</tr>
							<?php
							endwhile;
							?>
						</tbody>
					</table>
					</div>


    </div>
  </div>
				</div>
						</div>
			</div>
		</div>
	</div>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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