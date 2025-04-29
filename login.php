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
    <style type="text/css">
        body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .maincontainer {
            display: flex;
            flex-direction: row;
            height: 100vh;
            overflow: hidden;
        }

        .img1 {
            flex: 1;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .img1 img {
            max-width: 100%;
            height: auto;
        }

        .img1-text {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .content h2 {
            margin-bottom: 20px;
        }

        .text2 {
            margin-bottom: 20px;
        }

        .epp {
            width: 100%;
            max-width: 400px;
        }

        .epp input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .forgotpass {
            margin-bottom: 20px;
            text-align: right;
        }

        .forgotpass a {
            color: #007BFF;
            text-decoration: none;
        }

        .forgotpass a:hover {
            text-decoration: underline;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .ltext {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
        }

        .success-message {
            background-color: green;
            color: #fff;
            padding: 20px;
            position: absolute;
            margin: auto;
            text-align: center;
            font-size: 24px;
            font-weight: bolder;
            border-radius: 10px;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .error-message {
            color: red;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bolder;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
            background-color: pink;
        }

        @media (max-width: 768px) {
            .maincontainer {
                flex-direction: column;
            }

            .img1 {
                order: 2;
                padding: 10px;
            }

            .content {
                order: 1;
                padding: 10px;
            }

            .epp {
                width: 90%;
            }

            .ltext {
                font-size: 10px;
            }
        }

        @media (max-width: 480px) {
            .img1-text h2 {
                font-size: 20px;
            }

            .img1-text p {
                font-size: 14px;
            }

            .content h2 {
                font-size: 24px;
            }

            .text2 {
                font-size: 14px;
            }

            .epp input {
                padding: 8px;
            }

            .forgotpass {
                font-size: 12px;
            }

            button[type="submit"] {
                padding: 8px;
                font-size: 16px;
            }

            .ltext {
                font-size: 8px;
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
                <a href="userhomepage/homepage.php" class="close-btn fas fa-times"></a>
                <h2>LOG IN</h2>
                <div class="text2">Do you have an account? <span class="login">Sign Up</span></div>
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