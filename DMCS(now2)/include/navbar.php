<style>
  .navbar {
    position: sticky;
    top: 0px;
    z-index: 2;
    background: #08203e;
  }
</style>

<nav class="navbar navbar-expand-lg py-0">
  <div class="d-flex align-items-center py-3">
    <i class="fa-solid fa-bars text-white fs-4 mx-4" id="menu-toggle"></i>
    <span class="fs-5 text-white text-uppercase fw-bold" id="companyname">Dimaano Medical Clinic</span>
  </div>
  <div class="collapse navbar-collapse pe-5 justify-content-end" id="navbarNav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
        <li><a class="dropdown-item" href="process.php?logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
      </ul>
    </li>
  </div>
</nav>