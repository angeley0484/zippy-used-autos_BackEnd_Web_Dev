<?php
// Include database connection
include_once('config/db.php');

// Initialize where clauses for filtering
$whereClauses = [];

// Filter by Make
if (isset($_GET['make']) && $_GET['make'] != '') {
    $whereClauses[] = "make_id = " . $_GET['make'];
}

// Filter by Type
if (isset($_GET['type']) && $_GET['type'] != '') {
    $whereClauses[] = "type_id = " . $_GET['type'];
}

// Filter by Class
if (isset($_GET['class']) && $_GET['class'] != '') {
    $whereClauses[] = "class_id = " . $_GET['class'];
}

// Combine filters into the WHERE clause
$whereSQL = count($whereClauses) > 0 ? "WHERE " . implode(' AND ', $whereClauses) : '';

// Query to fetch vehicles based on selected filters and sort by price (descending)
$sql = "SELECT * FROM vehicles " . $whereSQL . " ORDER BY price DESC"; // You can change ORDER BY to 'year DESC' for sorting by year
$result = $conn->query($sql);

// Query to fetch makes for the dropdown menu
$makes_sql = "SELECT * FROM makes";
$makes_result = $conn->query($makes_sql);

// Query to fetch types for the dropdown menu
$types_sql = "SELECT * FROM types";
$types_result = $conn->query($types_sql);

// Query to fetch classes for the dropdown menu
$classes_sql = "SELECT * FROM classes";
$classes_result = $conn->query($classes_sql);

// Handle deleting a vehicle
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the vehicle from the database
    $delete_sql = "DELETE FROM vehicles WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param('i', $delete_id);
    $delete_stmt->execute();
    
    // Redirect after deletion
    header("Location: view_vehicles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Used Autos - Vehicle List</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<header>
    <h1>Zippy Used Autos</h1>
    <p>Welcome to the vehicle listings page!</p>
</header>

<!-- Vehicle Filters -->
<form method="GET" action="view_vehicles.php">
    <label for="make">Make:</label>
    <select name="make" id="make">
        <option value="">Select Make</option>
        <!-- Populate makes from the database -->
        <?php while ($row = $makes_result->fetch_assoc()): ?>
            <option value="<?= $row['id']; ?>" <?= (isset($_GET['make']) && $_GET['make'] == $row['id']) ? 'selected' : ''; ?>>
                <?= $row['make_name']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="type">Type:</label>
    <select name="type" id="type">
        <option value="">Select Type</option>
        <!-- Populate types from the database -->
        <?php while ($row = $types_result->fetch_assoc()): ?>
            <option value="<?= $row['id']; ?>" <?= (isset($_GET['type']) && $_GET['type'] == $row['id']) ? 'selected' : ''; ?>>
                <?= $row['type_name']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="class">Class:</label>
    <select name="class" id="class">
        <option value="">Select Class</option>
        <!-- Populate classes from the database -->
        <?php while ($row = $classes_result->fetch_assoc()): ?>
            <option value="<?= $row['id']; ?>" <?= (isset($_GET['class']) && $_GET['class'] == $row['id']) ? 'selected' : ''; ?>>
                <?= $row['class_name']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <input type="submit" value="Apply Filters">
</form>

<!-- Vehicle Listings -->
<h2>Available Vehicles</h2>
<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Model</th>
                <th>Make</th>
                <th>Type</th>
                <th>Class</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($vehicle = $result->fetch_assoc()): ?>
                <!-- Fetch make, type, and class names instead of IDs -->
                <?php
                $make_query = $conn->query("SELECT make_name FROM makes WHERE id = " . $vehicle['make_id']);
                $make_name = $make_query->fetch_assoc()['make_name'];

                $type_query = $conn->query("SELECT type_name FROM types WHERE id = " . $vehicle['type_id']);
                $type_name = $type_query->fetch_assoc()['type_name'];

                $class_query = $conn->query("SELECT class_name FROM classes WHERE id = " . $vehicle['class_id']);
                $class_name = $class_query->fetch_assoc()['class_name'];
                ?>
                <tr>
                    <td><?= $vehicle['model']; ?></td>
                    <td><?= $make_name; ?></td>
                    <td><?= $type_name; ?></td>
                    <td><?= $class_name; ?></td>
                    <td>$<?= number_format($vehicle['price'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No vehicles found matching the selected filters.</p>
<?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
