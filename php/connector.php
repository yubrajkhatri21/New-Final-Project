<?php
// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection parameters
$server = 'localhost';
$username = 'root'; // Replace with your actual database username
$password = ''; // Replace with your actual database password
$database = 'myfinalproject';

// Create a connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully!";
    // Additional code for database operations goes here
}
?>
