<?php
session_start();
include '../connect.php'; // Correct path to connect.php

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM admin WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        .login-container {
            max-width: 350px;
            margin: 80px auto;
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 4px 18px #185a9d22;
            padding: 32px 24px;
        }
        h2 {
            text-align: center;
            color: #185a9d;
            margin-bottom: 24px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1.5px solid #43cea2;
            border-radius: 8px;
            font-size: 1rem;
            background: #f7f8fa;
            transition: border 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border: 1.5px solid #185a9d;
            outline: none;
        }
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 8px #185a9d22;
            transition: background 0.2s, transform 0.2s;
        }
        button[type="submit"]:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            transform: scale(1.04);
        }
        .error {
            color: #ff5858;
            text-align: center;
            margin-bottom: 16px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) { echo '<div class="error">'.$error.'</div>'; } ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>