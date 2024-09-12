<?php
include('../include/sessionstart.php');
include_once '../database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Calendar</title>
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        #calendar {
            max-width: 1100px;
        }

        .fc-scrollgrid-sync-table {
            height: 100% !important;
        }

        .fc-view-harness-active {
            height: 67vh !important;
        }

        .fc-scroller-liquid-absolute {
            overflow: hidden !important;
        }
    </style>
</head>

<body>
    <?php include('include/navbar_admin.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar_admin.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow mb-4">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script>
        <?php
        $query = $mysqli->query("SELECT * FROM schedule ORDER BY id asc");
        ?>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventDidMount: function(info) {
                    if (info.view.type != 'timeGridDay') {
                        $(info.el).tooltip({
                            title: info.event.title
                        });
                    }
                },
                events: [<?php while ($rows = mysqli_fetch_array($query)) { ?> {
                            title: '<?php echo $rows['patient'] . ' | ' . $rows['service'] . ' | ' . $rows['time_sched'] ?>',
                            start: '<?php echo $rows['date'] ?>',
                            color: 'grey'
                        },
                    <?php } ?>
                ],
            });
            calendar.render();
        });
        $(document).ready(function() {
            let schedtoggle = 0;
            $('#schedtog').click(function() {
                schedtoggle++;
                if (schedtoggle % 2 == 0) {
                    $('.schedtoggle').slideToggle();
                } else {
                    $('.schedtoggle').slideDown();
                }
            });
            let oms = 0;
            $('#onToggle').click(function() {
                oms++;
                if (oms % 2 == 0) {
                    $('.subtoggle').slideToggle();
                } else {
                    $('.subtoggle').slideDown();
                }
            });
        })
    </script>
</body>

</html>