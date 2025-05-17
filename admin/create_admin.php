<?php
session_start();
include '../connect.php';

// Admin credentials
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Hash the password

// Check if admin already exists
$check = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
if (mysqli_num_rows($check) > 0) {
    echo "Admin user already exists!";
} else {
    // Insert admin user
    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($con, $sql)) {
        echo "Admin user created successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM admin WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $admin = $res->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Admin user not found!";
    }
}
?>