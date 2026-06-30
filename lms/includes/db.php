<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default WAMP password is empty
$dbname = "lms_db";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection failed
if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}

// Set charset encoding to support all characters
mysqli_set_charset($conn, "utf8mb4");
?>