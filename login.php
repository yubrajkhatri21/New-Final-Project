<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Devanagari:wght@400;600;700;900&family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/beb421fb67.js" crossorigin="anonymous"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
        }
        .maincontainer {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            background: transparent;
        }
        .img1 {
            flex: 1;
            background: rgba(255,255,255,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px 20px;
            border-radius: 30px 0 0 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
            min-width: 260px;
        }
        .img1 img {
            max-width: 80%;
            height: auto;
            margin-top: 20px;
            border-radius: 18px;
            box-shadow: 0 4px 18px #185a9d22;
        }
        .img1-text {
            text-align: center;
            margin-bottom: 20px;
        }
        .img1-text h2 {
            font-size: 2rem;
            color: #185a9d;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .img1-text p {
            color: #555;
            font-size: 1.1rem;
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background: rgba(255,255,255,0.85);
            border-radius: 0 30px 30px 0;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
            position: relative;
            min-width: 260px;
        }
        .close-btn {
            position: static;
            font-size: 1.3rem;
            color: #ff5858;
            text-decoration: none;
            margin-left: 12px;
            vertical-align: middle;
            transition: color 0.2s;
            display: inline-block;
        }
        .close-btn:hover {
            color: #185a9d;
        }
        .content h2 {
            margin-bottom: 20px;
            color: #185a9d;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .text2 {
            margin-bottom: 36px; /* Increased for more space */
            color: #555;
            font-size: 1rem;
        }
        .login {
            color: #43cea2;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }
        .login:hover {
            color: #ffb347;
            text-decoration: underline;
        }
        .epp {
            width: 100%;
            max-width: 350px;
            background: rgba(255,255,255,0.7);
            border-radius: 18px;
            box-shadow: 0 2px 8px #43cea244;
            padding: 24px 18px;
            margin-bottom: 18px;
        }
        .epp input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border: 1.5px solid #43cea2;
            border-radius: 8px;
            font-size: 1rem;
            background: #f7f8fa;
            transition: border 0.2s;
        }
        .epp input:focus {
            border: 1.5px solid #185a9d;
            outline: none;
        }
        .forgotpass {
            margin-bottom: 20px;
            text-align: right;
        }
        .forgotpass a {
            color: #43cea2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .forgotpass a:hover {
            color: #ffb347;
            text-decoration: underline;
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
        .ltext {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #888;
        }
        .success-message {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            padding: 18px 32px;
            position: fixed;
            top: 18px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2000;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 2px 8px #43cea244;
        }
        .error-message {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
            color: #fff;
            padding: 18px 32px;
            position: fixed;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2000;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ffb34744;
        }

        /* Tablet and below */
        @media (max-width: 900px) {
            .maincontainer {
                flex-direction: column;
                min-height: 100vh;
                padding: 0;
            }
            .img1, .content {
                border-radius: 30px 30px 0 0;
                padding: 24px 10px;
                min-width: unset;
                width: 100%;
                max-width: 500px;
                margin: 0 auto;
            }
            .img1 {
                order: 2;
            }
            .content {
                order: 1;
            }
            .epp {
                width: 95%;
                padding: 18px 8px;
            }
        }

        /* Mobile */
        @media (max-width: 600px) {
            .maincontainer {
                padding: 0;
            }
            .img1-text h2, .content h2 {
                font-size: 1.3rem;
            }
            .img1-text p, .text2, .ltext {
                font-size: 0.95rem;
            }
            .epp input, button[type="submit"] {
                font-size: 0.95rem;
                padding: 10px;
            }
            .img1 img {
                max-width: 100%;
                margin-top: 10px;
            }
            .img1, .content {
                padding: 14px 4px;
                max-width: 100vw;
            }
        }
    </style>
    <script type="text/javascript">
        function showMessage(message, className) {
            var messageElement = document.createElement('div');
            messageElement.className = className;
            messageElement.innerText = message;
            document.body.appendChild(messageElement);
            setTimeout(function() {
                messageElement.remove();
            }, 5000);
        }
    </script>
</head>

<body>
    <form method="POST" action="php/qlogin.php">
        <div class="maincontainer">
            <div class="img1">
                <div class="img1-text">
                    <h2>Hello, Welcome Back :)</h2>
                    <p>To keep connected with us, please login with your personal information by email address and password</p>
                </div>
                <img src="photo/login.png" alt="Login Image">
            </div>
            <div class="content">
                <!-- <a href="userhomepage/homepage.php" class="close-btn fas fa-times"></a> -->
                <h2>LOG IN</h2>
                <div class="text2">
                    Do you have an account? 
                    <span class="login">Sign Up</span>
                    <a href="userhomepage/homepage.php" class="close-btn fas fa-times" style="margin-left:18px;"></a>
                </div>
                <div class="epp">
                    <div>
                        <input required type="email" class="email" name="email" placeholder="Log In with Email">
                    </div>
                    <div>
                        <input required type="password" class="password" name="pass" placeholder="Choose a Password">
                    </div>
                    <div class="forgotpass">
                        <a href="forgotpass.php">Forgot Password?</a>
                    </div>
                    <button type="submit" name="submit">Log In</button>
                </div>
                <p class="ltext">By signing up you accept our privacy policy, Terms &<br> Licensing Agreement</p>
            </div>
        </div>
    </form>

    <?php if (isset($_SESSION['success'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo $_SESSION['success']; ?>', 'success-message');
            <?php unset($_SESSION['success']); ?>
        </script>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo $_SESSION['error']; ?>', 'error-message');
            <?php unset($_SESSION['error']); ?>
        </script>
    <?php } ?>
</body>
</html>