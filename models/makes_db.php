<?php
// models/makes_db.php

// Include database connection
include_once('../config/db.php');

function get_all_makes() {
    global $conn;
    $sql = "SELECT * FROM makes";
    $result = $conn->query($sql);
    $makes = [];

    while ($row = $result->fetch_assoc()) {
        $makes[] = $row;
    }

    return $makes;
}
?>
