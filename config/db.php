<?php
// Database connection settings
$host = 'localhost'; // MySQL host
$username = 'root'; // MySQL username (default for XAMPP is 'root')
$password = ''; // MySQL password (default for XAMPP is empty)
$dbname = 'zippyusedautos'; // Your database name

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Display error if connection fails
}
?>
