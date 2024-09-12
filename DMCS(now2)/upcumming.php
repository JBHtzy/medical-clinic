<?php
require_once 'database/dbconn.php';

// if (isset($_GET['yes'])) {
//     $arr = array();

//     $aw = $mysqli->query("SELECT medicines.medicine as name,expenses.quantity as quan, upcoming_qty.remaining_qty as remaining, upcoming_qty.upcome_qty as upcome, upcoming_qty.total as total From upcoming_qty JOIN medicines on upcoming_qty.med_id = medicines.id JOIN expenses on expenses.medicine = upcoming_qty.med_id GROUP by medicines.medicine");

//     while ($aww = $aw->fetch_assoc()) {
//         array_push($arr, $aww);
//     }
//     echo json_encode($arr);
// }

include 'process.php';
resetStockIn($mysqli);
updateStockIn($mysqli, $stockIn);
