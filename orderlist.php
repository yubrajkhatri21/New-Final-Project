<?php
include('php/connector.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php');
}
$userid = $_SESSION['user_id'];



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
            font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
            margin: 0;
        }

        .adminmain-container {
            display: flex;
            max-width: 100%;
        }

        .dashdiv {
            flex: 1;
            margin-left: 65px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            margin: 32px 24px 24px 24px;
            padding: 2rem 1.5rem;
        }

        .table__header h1 {
            color: #185a9d;
            font-size: 2.2rem;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 18px;
        }

        .table__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .input-group input[type="search"] {
            padding: 8px 16px;
            border-radius: 20px;
            border: 1.5px solid #43cea2;
            font-size: 1rem;
            background: #f7f8fa;
            transition: border 0.2s;
        }

        .input-group input[type="search"]:focus {
            border: 1.5px solid #185a9d;
            outline: none;
        }

        .table__body table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 18px #185a9d22;
        }

        .table__body th,
        .table__body td {
            padding: 14px 10px;
            text-align: center;
            font-size: 1rem;
        }

        .table__body th {
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .table__body tr {
            transition: background 0.2s;
        }

        .table__body tr:hover {
            background: #e3f6f5;
        }

        .table__body td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #43cea2;
            box-shadow: 0 2px 8px #43cea244;
        }

        .status {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
            background: #ffb347;
            color: #fff;
            box-shadow: 0 2px 8px #ffb34744;
        }

        .status.delivered {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        }

        .status.pending {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        }

        .pbtn_1,
        .pbtn_2,
        .view {
            text-decoration: none;
            border: none;
            padding: 8px 16px;
            font-size: 20px;
            border-radius: 10px;
            color: #fff;
            margin: 5px;
            font-weight: bold;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #185a9d22;
            cursor: pointer;
        }

        .pbtn_1 {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        }

        .pbtn_2 {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        }

        .view {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
        }

        .pbtn_1:hover,
        .pbtn_2:hover,
        .view:hover {
            transform: scale(1.09);
            box-shadow: 0 8px 24px #ffb34755, 0 2px 8px #43cea244;
            filter: brightness(1.1);
        }

        .btndiv {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .message,
        .success-message,
        .error-message {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            padding: 16px 32px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            box-shadow: 0 2px 8px #43cea244;
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 2000;
            text-align: center;
            display: none;
        }

        .success-message {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        }

        .error-message {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        }

        .main-body-delete,
        .main-delete-container,
        .inner-delete-container {
            /* Keep your modal styles as is for now */
        }

        @media (max-width: 900px) {
            .dashdiv {
                margin: 16px 2vw;
                padding: 1rem 2vw;
            }

            .table__body th,
            .table__body td {
                padding: 8px 2px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 600px) {
            .dashdiv {
                margin: 8px 0;
                padding: 0.5rem 1vw;
            }

            .table__body th,
            .table__body td {
                padding: 4px 1px;
                font-size: 0.9rem;
            }

            .adminmain-container {
                flex-direction: column;
            }
        }

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
            /* max-width: 100%; */
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






        /* * delete css start from here */
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
    </style>
</head>

<body>
    <div class="adminmain-container" style="max-width:100%;">
        <div class="menudiv"><?php include("view/app/usermenu.php") ?></div>
        <div class="dashdiv">
            <h3 id="success-message" style="display:none" class="message">Order-listed Sucessfully</h3>
            <main class="table">
                <section class="table__header">

                    <h1>Order List</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search Data...">
                        <img src="images/search.png" alt="">
                    </div>

                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>S.N <span class="icon-arrow">&UpArrow;</span></th>
                                <th>Order ID <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Product ID <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Product Image <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Product Name <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Order_Date <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Payment Status <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Amount <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                                <th> More<span class="icon-arrow">&UpArrow;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM  ordertable od JOIN productdetails pd ON od.Product_id=pd.Product_id WHERE od.customer_id=$userid ";

                            $r = mysqli_query($con, $sql);
                            $sn = 1;
                            while ($data = mysqli_fetch_assoc($r)) {
                            ?>

                                <tr>
                                    <td> <?php echo $sn ?> </td>
                                    <td> <?php echo $data['order_id'] ?> </td>
                                    <td> <?php echo $data['Product_id'] ?> </td>
                                    <td> <img src="<?php echo $data['product_image'] ?>" alt=""></td>
                                    <td> <?php echo $data['product_name'] ?></td>
                                    <td> <?php echo $data['order_date'] ?> </td>
                                    <td>
                                        <p class="status delivered"><?php echo $data['payment_status'] ?></p>
                                    </td>

                                    <td> <strong> Rs<?php echo $data['product_price'] ?> </strong></td>



                                    <?php $order_id = $data['order_id'];
                                    $Product_id = $data['Product_id'];
                                    $confirmation_status = $data['payment_status'];

                                    // Show "Completed" for confirmed orders, otherwise show buttons
                                    $status_text = ($confirmation_status == 'Confirmed') ? 'Completed' : '<a href="#" onclick="show(' . $order_id . ',' . $Product_id . ')" class="pbtn_1"><ion-icon name="trash-outline"></ion-icon></a>';


                                    // ...
                                    echo '<td id="action" class="pbtn" style="height:100%;">';
                                    echo '<div class="btndiv">';
                                    echo $status_text;
                                    echo '</div>';
                                    echo '</td>';
                                    // ...
                                    ?>














                                <?php
                                $order_id = $data['order_id'];
                                ?>

                                <td>
                                    <a class="view" href="productcard_order.php?orderid= <?php echo $order_id ?>"><ion-icon name="eye-outline"></ion-icon></a>
                                </td>
                                </tr>
                                <?php $sn++;
                                } ?>

                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>




    <div class="main-body-delete" id="maindiv">
        <div class="main-delete-container">
            <div class="inner-delete-container">
                <h2>Do You Want Really to Delete Order?</h2>
                <i class="ri-emotion-sad-line"></i>
                <div class="button">
                    <a href="" id="cancel" onclick="hidden()" class="cancel">Cancel</a>
                    <a id="delete" class="delete">Delete</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        function hidden() {
            var maindiv2 = document.getElementById("maindiv");
            maindiv2.style.display = "none";
        }


        function show(x, y) {

            document.getElementById("maindiv").style.display = "block";
            document.getElementById("delete").href = "php/order_crude/qdeleteorder.php?id=" + x + "&product_id=" + y;




        }
    </script>







<!DOCTYPE html>
<html>

<head>
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
    <style type="text/css">
        .success-message {
            background-color: green;
            color: #fff;
            padding: 20px;
            position: absolute;
            margin: auto;
            top: 10px;
            right: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: bolder;
            border-radius: 10px;
        }

        .error-message {
            background-color: red;
            color: white;
            padding: 20px;
            margin-bottom: 150px;
            text-align: center;
            font-size: 24px;
            font-weight: bolder;
            position: absolute;
            border-radius: 10px;
            margin: auto;
            top: 50px;
            right: 20px;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['success'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo $_SESSION['success']; ?>', 'success-message');
            <?php unset($_SESSION['success']);
            ?>
        </script>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <script type="text/javascript">
            showMessage('<?php echo $_SESSION['error']; ?>', 'error-message');
            <?php unset($_SESSION['error']);
            ?>
        </script>
    <?php } ?>
</body>

</html>
















    <!-- script for message display -->

    <script>
        $(document).ready(function() {
            // Check if the product addition was successful
            <?php if ($success) : ?>
                // Display success message
                $("#success-message").show();

                // Hide the success message after 5 seconds
                setTimeout(function() {
                    $("#success-message").hide();
                }, 5000);
            <?php endif; ?>
        });
    </script>














</body>

</html>