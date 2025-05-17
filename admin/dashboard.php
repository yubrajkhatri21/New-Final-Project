<!-- filepath: c:\xampp\htdocs\myfinalproject\admin\dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            margin: 0; font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
        }
        .sidebar {
            width: 220px; background: #185a9d;
            color: #fff; position: fixed; top: 0; left: 0; height: 100vh;
            display: flex; flex-direction: column; align-items: center; padding-top: 40px;
        }
        .sidebar h2 { margin-bottom: 40px; }
        .sidebar a {
            color: #fff; text-decoration: none; margin: 18px 0; font-size: 1.1rem;
            padding: 10px 30px; border-radius: 8px; display: block; width: 100%; text-align: left;
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { background: #43cea2; color: #185a9d; }
        .main-content {
            margin-left: 240px; padding: 40px 24px;
        }
        .card {
            background: #fff; border-radius: 16px; box-shadow: 0 4px 18px #185a9d22;
            padding: 32px 24px; margin-bottom: 32px;
        }
        .card h3 { margin-top: 0; color: #185a9d; }
        @media (max-width: 800px) {
            .sidebar { width: 100vw; height: auto; flex-direction: row; padding: 10px 0; position: static; }
            .sidebar h2 { display: none; }
            .sidebar a { margin: 0 8px; padding: 10px 12px; font-size: 1rem; border-radius: 6px; width: auto; }
            .main-content { margin-left: 0; padding: 20px 4vw; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="products.php">Manage Products</a>
        <a href="users.php">Manage Users</a>
        <a href="orders.php">Manage Orders</a>
        <a href="logout.php" style="color:#ff5858;">Logout</a>
    </div>
    <div class="main-content">
        <div class="card">
            <h3>Welcome, Admin!</h3>
            <p>This is your dashboard. Use the sidebar to manage products, users, and orders.</p>
        </div>
        <!-- Example stats -->
        <div class="card">
            <h3>Quick Stats</h3>
            <ul>
                <li>Total Products: <?php /* echo product count */ ?></li>
                <li>Total Users: <?php /* echo user count */ ?></li>
                <li>Pending Orders: <?php /* echo order count */ ?></li>
            </ul>
        </div>
    </div>
</body>
</html>