<!-- NAVBAR -->
<div class="navbar">
    <h3><i class="fas fa-phone"></i>Contact No: +639489191629</h3>
    <nav class="nav">
        <input type="checkbox" id="checkbox_toggle" />
        <img src="../imgs/logo2_24_21540.png" alt="" />
        <ul class="menu">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="homepage.php#aboutus">About Us</a></li>
            <li><a href="homepage.php#services">Services</a></li>
            <li id="userdropdown"><i class="fa-solid fa-user"></i>
                <span>
                    <?= $owner ?>
                    <i class="fa-solid fa-caret-down"></i>
                </span>
            </li>
        </ul>
        <label for="checkbox_toggle" class="icon">
            <i class="fa-solid fa-bars"></i>
        </label>
        <?php
        $userstat = $userfirst . $userlast;
        $notif = $mysqli->query("SELECT id, count(notify_status) as notifCount FROM `schedule` WHERE patient = '$userstat' and notify_status = 'new'"); ?>
        <i class="fa-solid fa-bell" id="notif-dropdown"></i>
        <div class="notifyball">
            <?php while ($ncount = $notif->fetch_assoc()) { ?>
                <?php echo $ncount['notifCount'] ?>
        </div>
    <?php } ?>
    </nav>
    <div class="usermodal">
        <div class="modalbody">
            <a href="userprof.php">Profile</a>
            <a href="../process.php?logout=">Logout</a>
        </div>
    </div>
</div>

<?php
$userT = $userfirst . $userlast;
$notif = $mysqli->query("SELECT id, status FROM schedule where status = 'done' order by id desc"); ?>
<div class="notifbell">
    <?php if (mysqli_num_rows($notif) > 0) {
        while ($row = $notif->fetch_assoc()) {
            $id = $row['id'];
            $status = $row['status']; ?>
            <div class="notifbody">
                <a href="homepage.php?readDel=<?php echo $id ?>">
                    <?php
                    if ($status === "done") {
                        echo 'Your booked schedule status is done. Thank you.';
                    } else if ($status === "cancel") {
                        echo 'Your booked schedule status is cancelled due to personal reasons. Thank you.';
                    } else if ($status === '') {
                        echo 'Invalid status';
                    }
                    ?>
                </a>
            </div>
    <?php }
    } ?>
</div>