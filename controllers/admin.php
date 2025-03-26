<?php
// controllers/admin.php

include_once('../models/vehicles_db.php');
include_once('../models/makes_db.php');
include_once('../models/types_db.php');
include_once('../models/classes_db.php');

// Show the admin dashboard
function admin_dashboard() {
    $vehicles = get_all_vehicles();  // Get all vehicles from the model
    include('../views/admin_dashboard.php');  // Render the view
}

// Add a vehicle
function add_vehicle() {
    include('../models/makes_db.php');
    include('../models/types_db.php');
    include('../models/classes_db.php');

    $makes = get_all_makes();
    $types = get_all_types();
    $classes = get_all_classes();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $year = $_POST['year'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $type_id = $_POST['type'];
        $class_id = $_POST['class'];
        $make_id = $_POST['make'];

        // Insert the new vehicle into the database
        if (add_vehicle($year, $model, $price, $type_id, $class_id, $make_id)) {
            echo "Vehicle added successfully!";
        } else {
            echo "Error adding vehicle.";
        }
    }
    include('../views/add_vehicle_form.php');  // Render the add vehicle form view
}
?>
