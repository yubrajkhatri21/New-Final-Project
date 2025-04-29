<?php include('php/connector.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/usermanage.css">
    <link rel="stylesheet" href="view/app/adminmenu.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@700&family=Lato:ital,wght@0,100;0,300;1,100&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="adminmain-container" style="max-width:100%;">
        <div class="menudiv"><?php include("view/app/adminmenu.php") ?></div>

        <div class="dashdiv">




            <?php
            if (!isset($_SESSION['email'])) {
                header('location:login.php');
            }
            $semail = $_SESSION['email'];
            ?>




            <div class="sellerupper-container">
                <div class="seller-title">
                    <h2>Product Details</h2>
                </div>
                <div class="selleraddbutton">
                    <a href="addproductmanage.php">+Add Product</a>
                </div>
            </div>

            <div class="sellermain-container" style="overflow:scroll;  ">
                <main class="table">

                    <section>
                        <table>
                            <thead>
                                <tr>
                                    <th> S.N</th>
                                    <th> Product_id</th>
                                    <th> User_id</th>
                                    <th>Product_name</th>

                                    <th>Category</th>
                                    <th>Product_price</th>
                                    <th>Product_image</th>

                                    <th>Product_age</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php $sql = "SELECT * FROM productdetails";
                                $result = mysqli_query($con, $sql);
                                $sn=1;
                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo "$sn" ?></td>
                                        <td><?php echo "$data[Product_id]" ?></td>
                                        <td><?php echo "$data[user_id]" ?></td>
                                        <td><?php echo "$data[product_name]" ?>l</td>
                                        <td><?php echo "$data[category_name]" ?></td>
                                        <td><?php echo "$data[product_price]" ?></td>
                                        <td><img src="<?php echo "$data[product_image]" ?>" alt=""></td>
                                        <td><?php echo "$data[product_age]" ?></td>



                                        <td class="actionbutton">
                                            <a class="bedit" href="productmanageedit.php?id=<?php echo "$data[Product_id]" ?>"><ion-icon name="create-outline"></ion-icon></a>
                                            <a class="bdelete" onclick="show(<?php echo $data['Product_id']; ?>);"><ion-icon name="trash-outline"></ion-icon></a>

                                        </td>
                                        </td>




                                    </tr>
                                    <?php $sn++; ?>
                                <?php } ?>


                            </tbody>
                        </table>
                    </section>

                </main>
            </div>



            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

            <div class="main-body-delete" id="maindiv">
                <div class="main-delete-container">
                    <div class="inner-delete-container">
                        <h2>Are You Want to Delete account?</h2>
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


                function show(x) {

                    document.getElementById("maindiv").style.display = "block";
                    document.getElementById("delete").href = "php/qdeleteproduct.php?id=" + x;





                }
            </script>
        </div>
    </div>





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
                }, 5000); // 5 seconds timeout
            }
        </script>
        <style type="text/css">
            .success-message {
                background-color: green;
                color: #fff;
                padding: 20px;
                position: fixed;
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
                position: fixed;
                top: 10px;
                right: 10px;
                text-align: center;
                font-size: 24px;
                font-weight: bolder;
                border-radius: 10px;
            }
        </style>
    </head>

    <body>
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





</body>

</html>