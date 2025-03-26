<?php
// controllers/vehicles.php

include_once('../models/vehicles_db.php');

// Display vehicles for customers
function display_vehicles($sort_by = 'price') {
    // Validate sort order (price or year)
    $valid_sort_options = ['price', 'year'];
    if (!in_array($sort_by, $valid_sort_options)) {
        $sort_by = 'price';  // Default to sorting by price
    }

    $vehicles = get_all_vehicles($sort_by); // Get vehicles based on sorting
    include('../views/vehicle_list.php');   // Render the vehicle list view
}
?>
