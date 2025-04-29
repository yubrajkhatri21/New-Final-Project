<!-- filepath: c:\xampp\htdocs\myfinalproject\admin\dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h1>
        <nav>
            <a href="manage_products.php">Manage Products</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>