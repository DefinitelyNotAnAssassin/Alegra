
<!-- ======= Header ======= -->


<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center ">
    <a href="index.php" class="logo">
      <img src="assets/img/banner2.png" alt=""></a>
      <i class="bi bi-list toggle-sidebar-btn"></i>

  </div><!-- End Logo -->



  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->


      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="user_img/<?php echo  $_SESSION['profile'];?>" alt="Profile" class="rounded-circle">
          <span class=""><?php echo  $_SESSION['name'];?> </span>
        </a><!-- End Profile Iamge Icon -->

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
