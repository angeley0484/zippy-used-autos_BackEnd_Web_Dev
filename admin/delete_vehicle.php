<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "zippyusedautos");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Debugging output (remove this in production)
    echo "Deleting vehicle with ID: " . $id . "<br>";

    // Use a prepared statement to prevent SQL injection
    $sql = "DELETE FROM vehicles WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Debugging error
    }

    // Bind the 'id' parameter and execute the query
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Vehicle deleted successfully";
        header("Location: ../admin/index.php"); // Adjust path if necessary
        exit();
    } else {
        echo "Error deleting vehicle: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid ID parameter!";
}

// Close the connection
$conn->close();
?>
