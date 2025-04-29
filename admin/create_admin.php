<?php
include '../connect.php'; // Include the database connection

// Admin credentials
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Hash the password

// Insert admin user
$sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
if (mysqli_query($con, $sql)) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . mysqli_error($con);
}
?>