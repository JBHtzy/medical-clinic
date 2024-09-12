<?php

// $mysqli = new mysqli('localhost', 'ascblzri_dimaano-clinic_root', 'jamesthesisP@$$', 'ascblzri_dimaano-clinic');
$mysqli = new mysqli('localhost', 'root', '', 'dmcs');

if ($mysqli->connect_errno) {
    die('Connection Error: ' . $mysqli->connect_errno);
}
