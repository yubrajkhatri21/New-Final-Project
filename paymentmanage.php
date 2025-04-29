<?php
include('php/connector.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orderlist</title>
    <link rel="stylesheet" href="css/orderlist.css">
    <link rel="stylesheet" href="view/app/usermenu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .message {
            background-color: green;
            color: white;
            width: 20%;
            text-align: center;
            padding: 10px;
            border-radius: .8rem;
            float: right;
            margin: 10px 90px;
        }

        .pinfo {
            padding: 10px;
            margin: 40px;
            text-align: center;
        }

        .inner-container-pdetails {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15%;
            width: 90vw;
            margin: auto;
            background-color: #fff5;
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;
            margin: 1% auto;
        }

        .ptitle {
            background-color: #fff5;
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            padding: 5px 10px;
        }

        .pinfo1 {
            background-color: rgba(125, 17, 125, 0.649);
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;
            padding: 20px 2px;
        }

        .pinfo2 {
            background-color: rgba(17, 125, 35, 0.649);
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;
            padding: 20px 2px;
        }

        .pinfo3 {
            background-color: rgba(109, 125, 17, 0.649);
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;
            padding: 20px 2px;
        }

        .pinfo h2 {
            color: rgb(34, 34, 31)
        }

        .pinfo h3 {
            color: rgba(255, 255, 255, 0.792);
            margin: 10px;
        }

        .pbutton a {
            background-color: rgba(0, 0, 255, 0.517);
            font-size: 18px;
            padding: 5px 10px;
            border-radius: .8rem;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.825);
            cursor: pointer;
            margin-top: 10px;
        }

        .pbutton a:hover {
            background-color: rgba(0, 0, 255, 0.412);
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            transition: .25s;
            transform: scale(0.5);
        }

        .adminmain-container {
            display: flex;
            max-width: 100%;
        }

        .dashdiv {
            flex: 1;
            margin-left: 65px;
        }

        .menudiv {
            position: fixed;
            z-index: 999;
            width: 200px;
        }

        .btndiv {
            display: flex;
            margin-top: auto;
            justify-content: center;
            align-items: center;
        }

        .pbtn_1 {
            text-decoration: none;
            border: none;
            background-color: red;
            padding: 5px 10px;
            font-size: 26px;
            border-radius: 10px;
            color: white;
            margin: 5px;
        }

        .pbtn_2 {
            text-decoration: none;
            border: none;
            background-color: blue;
            padding: 5px 10px;
            font-size: 26px;
            border-radius: 10px;
            color: white;
            margin: 5px;
        }

        .view {
            text-decoration: none;
            border: none;
            background-color: lightgreen;
            padding: 5px 10px;
            font-size: 30px;
            text-align: center;
            border-radius: 10px;
            color: white;
            margin: 5px;
        }

        .view:hover,
        .pbtn_1:hover,
        .pbtn_2:hover {
            transform: scale(1.1);
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            cursor: pointer;
        }

        * {
            margin: 0px;
            padding: 0px;
            font-family: 'Barlow', sans-serif;
            font-family: 'Lato', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Ubuntu', sans-serif;
        }

        .main-body-delete {
            background: rgba(255, 255, 255, 0.16);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.4px);
            -webkit-backdrop-filter: blur(8.4px);
            height: 100vh;
            display: none;
            position: fixed;
            top: 0;
            width: 100vw;
        }

        .main-delete-container {
            display: flex;
            height: 100vh;
            display: flex;
            position: fixed;
            top: 0;
            width: 100vw;
        }

        .inner-delete-container {
            background-color: rgba(128, 128, 128, 0.208);
            text-align: center;
            width: 25%;
            border-radius: 16px;
            height: 15%;
            margin: auto;
            padding: 25px;
        }

        .inner-delete-container i {
            color: red;
            font-size: 44px;
        }

        .button {
            margin-top: 25px;
        }

        .button a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 15px;
        }

        .cancel {
            background-color: rgba(43, 13, 240, 0.773);
            color: white;
        }

        .cancel:hover {
            background-color: rgba(43, 13, 240, 0.35);
        }

        .delete:hover {
            background-color: rgba(255, 0, 0, 0.38);
        }

        .delete {
            background-color: red;
            color: white;
        }

        .confirm {
            background-color: green;
            color: white;
        }

        .confirm:hover {
            background-color: seagreen;
        }
    </style>
</head>

<body>
    <div class="adminmain-container" style="max-width:100%;">
        <div class="menudiv"><?php include("view/app/adminmenu.php") ?></div>
        <div class="dashdiv">
            <h3 id="success-message" style="display:none" class="message">Payment Accepted Successfully</h3>
            <main class="table">
                <section class="table__header">
                    <h1>Order Details</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search Data...">
                        <img src="images/search.png" alt="">
                    </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <?php $sn = 1; ?>
                            <tr>
                                <th>S.N</th>
                                <th>Payment ID</th>
                                <th>Order ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM ordertable od 
                                    JOIN productdetails pd ON od.Product_id = pd.Product_id 
                                    JOIN paymenttable pt ON pd.Product_id = pt.Product_id";

                            $r = mysqli_query($con, $sql);
                            while ($data = mysqli_fetch_assoc($r)) {
                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $data['payment_id']; ?></td>
                                    <td><?php echo $data['order_id']; ?></td>
                                    <td><img src="<?php echo $data['product_image']; ?>" alt=""></td>
                                    <td><?php echo $data['product_name']; ?></td>
                                    <td><?php echo $data['order_date']; ?></td>
                                    <td>
                                        <p class="status delivered"><?php echo $data['payment_status']; ?></p>
                                    </td>
                                    <td><strong>Rs <?php echo $data['product_price']; ?></strong></td>
                                    <td>
                                        <a class="view" href="productcard_order.php?orderid=<?php echo $data['order_id']; ?>"><ion-icon name="eye-outline"></ion-icon></a>
                                        <a class="accept" onclick="showAccept(<?php echo $data['payment_id']; ?>);">Accept</a>
                                    </td>
                                </tr>
                                <?php $sn++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>

    <!-- Accept Payment Confirmation Modal -->
    <div class="main-body-delete" id="acceptPaymentModal">
        <div class="main-delete-container">
            <div class="inner-delete-container">
                <h2>Are you sure you want to accept this payment?</h2>
                <ion-icon name="checkmark-circle-outline" style="color: green; font-size: 44px;"></ion-icon>
                <div class="button">
                    <a href="#" id="cancelAccept" onclick="hideAcceptModal()" class="cancel">Cancel</a>
                    <a id="confirmAccept" class="confirm">Accept</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the Accept Payment Modal
        function showAccept(paymentId) {
            document.getElementById("acceptPaymentModal").style.display = "block";
            document.getElementById("confirmAccept").href = "php/payment_crude/acceptpay.php?id=" + paymentId;
        }

        // Hide the Accept Payment Modal
        function hideAcceptModal() {
            document.getElementById("acceptPaymentModal").style.display = "none";
        }
    </script>
</body>

</html>

<?php
include('../connector.php');

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    // Update the payment status to "Accepted"
    $sql = "UPDATE paymenttable SET payment_status = 'Accepted' WHERE payment_id = $payment_id";
    if (mysqli_query($con, $sql)) {
        header('Location: ../../paymentmanage.php?success=1');
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    header('Location: ../../paymentmanage.php');
}
?>