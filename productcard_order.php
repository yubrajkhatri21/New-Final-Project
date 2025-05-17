<?php
include('php/connector.php');
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php');
}
$order_id = $_GET['orderid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@700&family=Lato:ital,wght@0,100;0,300;1,100&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
        }

        .card_img1 {
            background: linear-gradient(135deg, #e3f6f5 0%, #a8edea 100%);
            box-shadow: 0 4px 18px #43cea244;
            border-radius: 1rem;
            width: 220px;
            height: 220px;
            object-fit: cover;
            margin-right: 24px;
            border: 4px solid #43cea2;
        }

        .main-container-card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            width: 90%;
            max-width: 950px;
            padding: 2.5rem 2rem 2rem 2rem;
            margin: 32px auto 24px auto;
        }

        .inner-container-card {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 32px;
        }

        .card_sep {

            flex: 1 1 350px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px 24px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 1rem;
            box-shadow: 0 2px 8px #185a9d22;
        }

        .card_sep h3 {
            margin: 0 0 6px 0;
            color: #185a9d;
            font-size: 1.08rem;
        }

        .card_sep p {
            margin: 0;
            color: #333;
            font-size: 1rem;
            font-weight: 500;
        }

        .product_bio {
            grid-column: 1 / span 2;
            background: linear-gradient(90deg, #fed6e3 0%, #a8edea 100%);
            border-radius: 10px;
            font-size: 1.08rem;
            color: #185a9d;
            padding: 14px 10px;
            margin-top: 10px;
            max-height: 120px;
            overflow-y: auto;
            box-shadow: 0 2px 8px #43cea244;
        }

        .card_img2 {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 1rem;
            margin-left: 32px;
            background: #fff;
            border: 3px solid #ffb347;
            box-shadow: 0 2px 8px #ffb34744;
            align-self: flex-start;
        }

        .note {

            width: 90%;
            max-width: 700px;
            margin: 24px auto 0 auto;
            font-size: 1.1rem;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            color: #fff;
            border-radius: 12px;
            padding: 16px 24px;
            text-align: center;
            box-shadow: 0 2px 8px #43cea244;
        }

        .card_but {
            text-align: center;
            margin-top: 24px;
        }

        .card_but a {
            text-decoration: none;
            color: #fff;
            padding: 12px 32px;
            border-radius: 24px;
            font-size: 1.1rem;
            font-weight: 700;
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            margin: 0 10px;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #185a9d22;
            display: inline-block;
        }

        .card_but a:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            transform: scale(1.08);
            box-shadow: 0 4px 18px #ffb34744;
        }

        .master-maindiv {
            background: rgba(255, 255, 255, 0.18);
            display: none;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.5px);
            -webkit-backdrop-filter: blur(8.5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            height: 100vh;
            position: fixed;
            top: 0;
            width: 100vw;
            left: 0;
            z-index: 1000;
        }

        .main-container-qr {



            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.5px);
            -webkit-backdrop-filter: blur(8.5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            height: auto;
            text-align: center;
            padding: 32px 18px;
            color: #fff;
            box-shadow: 0 4px 18px #185a9d22;
        }

        .inner-container-qr h2 {
            margin-bottom: 18px;
            font-size: 1.5rem;
            color: #fff;
        }

        .img1-qr img {
            width: 120px;
            margin: 18px auto;
            border-radius: 1rem;
            background: #fff;
            border: 2px solid #43cea2;
            box-shadow: 0 2px 8px #43cea244;
        }

        .info-qr p {
            padding: 10px 0;
            font-size: 1.1rem;
            color: #fff;
        }

        .btn-qr {
            width: 100%;
            margin: 18px auto;
            padding: 10px 0;
        }

        .btn-qr2 {
            color: #185a9d;
            font-weight: bold;
            padding: 10px 40px;
            background: linear-gradient(90deg, #fff 0%, #ffcc33 100%);
            text-decoration: none;
            border-radius: 1rem;
            font-size: 1.1rem;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            display: inline-block;
            margin: 0 8px;
        }

        .btn-qr2:hover {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            transform: scale(1.08);
        }

        @media (max-width: 900px) {
            .main-container-card {
                padding: 1rem 0.5rem;
            }

            .inner-container-card {
                flex-direction: column;
                align-items: stretch;
                gap: 18px;
            }

            .card_img1,
            .card_img2 {
                margin: 0 auto 18px auto;
                display: block;
            }

            .card_sep {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 600px) {
            .main-container-card {
                padding: 0.5rem 0.2rem;
            }

            .note {
                font-size: 1rem;
                padding: 10px 8px;
            }

            .inner-container-qr {
                padding: 18px 4px;
            }
        }
    </style>
</head>

<body>
    <?php $dqry = "SELECT * FROM productdetails p JOIN ordertable od ON p.Product_id=od.Product_id JOIN userdetails u ON u.user_id=p.user_id WHERE od.order_id=$order_id";
    $result = mysqli_query($con, $dqry);
    if ($data = mysqli_fetch_assoc($result)) {



    ?>
        <div class="main-container-card">
            <h2>Product Card</h2>
            <div class="inner-container-card">
                <div><img class="card_img1" src="<?php echo $data['product_image'] ?>" alt=""></div>
                <div class="card_sep">
                    <div>
                        <h3>Order ID:</h3><?php echo $data['order_id'] ?></p>
                    </div>
                    <div>
                        <h3>Product ID:</h3><?php echo $data['Product_id'] ?></p>
                    </div>
                    <div>
                        <h3>Product Name:</h3><?php echo $data['product_name'] ?></p>
                    </div>
                    <div>
                        <h3>Category:</h3>
                        <p><?php echo $data['category_name'] ?></p>
                    </div>

                    <div>
                        <h3>Owner contact no.:</h3>
                        <p><?php echo $data['phone'] ?></p>
                    </div>
                    <div>
                        <h3>Owner email:</h3>
                        <p><?php echo $data['email'] ?></p>
                    </div>
                    <div>
                        <h3>Location:</h3>
                        <p><?php echo $data['address'] ?></p>
                    </div>

                    <div>
                        <h3>Used:</h3>
                        <p> <?php echo $data['product_age'] ?> </p>
                    </div>
                    <div class="product_bio" sytle="overflow:scroll;">
                        <?php echo $data['product_bio'] ?>

                    </div>
                </div>
                <img src="product_card.png" class="card_img2" alt="product_card.png">

            </div>


            <div class="card_but">
                <a href="orderlist.php" class="backbtn">Back</a>

                
            </div>
        <?php } ?>

        </div>
        <div class="note"> Note:If you want to know more details about this product,You can directly contact to the owner. </div>
        <div class="master-maindiv" id="maindiv-qr">
            <div class="main-container-qr " onclick="hidden();">
                <div class="inner-container-qr">
                    <h2>Cash on Delivery</h2>
                    <div class="img1-qr">
                        <img src="photo/cod.png" alt="cod.png">
                    </div>
                    <div class="info-qr">

                        <p>This system operates in a manner where, upon the owner's acceptance of the payment, a duplicate copy of the bill is automatically sent to the designated email address.</p>
                    </div>
                    <div class="btn-qr">
                        <a class="btn-qr2" id="done">Done</a>
                    </div>
                    <p><span style="font-weight: bold;">Note:</span>Please,click done button for your Orderlist</p>
                </div>
            </div>
        </div>
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
</body>

</html>