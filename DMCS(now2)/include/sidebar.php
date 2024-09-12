<style>
  .side {
    background: #08203e;
  }

  .subtoggle {
    list-style: none;
    display: none;
  }

  .schedtoggle {
    list-style: none;
    display: none;
  }

  .subtoggle2 {
    list-style: none;
    display: none;
  }
</style>
<div class="side" id="sidebar-wrapper">
  <div class="pichead text-center mt-1 py-3">
    <img src="imgs/logo2_24_21540.png" alt="">
    <h4 class="fw-bold text-white my-1">
      <?php if ($_SESSION["logged"] == true) {
        echo $_SESSION['greetstaff'];
      } else {
        echo "error";
      }
      ?>
    </h4>
    <p>(Staff)</p>
  </div>
  <div class="divider"></div>
  <div class="list-group">
    <a href="home.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-chart-pie"></i>Dashboard</a>
    <a class="fw-bold text-white dropdown-toggle" type="button" id="schedtog"><i class="mx-1 fa-solid fa-calendar-days"></i> Schedules</a>
    <ul class="fw-bold schedtoggle">
      <ul style="padding: 0;width: 101%;font-size: 28px;">
        <li><a href="schedules.php">Schedule List</a></li>
        <li><a href="schedtab.php">View Schedules</a></li>
      </ul>
    </ul>

    <a class="fw-bold text-white dropdown-toggle" type="button" id="onToggle"><i class="mx-1 fas fa-box-open"></i>Inventory</a>
    <ul class="fw-bold subtoggle">
      <li><a class="dropdown-toggle" type="button" id="onToggle2"><i class="fa-solid fa-capsules"></i>Medicines</a></li>
      <ul class="subtoggle2" style="padding: 0;width: 101%;font-size: 28px;">
        <li><a href="medicines.php">List of Meds</a></li>
        <li><a href="upcoming_stocks.php">Available Stocks</a></li>
        <!-- <li><a href="#">Remaining Meds</a></li> -->
      </ul>
      <!-- <li><a href="upcoming_stocks.php"><i class="fa-solid fa-truck-fast"></i> Upcoming</a></li> -->
      <!-- <li><a href="receipt_form.php"><i class="fa-solid fa-notes-medical"></i>Receipt</a></li> -->
    </ul>
    <a href="receipt_form.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-notes-medical"></i>Receipt</a>
    <!-- <a href="logs.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-receipt"></i>Logs Info</a> -->
  </div>
</div>