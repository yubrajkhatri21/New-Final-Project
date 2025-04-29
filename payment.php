<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Hand Buy and Sale</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background-color: green;
            padding: 20px 0;
            text-align: center;
            color: #ffffff;
        }

        .container h1 {
            color: #fff;
        }

        .main-contain {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: green;
            font-style: italic;
            font-weight: 200;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: green;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Payment page</h1>
    </div>
    <div class="main-contain">
        <h1>Payment Option</h1>
        <input type="radio" id="showForm1" name="showForm" value="form1">
        <label for="showForm1"> Cash on Delivery </label>
        <form id="form1" class="hidden" action="payment_action.php" method = "post">
            <div class="form-data">
                <label for="username">Full Name</label>
                <input type="text" name="oname" id="Oname">
            </div>
            <div class="form-data">
                <label for="PhoneNumber">Phone Number</label>
                <input type="text" name="ophone" id="Ophone">
            </div>
            <div class="form-data">
                <label for="email">E-mail</label>
                <input type="email" name="oemail" id="Oemail">
            </div>
            <div class="form-data">
                <label for="address">Location</label>
                <input type="text" name="oaddress" id="Oaddress">
            </div>
            <div class="form-button">
                <input type="submit" value="Submit" name="Submit">
            </div>
        </form>
<?php

$product_id = $_GET['product_id']; // Get the product ID
$price = $_GET['price']; // Get the product price
$user_id = $_GET['user_id']; // Get the user ID

// Display or use the data


// eSewa Secret Key
$secret = "8gBm/:&EnhH.1/q";

// Payment Data (Ensure Correct Total)
$amount = $price;  // Main amount
$tax_amount = "10";  // Tax amount
$total_amount = $amount + $tax_amount;  // Correct total amount
$transaction_uuid = uniqid();
$product_code = "EPAYTEST";

// Data Array
$data = [
    "total_amount" => $total_amount,
    "transaction_uuid" => $transaction_uuid,
    "product_code" => $product_code
];

// Generate Message String in "key=value,key=value" Format
$message = "";
foreach ($data as $key => $value) {
    $message .= "$key=$value,";
}
$message = rtrim($message, ","); // Remove trailing comma

// Generate HMAC-SHA256 Signature and Encode in Base64
$signature = base64_encode(hash_hmac('sha256', $message, $secret, true));

?>
<div class="form-data">
                <label for="username">Full Name</label>
                <input type="text" name="oname" id="Oname">
            </div>
            <div class="form-data">
                <label for="PhoneNumber">Phone Number</label>
                <input type="text" name="ophone" id="Ophone">
            </div>
            <div class="form-data">
                <label for="email">E-mail</label>
                <input type="email" name="oemail" id="Oemail">
            </div>
            <div class="form-data">
                <label for="address">Location</label>
                <input type="text" name="oaddress" id="Oaddress">
            </div>

         <input type="radio" id="showForm2" name="showForm" value="form2"> 
         <label for="showForm2"> E-sewa </label>
         <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value="<?php echo $tax_amount; ?>" required>
        <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_amount; ?>" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>" required>
        <input type="hidden" id="product_code" name="product_code" value="<?php echo $product_code; ?>" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="http://localhost/Mis/orderlist.php?pid=<?php echo $product_id; ?>&userid=<?php echo $user_id; ?>" required>
        <input type="hidden" id="failure_url" name="failure_url" value="http://localhost/FinalProject-ERROR%20MANAGE/" required>
        
        <!-- Corrected Signed Field Names -->
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        
        <!-- Corrected Dynamic Signature -->
        <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>" required>
        
        <input value="Submit" type="submit" name="Submit">
    </form>

    </div>

    <script>
        const showForm1Radio = document.getElementById('showForm1');
        const showForm2Radio = document.getElementById('showForm2');
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');

        showForm1Radio.addEventListener('click', () => {
            form1.classList.remove('hidden');
            form2.classList.add('hidden');
        });

        showForm2Radio.addEventListener('click', () => {
            form1.classList.add('hidden');
            form2.classList.remove('hidden');
        });
    </script>
    
  <script src="JS/payment.js?v=20"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>