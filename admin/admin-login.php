<?php
ob_start();
include_once("class/adminback.php");
$obj = new adminback();

require 'class/db.php';

if (isset($_POST['admin_login_btn'])) {
  $logmsg = $obj->admin_login($_POST);
}

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  if ($id) {
    header('location:index.php');
  }
}


?>

<link href="assets/styles.css" rel="stylesheet">
<?php include('header.php')?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
<script src="https://kit.fontawesome.com/a741b189ae.js" crossorigin="anonymous"></script>

<div class="container-fluid ps-md-0">
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6" style="background-color: #e9e5d6;">
      <div class="login d-flex align-items-center py-5">
        <div class="container" >
          <div class="row">
          <div class="col-md-9 col-lg-8 mx-auto">
          <?php if(isset($logmsg)){ ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                    <?php
                        echo $logmsg;
                        ?>

            </div>
            <?php } ?>
            <br>
            <br>
              <h3 class="login-heading mb-4"><i class="fa-solid fa-user-gear"></i> Admin Login</h3>
              <hr class="slash">
              <br>
              <br>
              <!-- Sign In Form -->
              <form action="" autocomplete="off" class="" method="POST">
                <div class="form-floating mb-3" >
                  <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
                  <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"> <br><a id="togglePassword" style="color: #201c18; cursor: pointer;"><i class="ri-eye-fill"></i>View Password</a>
                  <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid">
                  <button style="border: none;" class="btn-login text-uppercase" name="admin_login_btn" type="submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Sign in</button>
                </div>
                <br>
                <br>
                <hr class="slash">

              </form>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#floatingPassword  ');

  togglePassword.addEventListener('click', function(e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
  });
</script>

<script>


		jQuery(document).ready(function(){
					jQuery(document).ready(function(){
						$("#correct").hide();
						$("#error").hide();
						jQuery("#login_form").submit(function(e){
								e.preventDefault();
								var formData = jQuery(this).serialize();
								$.ajax({
									type: "POST",
									url: "process_files/login.php",
									data: formData,
									success: function(html){
									if(html=='true' )
									{
										$('#error').hide();
										$("#correct").slideDown();
										var delay = 2000;
										setTimeout(function(){	window.location = 'index.php';   }, delay);
									}else{
									$('#error').slideDown();	
										var delay = 2000;
										setTimeout(function(){	$('#error').slideUp();  }, delay);
									}
									}
								});
									return false;
						});
						});
						});
	
</script>