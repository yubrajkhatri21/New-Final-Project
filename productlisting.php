<?php
include('php/connector.php');
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productlisting.css">
    <link rel="stylesheet" href="css/userafterlogin.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Product listing</title>
    <style>
        body {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
            margin: 0;
        }

        .adminmain-container {
            max-width: 100%;
        }

        .dashdiv {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            margin: 32px auto 24px auto;
            padding: 2rem 1.5rem;
            max-width: 900px;
        }

        .productlist-title {
            color: #185a9d;
            font-size: 2rem;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 18px;
            text-align: center;
            letter-spacing: 1px;
        }

        .imagediv {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0 24px 0;
        }

        .imagediv img {
            width: 180px;
            max-width: 100%;
            border-radius: 18px;
            box-shadow: 0 4px 18px #185a9d22;
            border: 4px solid #ffb347;
            background: #fff;
        }

        .main-container-pl {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            align-items: flex-start;
            justify-content: space-between;
        }

        .innercontainer-pl1,
        .innercontainer-pl2 {
            flex: 1 1 320px;
            min-width: 260px;
        }

        .formdiv {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            width: 100%;
        }

        .productitem-pl {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }

        .productitem-pl label {
            color: #185a9d;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .productitem-pl input[type="text"],
        .productitem-pl input[type="number"],
        .productitem-pl select {
            font-size: 1rem;
            padding: 10px;
            border: 1.5px solid #43cea2;
            border-radius: 8px;
            background: #f7f8fa;
            transition: border 0.2s;
        }

        .productitem-pl input[type="text"]:focus,
        .productitem-pl input[type="number"]:focus,
        .productitem-pl select:focus {
            border: 1.5px solid #185a9d;
            outline: none;
        }

        .productitem-pl input[type="file"] {
            background: #fffbe7;
            border-radius: 8px;
            padding: 7px;
            font-size: 1rem;
            margin-top: 4px;
        }

        .productbio {
            background: linear-gradient(90deg, #e3f6f5 80%, #fed6e3 100%);
            border-radius: 10px;
            padding: 14px 10px;
            font-size: 1rem;
            color: #185a9d;
            margin-top: 12px;
            box-shadow: 0 2px 8px #43cea244;
        }

        .productbio h2 {
            margin: 0 0 8px 0;
            color: #ff5722;
            font-size: 1.1rem;
        }

        .productbio input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1.5px solid #43cea2;
            border-radius: 8px;
            background: #fff;
            font-size: 1rem;
        }

        .listbtn {
            text-align: center;
            margin-top: 24px;
        }

        .listbtn input[type="submit"] {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            border: none;
            padding: 12px 36px;
            border-radius: 24px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-right: 10px;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px #185a9d22;
        }

        .listbtn input[type="submit"]:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            transform: scale(1.05);
        }

        .listbtn a {
            text-decoration: none;
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            padding: 12px 32px;
            border-radius: 24px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px #ffb34744;
            display: inline-block;
        }

        .listbtn a:hover {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            transform: scale(1.05);
        }

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
            top: 70px;
            right: 18px;
            z-index: 2000;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ffb34744;
        }

        @media (max-width: 900px) {
            .dashdiv {
                margin: 16px 2vw;
                padding: 1rem 2vw;
            }

            .main-container-pl {
                flex-direction: column;
                gap: 12px;
            }

            .imagediv {
                margin-top: 12px;
            }
        }

        @media (max-width: 600px) {
            .dashdiv {
                margin: 8px 0;
                padding: 0.5rem 1vw;
            }

            .main-container-pl {
                flex-direction: column;
                gap: 8px;
            }

            .imagediv img {
                width: 100px;
            }
        }
    </style>
    <script type="text/javascript">
        function showMessage(message, className) {
            var messageElement = document.createElement('div');
            messageElement.className = className;
            messageElement.innerText = message;
            document.body.appendChild(messageElement);
            setTimeout(function () {
                messageElement.remove();
            }, 5000);
        }
    </script>
</head>

<body>
    <div class="adminmain-container" style="max-width:100%;">
        <div class="menudiv"><?php include("view/app/usermenu.php") ?></div>
    </div>
    <div class="dashdiv">
        <form action="php/qproductlisting.php" method="POST" enctype="multipart/form-data">
            <h2 class="productlist-title">Product Listing</h2>
            <div class="imagediv">
                <!-- <img src="productlist.png" alt="Product Listing" /> -->
            </div>
            <div class="main-container-pl">
                <div class="formdiv">
                    <div class="innercontainer-pl1">
                        <?php
                        $userqry = "SELECT * from userdetails where email='$email'";
                        $result = mysqli_query($con, $userqry);
                        $data1 = mysqli_fetch_assoc($result);
                        ?>
                        <input type="hidden" name="user" value="<?php echo $data1['user_id'] ?>">
                        <input type="hidden" name="status" value="pending">
                        <div class="productitem-pl">
                            <label for="">Product Name</label>
                            <input type="text" name="product_name" id="productname" placeholder="Enter Product Name">
                        </div>
                        <div class="productitem-pl">
                            <label for="">Select Category</label>
                            <select name="category_name">
                                <option selected>Select Category</option>
                                <option>Vehicle</option>
                                <option>Clothing</option>
                                <option>Electronics</option>
                                <option>Home Goods</option>
                                <option>Books</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="productitem-pl">
                            <label for="">Product Price</label>
                            <input type="text" required name="product_price" id="productname" placeholder="Enter Product Price">
                        </div>
                        <div class="productitem-pl">
                            <label for=""><ion-icon name="images-outline"></ion-icon></label>
                            <input type="file" required name="product_image" id="productimage">
                        </div>
                        <div class="productitem-pl">
                            <label for="">Product Age</label>
                            <input type="text" required name="product_age" id="productname" placeholder="ex:1 year used">
                        </div>
                    </div>
                    <div class="innercontainer-pl2">
                        <div class="productbio" style="padding:3%;">
                            <h2>Product bio</h2>
                            <input type="text" required placeholder="Product Description..." name="product_bio" id="productbio">
                        </div>
                        <div class="imagediv" style="margin-top:18px;">
                            <img src="productlist.png" alt="Product Listing" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="listbtn">
                <input type="submit" name="listsubmit" value="submit">
                <a name="cancel" href="./userafterlogin.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php if (isset($_SESSION['success'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo addslashes($_SESSION['success']); ?>', 'success-message');
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo addslashes($_SESSION['error']); ?>', 'error-message');
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
</body>

</html>