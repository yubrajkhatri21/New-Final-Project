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
        body {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            font-family: 'Poppins', 'Roboto', Arial, sans-serif;
        }

        .message {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            width: 320px;
            text-align: center;
            padding: 12px 0;
            border-radius: 1rem;
            float: right;
            margin: 18px 90px 0 0;
            font-weight: 600;
            box-shadow: 0 4px 18px #185a9d22;
            letter-spacing: 1px;
        }

        .pinfo {
            padding: 10px;
            margin: 40px;
            text-align: center;
        }

        .inner-container-pdetails {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5%;
            width: 90vw;
            margin: 1% auto;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(7px);
            box-shadow: 0 8px 32px #43cea244;
            border-radius: 1.2rem;
            padding: 24px 0;
        }

        .ptitle {
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            color: #fff;
            border-radius: 1rem 1rem 0 0;
            box-shadow: 0 4px 18px #43cea244;
            padding: 10px 20px;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .pinfo1,
        .pinfo2,
        .pinfo3 {
            background: linear-gradient(135deg, #ffb347 0%, #43cea2 100%);
            backdrop-filter: blur(7px);
            box-shadow: 0 4px 18px #185a9d22;
            border-radius: 1rem;
            padding: 24px 10px;
            color: #fff;
            font-weight: 500;
        }

        .pinfo h2 {
            color: #185a9d;
            font-size: 1.4rem;
            margin-bottom: 8px;
        }

        .pinfo h3 {
            color: #fff;
            margin: 10px 0;
        }

        .pbutton a {
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            font-size: 18px;
            padding: 7px 18px;
            border-radius: 1rem;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px #43cea244;
        }

        .pbutton a:hover {
            background: linear-gradient(90deg, #ffb347 0%, #43cea2 100%);
            transform: scale(1.08);
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
            background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%);
            padding: 5px 10px;
            font-size: 26px;
            border-radius: 10px;
            color: white;
            margin: 5px;
            font-weight: bold;
            box-shadow: 0 2px 8px #ffb34744;
            transition: background 0.2s, transform 0.2s;
        }

        .pbtn_2 {
            text-decoration: none;
            border: none;
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            padding: 5px 10px;
            font-size: 26px;
            border-radius: 10px;
            color: white;
            margin: 5px;
            font-weight: bold;
            box-shadow: 0 2px 8px #43cea244;
            transition: background 0.2s, transform 0.2s;
        }

        .view {
            text-decoration: none;
            border: none;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            padding: 5px 10px;
            font-size: 30px;
            text-align: center;
            border-radius: 10px;
            color: white;
            margin: 5px;
            font-weight: bold;
            box-shadow: 0 2px 8px #43cea244;
            transition: background 0.2s, transform 0.2s;
        }

        .accept {
            text-decoration: none;
            border: none;
            background: linear-gradient(90deg, #ffb347 0%, #43cea2 100%);
            padding: 7px 14px;
            font-size: 1.1rem;
            border-radius: 10px;
            color: #fff;
            margin: 4px;
            font-weight: bold;
            box-shadow: 0 2px 8px #43cea244;
            cursor: pointer;
            display: inline-block;
            transition: background 0.2s, transform 0.2s;
        }

        .view:hover,
        .accept:hover,
        .pbtn_1:hover,
        .pbtn_2:hover {
            background: linear-gradient(90deg, #ffb347 0%, #43cea2 100%);
            transform: scale(1.08);
        }

        .status {
            padding: 6px 16px;
            border-radius: 1rem;
            font-weight: bold;
            font-size: 1rem;
            display: inline-block;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            color: #fff;
            box-shadow: 0 2px 8px #43cea244;
        }

        .status.delivered {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
        }

        .table {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px #185a9d22;
            padding: 24px 0;
            margin-top: 24px;
        }

        .table__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 32px 18px 32px;
            border-bottom: 2px solid #43cea2;
        }

        .table__header h1 {
            color: #185a9d;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .input-group input[type="search"] {
            padding: 8px 16px;
            border-radius: 20px;
            border: 1.5px solid #43cea2;
            font-size: 1rem;
            outline: none;
            transition: border 0.2s;
            margin-right: 8px;
        }

        .input-group input[type="search"]:focus {
            border: 1.5px solid #ffb347;
        }

        .input-group img {
            width: 24px;
            vertical-align: middle;
        }

        .table__body {
            padding: 0 32px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            background: transparent;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: center;
            font-size: 1rem;
        }

        th {
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        td {
            background: rgba(255, 255, 255, 0.85);
            color: #185a9d;
            border-bottom: 1px solid #eee;
        }

        td img {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px #43cea244;
        }

        @media (max-width: 900px) {
            .adminmain-container {
                flex-direction: column;
            }

            .dashdiv {
                margin-left: 0;
                padding: 18px 2vw 0 2vw;
            }

            .menudiv {
                position: static;
                width: 100vw;
                min-height: unset;
                border-radius: 0;
                box-shadow: none;
            }

            .table__header,
            .table__body {
                padding: 0 8px;
            }

            .inner-container-pdetails {
                grid-template-columns: 1fr;
                gap: 18px;
                padding: 10px 0;
            }
        }

        @media (max-width: 600px) {
            .table__header h1 {
                font-size: 1.1rem;
            }

            th,
            td {
                font-size: 0.95rem;
                padding: 6px 2px;
            }

            .message {
                width: 98vw;
                margin: 10px 0 0 0;
                font-size: 0.95rem;
            }
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