<?php
include('php/connector.php');
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php');
    exit;
}

// Check if productid is set and is numeric
if (!isset($_GET['productid']) || !is_numeric($_GET['productid'])) {
    echo "<h2 style='color:red;text-align:center;margin-top:40px;'>Invalid product ID.</h2>";
    exit;
}
$productid = (int)$_GET['productid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@700&family=Lato:wght@300;400;700&family=Roboto:wght@400;700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            animation: bgmove 12s ease-in-out infinite alternate;
        }

        @keyframes bgmove {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .main-container-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            width: 90%;
            max-width: 950px;
            margin: 32px auto 24px auto;
            padding: 2.5rem 2rem 2rem 2rem;
            position: relative;
            transition: box-shadow 0.3s;
        }

        .main-container-card:hover {
            box-shadow: 0 12px 40px 0 rgba(67, 206, 162, 0.25), 0 2px 8px #ffb34755;
        }

        .main-container-card h2 {
            text-align: center;
            border-bottom: 3px solid #ffb347;
            color: #185a9d;
            font-size: 2.2rem;
            margin-bottom: 24px;
            padding-bottom: 10px;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .inner-container-card {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            align-items: flex-start;
            justify-content: space-between;
        }

        .card_img1 {
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            border-radius: 1rem;
            box-shadow: 0 4px 18px rgba(67, 206, 162, 0.18);
            width: 320px;
            height: 320px;
            object-fit: cover;
            margin-right: 24px;
            border: 6px solid #ffb347;
            transition: border-color 0.3s;
        }

        .card_img1:hover {
            border-color: #43cea2;
        }

        .card_sep {
            flex: 1 1 320px;
            min-width: 260px;
            background: linear-gradient(135deg, #f7f8fa 80%, #a8edea 100%);
            border-radius: 1rem;
            padding: 18px 24px;
            box-shadow: 0 2px 8px rgba(24, 90, 157, 0.09);
        }

        .card_sep h3 {
            color: #ff5722;
            margin: 10px 0 2px 0;
            font-size: 1.1rem;
            display: inline-block;
            letter-spacing: 0.5px;
        }

        .card_sep p,
        .card_sep {
            color: #333;
            font-size: 1rem;
            margin: 0 0 8px 0;
        }

        .product_bio {
            background: linear-gradient(90deg, #e3f6f5 80%, #fed6e3 100%);
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            color: #185a9d;
            margin-top: 12px;
            max-height: 120px;
            overflow-y: auto;
            box-shadow: 0 2px 8px #43cea244;
        }

        .card_img2 {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-left: 18px;
            border-radius: 1rem;
            background: #fff8e1;
            box-shadow: 0 2px 8px #ffb34744;
            border: 2px solid #ffb347;
        }

        .card_but {
            text-align: center;
            margin-top: 24px;
        }

        .card_but a,
        .card_but .button {
            text-decoration: none;
            color: #fff;
            padding: 12px 28px;
            border-radius: 2rem;
            font-size: 1rem;
            font-weight: 600;
            margin: 0 8px 8px 0;
            display: inline-block;
            transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #185a9d22;
            border: none;
            outline: none;
            position: relative;
            overflow: hidden;
        }

        .backbtn {
            background: linear-gradient(90deg, #888 60%, #43cea2 100%);
        }

        .buybtn {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        }

        .button {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
        }

        .card_but a:hover,
        .card_but .button:hover {
            transform: scale(1.09);
            box-shadow: 0 8px 24px #ffb34755, 0 2px 8px #43cea244;
            filter: brightness(1.1);
        }

        .note {
            width: 90%;
            max-width: 700px;
            margin: 24px auto 0 auto;
            font-size: 1.1rem;
            background: linear-gradient(90deg, #fffbe7 80%, #ffb347 100%);
            color: #ff5722;
            border-radius: 1rem;
            padding: 18px 24px;
            text-align: center;
            box-shadow: 0 2px 8px #ffb34733;
            border: 2px solid #ffb347;
        }

        /* QR Modal */
        .master-maindiv {
            background: rgba(255, 255, 255, 0.85);
            display: none;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.5px);
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1000;
        }

        .main-container-qr {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .inner-container-qr {
            background: linear-gradient(135deg, #43cea2 0%, #ffb347 100%);
            border-radius: 1.2rem;
            width: 90%;
            max-width: 420px;
            padding: 32px 18px;
            text-align: center;
            box-shadow: 0 4px 30px #43cea244;
        }

        .img1-qr img {
            width: 60%;
            margin: 18px auto;
            display: block;
        }

        .info-qr p {
            padding: 10px 0;
            font-size: 1.1rem;
            color: #185a9d;
        }

        .btn-qr2,
        .btn-qr1 {
            color: #fff;
            font-weight: bold;
            padding: 10px 40px;
            background: #185a9d;
            text-decoration: none;
            border-radius: 1rem;
            margin: 10px 8px 0 8px;
            display: inline-block;
            transition: background 0.3s, transform 0.2s;
            border: none;
        }

        .btn-qr1 {
            background: #888;
        }

        .btn-qr2:hover,
        .btn-qr1:hover {
            background: #ffb347;
            color: #185a9d;
            transform: scale(1.07);
        }

        @media (max-width: 900px) {
            .main-container-card,
            .note {
                width: 98%;
            }

            .inner-container-card {
                flex-direction: column;
                align-items: stretch;
            }

            .card_img1 {
                margin: 0 auto 18px auto;
            }

            .card_img2 {
                margin: 18px auto 0 auto;
            }
        }

        @media (max-width: 600px) {
            .main-container-card {
                padding: 1rem 0.5rem;
            }

            .card_sep {
                padding: 12px 6px;
            }

            .inner-container-qr {
                padding: 18px 4px;
            }
        }

        /* Success/Error Message */
        .success-message {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            padding: 18px 32px;
            position: fixed;
            top: 18px;
            right: 18px;
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
            top: 18px;
            right: 18px;
            z-index: 2000;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ffb34744;
        }
    </style>
</head>

<body>
    <?php
    $dqry = "SELECT * FROM userdetails u JOIN productdetails p ON u.user_id=p.user_id WHERE Product_id=$productid";
    $result = mysqli_query($con, $dqry);
    if ($data = mysqli_fetch_assoc($result)) {
    ?>
        <div class="main-container-card">
            <h2>Product Card</h2>
            <div class="inner-container-card">
                <img class="card_img1" src="<?php echo htmlspecialchars($data['product_image']); ?>" alt="Product Image">
                <div class="card_sep">
                    <h3>Product ID:</h3>
                    <p><?php echo $data['Product_id'] ?></p>
                    <h3>Product Name:</h3>
                    <p><?php echo htmlspecialchars($data['product_name']) ?></p>
                    <h3>Category:</h3>
                    <p><?php echo htmlspecialchars($data['category_name']) ?></p>
                    <h3>Owner contact no.:</h3>
                    <p><?php echo htmlspecialchars($data['phone']) ?></p>
                    <h3>Owner email:</h3>
                    <p><?php echo htmlspecialchars($data['email']) ?></p>
                    <h3>Location:</h3>
                    <p><?php echo htmlspecialchars($data['address']) ?></p>
                    <h3>Price Of Product:</h3>
                    <p>Rs <?php echo htmlspecialchars($data['product_price']) ?></p>
                    <h3>Used:</h3>
                    <p><?php echo htmlspecialchars($data['used'] ?? '') ?></p>
                    <div class="product_bio"><?php echo htmlspecialchars($data['product_bio']) ?></div>
                </div>
                <img src="product_card.png" class="card_img2" alt="product_card.png">
            </div>

            <div class="card_but">
                <a href="userafterlogin.php" class="backbtn"><i class="ri-arrow-left-line"></i> Back</a>
                <a href="payment.php?product_id=<?php echo $data['Product_id']; ?>&price=<?php echo $data['product_price']; ?>&user_id=<?php echo $data['user_id']; ?>" class="buybtn" onclick="show(<?php echo $data['Product_id']; ?>, <?php echo $data['user_id']; ?>)"><i class="ri-shopping-cart-2-line"></i> Buy Now</a>
                <a class="button" href="sendmessage.php?productid=<?php echo $productid ?>"><i class="ri-message-2-line"></i> Send Message</a>
            </div>
        </div>
        <div class="note">
            <b>Note:</b> If you want to know more details about this product, you can directly contact the owner.
        </div>
        <div class="master-maindiv" id="maindiv-qr">
            <div class="main-container-qr">
                <div class="inner-container-qr">
                    <h2>Cash on Delivery</h2>
                    <div class="img1-qr">
                        <img src="photo/cod.png" alt="cod.png">
                    </div>
                    <div class="info-qr">
                        <p>This system operates in a manner where, upon the owner's acceptance of the payment, a duplicate copy of the bill is automatically sent to the designated email address.</p>
                    </div>
                    <div>
                        <a class="btn-qr2" id="done">Done</a>
                        <a class="btn-qr1" href="#" id="Back" onclick="hidden();return false;">Cancel</a>
                    </div>
                    <p style="margin-top:18px;"><span style="font-weight: bold;">Note:</span> Please, click done button for your Orderlist</p>
                </div>
            </div>
        </div>
    <?php } ?>
    <script>
        function show(x, y) {
            var maindivqr = document.getElementById('maindiv-qr');
            maindivqr.style.display = "block";
            document.getElementById('done').href = "php/qorderlist.php?pid=" + x + "&userid=" + y;
        }

        function hidden() {
            var maindivqr2 = document.getElementById('maindiv-qr');
            maindivqr2.style.display = "none";
        }
    </script>
    <?php if (isset($_SESSION['success'])) { ?>
        <script>
            (function() {
                var msg = document.createElement('div');
                msg.className = 'success-message';
                msg.innerText = '<?php echo addslashes($_SESSION['success']); ?>';
                document.body.appendChild(msg);
                setTimeout(function() {
                    msg.remove();
                }, 5000);
            })();
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <script>
            (function() {
                var msg = document.createElement('div');
                msg.className = 'error-message';
                msg.innerText = '<?php echo addslashes($_SESSION['error']); ?>';
                document.body.appendChild(msg);
                setTimeout(function() {
                    msg.remove();
                }, 5000);
            })();
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
</body>

</html>