<?php include('common.php'); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM vehicles WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Vehicle deleted successfully.";
        header("Location: view_vehicles.php");  // Redirect back to the vehicles page
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
