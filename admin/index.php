<?php
require_once '../models/vehicles_db.php'; // Ensure this path is correct

// Handle the delete action if delete_id is set
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_success = delete_vehicle($delete_id);

    if ($delete_success) {
        header("Location: index.php"); // Redirect after successful delete
        exit();
    } else {
        echo "Error deleting vehicle.";
    }
}

// Fetch all vehicles
$vehicles = get_all_vehicles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body>
    <header>
        <h1>Zippy Used Autos - Admin Panel</h1>
    </header>

    <nav>
        <a href="add_vehicle.php" class="btn">Add Vehicle</a>
    </nav>

    <h2>Manage Vehicles</h2>

    <table>
        <thead>
            <tr>
                <th>Model</th>
                <th>Price</th>
                <th>Year</th>
                <th>Type</th>
                <th>Class</th>
                <th>Make</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicles as $vehicle) : ?>
                <tr>
                    <td><?= htmlspecialchars($vehicle['model']) ?></td>
                    <td>$<?= number_format($vehicle['price'], 2) ?></td>
                    <td><?= $vehicle['year'] ?></td>
                    <td><?= htmlspecialchars($vehicle['type_name']) ?></td>
                    <td><?= htmlspecialchars($vehicle['class_name']) ?></td>
                    <td><?= htmlspecialchars($vehicle['make_name']) ?></td>
                    <td>
                        <!-- Delete button with confirmation before deleting -->
                        <a href="index.php?delete_id=<?= $vehicle['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
