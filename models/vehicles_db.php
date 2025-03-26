<?php
// Ensure the database connection is correctly included
require_once __DIR__ . '/../config/db.php'; // Adjust path to db.php if necessary

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . $conn->connect_error); // Display connection error
}

/**
 * Get all vehicles from the database, sorted by price descending.
 * @return array|false Returns an array of vehicles or false on failure.
 */
function get_all_vehicles() {
    global $conn; // Make sure $conn is available globally

    $sql = "SELECT v.id, v.model, v.price, v.year, t.type_name, c.class_name, m.make_name
            FROM vehicles v
            JOIN types t ON v.type_id = t.id
            JOIN classes c ON v.class_id = c.id
            JOIN makes m ON v.make_id = m.id
            ORDER BY v.price DESC"; 

    // Perform the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Return fetched data as associative array
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // No vehicles found
    }
}

/**
 * Delete a vehicle by ID.
 * @param int $id The vehicle ID to delete.
 * @return bool Returns true on success, false on failure.
 */
function delete_vehicle($id) {
    global $conn;

    $sql = "DELETE FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Check if the prepare statement failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the ID parameter and execute the query
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

/**
 * Add a new vehicle to the database.
 * @param string $model Vehicle model name.
 * @param float $price Vehicle price.
 * @param int $year Vehicle manufacturing year.
 * @param int $make_id Foreign key reference to makes table.
 * @param int $type_id Foreign key reference to types table.
 * @param int $class_id Foreign key reference to classes table.
 * @return bool Returns true on success, false on failure.
 */
function add_vehicle($model, $price, $year, $make_id, $type_id, $class_id) {
    global $conn; // Ensure the $conn object is available

    $sql = "INSERT INTO vehicles (model, price, year, make_id, type_id, class_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Debugging line
    }

    $stmt->bind_param("sdiiii", $model, $price, $year, $make_id, $type_id, $class_id);
    return $stmt->execute();
}

