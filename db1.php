<?php
// Database connection file
$servername = "localhost";
$username = "root";
$password = ""; // Change if you have a password set
$dbname = "php_crud1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
