<?php include('php/connector.php') ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <style>
    *{
    margin:0px;
    padding:0px;
    
 font-family: 'Barlow', sans-serif;
font-family: 'Lato', sans-serif;
font-family: 'Roboto', sans-serif;
font-family: 'Ubuntu', sans-serif;

}
body {
    background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
    min-height: 100vh;
    font-family: 'Roboto', 'Lato', 'Barlow', 'Ubuntu', sans-serif;
    margin: 0;
}
.createbox {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 2vw;
}
.createmain-container {
    background: rgba(255, 255, 255, 0.22);
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    backdrop-filter: blur(7.2px);
    border: 1px solid rgba(255,255,255,0.16);
    width: 100%;
    max-width: 650px;
    padding: 32px 18px;
}
.createmain-container-inner h3 {
    text-align: center;
    background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
    color: #fff;
    border-radius: 15px;
    padding: 10px 0;
    margin: 0 0 24px 0;
    font-size: 1.5rem;
    letter-spacing: 1px;
}
.createmain-container form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}
.formdiv {
    background: rgba(255,255,255,0.37);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0,0,0,0.07);
    padding: 14px 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}
.sellicon {
    font-size: 22px;
    color: #185a9d;
    min-width: 28px;
    text-align: center;
}
.createmain-container form input[type="text"],
.createmain-container form input[type="number"],
.createmain-container form input[type="email"] {
    font-size: 1rem;
    padding: 7px 10px;
    border: none;
    border-radius: 10px;
    background: #e3f6f5;
    width: 100%;
    margin-left: 0;
    transition: box-shadow 0.2s;
}
.createmain-container form input[type="text"]:focus,
.createmain-container form input[type="number"]:focus,
.createmain-container form input[type="email"]:focus {
    box-shadow: 0 2px 8px #43cea244;
    outline: none;
}
.createmain-container form input[type="file"] {
    background: #fffbe7;
    border-radius: 10px;
    padding: 5px;
    font-size: 1rem;
    width: 70%;
}
.createmain-container form img {
    border-radius: 10px;
    margin-left: 10px;
    border: 2px solid #43cea2;
    box-shadow: 0 2px 8px #43cea244;
    max-width: 60px;
    max-height: 60px;
    object-fit: cover;
}
.createmain-container form input[type="radio"] {
    accent-color: #43cea2;
    margin-right: 4px;
}
.createmain-container form label[for="mgender"],
.createmain-container form label[for="fgender"],
.createmain-container form label[for="ogender"] {
    color: #185a9d;
    font-weight: 500;
    margin-right: 10px;
    margin-left: 2px;
}
.sellercreatebtn {
    grid-column: 1 / span 2;
    text-align: center;
    margin-top: 10px;
}
.sellercreatebtn input[type="submit"] {
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
    color: #fff;
    padding: 8px 24px;
    border-radius: 18px;
    border: none;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    margin-right: 10px;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 2px 8px #185a9d22;
}
.sellercreatebtn input[type="submit"]:hover {
    background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
    color: #185a9d;
    transform: scale(1.05);
}
.sellercreatebtn a {
    text-decoration: none;
    background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
    color: #185a9d;
    padding: 8px 24px;
    border-radius: 18px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 2px 8px #ffb34744;
}
.sellercreatebtn a:hover {
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
    color: #fff;
    transform: scale(1.05);
}
@media (max-width: 900px) {
    .createmain-container {
        max-width: 98vw;
        padding: 18px 2vw;
    }
    .createmain-container form {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .formdiv {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }
    .sellercreatebtn {
        grid-column: 1;
    }
}
@media (max-width: 600px) {
    .createmain-container {
        padding: 8px 2vw;
    }
    .createmain-container-inner h3 {
        font-size: 1.1rem;
        padding: 7px 0;
    }
    .createmain-container form img {
        max-width: 40px;
        max-height: 40px;
    }
}
 </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@700&family=Lato:ital,wght@0,100;0,300;1,100&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body>


    <?php
    $userid = $_GET['id'];
    $sql = "SELECT * FROM userdetails where user_id='$userid'";
    $result = mysqli_query($con, $sql);
    while ($data = mysqli_fetch_assoc($result)) {
    ?>

        <div class="createbox">
            <div class="createmain-container">
                <div class="createmain-container-inner">
                    <h3>Fill User Details</h3>
                    <form method="POST" action="php/qprofileedit.php" enctype="multipart/form-data">
                        <div class="formdiv">
                            <label class="sellicon"><ion-icon name="information-circle-outline"></ion-icon></label>
                            <input type="number" value="<?php echo $data['user_id'] ?>" id="sid" readonly name="uid" Placeholder="Enter user id ">
                        </div>

                        <div class="formdiv">
                            <label class="sellicon"><ion-icon name="person-outline"></ion-icon></label>
                            <input type="text" id="sname" value="<?php echo $data['name'] ?>" required name="uname" Placeholder="Enter user name">
                        </div>

                        <div class="formdiv">
                            <label class="sellicon"><ion-icon name="mail-outline"></ion-icon></label>
                            <input type="email" id="uemail" value="<?php echo $data['email'] ?>" required name="uemail" Placeholder="Enter email">
                        </div>
                        <div class="formdiv">
                            <label class="sellicon"><ion-icon name="location-outline"></ion-icon></label>
                            <input type="text" id="ulocation" value="<?php echo $data['address'] ?>" required name="ulocation" Placeholder="Enter address">
                        </div>
                        <div class="formdiv">
                            <label class="sellicon"><ion-icon name="call-outline"></ion-icon></label>
                            <input type="text" id="phone" value="<?php echo $data['phone'] ?>" name="uphone" required Placeholder="Enter phone number">
                        </div>
                       
                        <div class="formdiv">

                            <input required type="radio" id="mgender" value="male" name="ugender">
                            <label for="mgender">Male</label>
                            <input required type="radio" id="fgender" value="female" name="ugender">
                            <label for="fgender">Female</label>
                            <input required type="radio" id="ogender" value="others" name="ugender">
                            <label for="ogender">Others</label>
                        </div>

                        
                        <div class="formdiv">
                            <label required class="sellicon"><ion-icon name="images-outline"></ion-icon></label>
                            <input type="file" required value="<?php echo $data['image']?>" id="image" name="uimage">

                            <img style="width:20%;" src="<?= $data['image'] ?>" alt="">

                        </div>
                        <div></div>
                        <div></div>
                        <div class="sellercreatebtn">
                            <input type="submit" name="submit" value="Save">
                            <a href="profile.php">Exit</a>
                        </div>


                    </form>









                </div>


            <?php } ?>





            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            </div>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
</body>

</html>