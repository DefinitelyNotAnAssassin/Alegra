<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
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
      <a class="nav-link collapsed" data-bs-target="#household-nav" data-bs-toggle="collapse" href="#">
      <i class="fa-solid fa-people-group"></i><span>Household</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="household-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="household_masterlist.php">
          <i class="fa-regular fa-rectangle-list"></i><span>Masterlist</span>
          </a>
        </li>
    

        
      </ul>
    </li><!-- End Components Nav -->

    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#prj-nav" data-bs-toggle="collapse" href="#">
      <i class="fa-solid fa-bars-progress"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="prj-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
      <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
      <a class="nav-link collapsed" data-bs-target="#fac-nav" data-bs-toggle="collapse" href="#">
      <i class="fa-solid fa-warehouse"></i><span>Reservation</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="fac-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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