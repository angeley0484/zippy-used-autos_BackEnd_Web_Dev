<?php
// Include database connection
include_once('../config/db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form data
    $year = (int) $_POST['year'];
    $model = trim($_POST['model']);
    $price = (float) $_POST['price'];
    $type_id = (int) $_POST['type'];
    $class_id = (int) $_POST['class'];
    $make_id = (int) $_POST['make'];

    // Check if values are valid
    if ($year > 0 && !empty($model) && $price > 0 && $type_id > 0 && $class_id > 0 && $make_id > 0) {
        // Prepare SQL statement to prevent SQL injection
        $sql = "INSERT INTO vehicles (year, model, price, type_id, class_id, make_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('isdiii', $year, $model, $price, $type_id, $class_id, $make_id);
            if ($stmt->execute()) {
                // Redirect to the vehicle list page after successful insertion
                header("Location: ../admin/index.php?status=success");
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Prepare statement failed: " . $conn->error;
        }
    } else {
        $error_message = "Invalid input. Please check your form data.";
    }
}

// Fetch makes, types, and classes for dropdown options
$makes_result = $conn->query("SELECT * FROM makes");
$types_result = $conn->query("SELECT * FROM types");
$classes_result = $conn->query("SELECT * FROM classes");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Vehicle</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<header>
    <h1>Zippy Used Autos - Admin</h1>
</header>

<h2>Add New Vehicle</h2>

<?php if (isset($error_message)): ?>
    <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
<?php endif; ?>

<form method="POST" action="add_vehicle.php">
    <label for="year">Year:</label>
    <input type="number" name="year" required><br><br>

    <label for="model">Model:</label>
    <input type="text" name="model" required><br><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" required><br><br>

    <label for="type">Type:</label>
    <select name="type" required>
        <option value="">Select Type</option>
        <?php while ($type = $types_result->fetch_assoc()): ?>
            <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['type_name']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="class">Class:</label>
    <select name="class" required>
        <option value="">Select Class</option>
        <?php while ($class = $classes_result->fetch_assoc()): ?>
            <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['class_name']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="make">Make:</label>
    <select name="make" required>
        <option value="">Select Make</option>
        <?php while ($make = $makes_result->fetch_assoc()): ?>
            <option value="<?= $make['id'] ?>"><?= htmlspecialchars($make['make_name']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Add Vehicle">
</form>

<!-- Return to Vehicle List button -->
<a href="../admin/index.php" class="btn">Return to Vehicle List</a>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
