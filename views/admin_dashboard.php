<?php
// views/admin_dashboard.php

echo "<h1>Admin Dashboard</h1>";
echo "<a href='add_vehicle.php'>Add New Vehicle</a><br><br>";

echo "<table>";
echo "<tr><th>Model</th><th>Price</th><th>Year</th><th>Actions</th></tr>";
foreach ($vehicles as $vehicle) {
    echo "<tr>";
    echo "<td>" . $vehicle['model'] . "</td>";
    echo "<td>" . $vehicle['price'] . "</td>";
    echo "<td>" . $vehicle['year'] . "</td>";
    echo "<td><a href='delete_vehicle.php?id=" . $vehicle['id'] . "'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
