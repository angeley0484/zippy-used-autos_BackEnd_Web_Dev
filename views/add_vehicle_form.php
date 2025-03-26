<?php
// views/add_vehicle_form.php

echo "<h1>Add New Vehicle</h1>";
?>
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
        <?php foreach ($types as $type): ?>
            <option value="<?= $type['id'] ?>"><?= $type['type_name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="class">Class:</label>
    <select name="class" required>
        <option value="">Select Class</option>
        <?php foreach ($classes as $class): ?>
            <option value="<?= $class['id'] ?>"><?= $class['class_name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="make">Make:</label>
    <select name="make" required>
        <option value="">Select Make</option>
        <?php foreach ($makes as $make): ?>
            <option value="<?= $make['id'] ?>"><?= $make['make_name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Add Vehicle">
</form>
<a href="index.php">Back to Admin Panel</a>
