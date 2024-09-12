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
        <img src="../imgs/logo2_24_21540.png" alt="">
        <h4 class="fw-bold text-white my-1">
            <?php if ($_SESSION["logged"] == true) {
                echo $_SESSION['greet'];
            } else {
                echo "error";
            }
            ?>
        </h4>
        <p>(Admin)</p>
    </div>
    <div class="divider"></div>
    <div class="list-group">
        <a href="home_admin.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-chart-pie"></i>Dashboard</a>
        <a class="fw-bold text-white dropdown-toggle" type="button" id="schedtog"><i class="mx-1 fa-solid fa-calendar-days"></i> Schedules</a>
        <ul class="fw-bold schedtoggle">
            <ul>
                <li><a href="schedulesAdmin.php">Schedule List</a></li>
                <li><a href="viewSched.php">View Schedules</a></li>
            </ul>
        </ul>

        <a class="fw-bold text-white dropdown-toggle" type="button" id="onToggle"><i class="mx-1 fas fa-box-open"></i>Manage Users</a>
        <ul class="fw-bold subtoggle">
            <li><a href="userlist.php"><i class="fa-solid fa-truck-fast"></i>Pending Users</a></li>
            <li><a href="allUsers.php"><i class="fa-solid fa-notes-medical"></i>User List</a></li>
        </ul>

        <a href="logs.php" class="fw-bold text-white"><i class="mx-1 fa-solid fa-receipt"></i>History Logs</a>
    </div>
</div>