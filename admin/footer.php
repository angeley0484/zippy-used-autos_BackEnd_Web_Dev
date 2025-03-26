<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<footer>
    <div class="footer-content">
        <ul>
            <li><a href="index.php" <?php if ($current_page == 'index.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>Admin Home</a></li>
            <li><a href="add_vehicle.php" <?php if ($current_page == 'add_vehicle.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>Add Vehicle</a></li>
            <li><a href="view_vehicles.php" <?php if ($current_page == 'view_vehicles.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>View Vehicles</a></li>
            <li><a href="makes.php" <?php if ($current_page == 'makes.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>Makes</a></li>
            <li><a href="types.php" <?php if ($current_page == 'types.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>Types</a></li>
            <li><a href="classes.php" <?php if ($current_page == 'classes.php') echo 'class="current" style="pointer-events: none; color: gray;"'; ?>>Classes</a></li>
        </ul>
    </div>
</footer>
