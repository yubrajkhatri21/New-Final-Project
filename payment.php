<?php
session_start();
$product_id = $_GET['product_id'] ?? '';
$price = $_GET['price'] ?? '';
$user_id = $_GET['user_id'] ?? '';

// eSewa Secret Key
$secret = "8gBm/:&EnhH.1/q";
$amount = is_numeric($price) ? (float)$price : 0.0;
$tax_amount = 10;
$total_amount = $amount + $tax_amount;
$transaction_uuid = uniqid();
$product_code = "EPAYTEST";
$data = [
    "total_amount" => $total_amount,
    "transaction_uuid" => $transaction_uuid,
    "product_code" => $product_code
];
$message = "";
foreach ($data as $key => $value) {
    $message .= "$key=$value,";
}
$message = rtrim($message, ",");
$signature = base64_encode(hash_hmac('sha256', $message, $secret, true));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Hand Buy and Sale - Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Barlow:wght@700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', 'Barlow', Arial, sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            padding: 32px 0 18px 0;
            text-align: center;
            color: #fff;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 18px #185a9d22;
        }

        .container h1 {
            font-size: 2.2rem;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        .main-contain {
            max-width: 480px;
            margin: 32px auto;
            background: #fff;
            padding: 32px 24px 24px 24px;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .main-contain h1 {
            color: #185a9d;
            font-size: 1.5rem;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .payment-options {
            display: flex;
            gap: 18px;
            justify-content: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .payment-radio {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #e3f6f5;
            padding: 10px 18px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            color: #185a9d;
            border: 2px solid transparent;
            transition: border 0.2s, background 0.2s;
        }

        .payment-radio.selected {
            border: 2px solid #43cea2;
            background: #c1f7ee;
        }

        .form-data {
            margin-bottom: 14px;
            text-align: left;
        }

        .form-data label {
            display: block;
            margin-bottom: 5px;
            color: #185a9d;
            font-weight: 500;
        }

        .form-data input[type="text"],
        .form-data input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1.5px solid #43cea2;
            border-radius: 7px;
            font-size: 1rem;
            background: #f7f8fa;
            transition: border 0.2s;
        }

        .form-data input[type="text"]:focus,
        .form-data input[type="email"]:focus {
            border: 1.5px solid #185a9d;
            outline: none;
        }

        .form-button {
            text-align: center;
            margin-top: 18px;
        }

        .form-button input[type="submit"],
        .main-contain input[type="submit"] {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            border: none;
            padding: 12px 36px;
            border-radius: 24px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px #185a9d22;
        }

        .form-button input[type="submit"]:hover,
        .main-contain input[type="submit"]:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            transform: scale(1.05);
        }

        .hidden {
            display: none;
        }

        @media (max-width: 600px) {
            .main-contain {
                padding: 18px 4vw;
            }

            .container {
                padding: 18px 0 10px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Payment Page</h1>
    </div>
    <div class="main-contain">
        <h1>Choose Payment Option</h1>
        <div class="payment-options">
            <label class="payment-radio selected" id="label-cod">
                <input type="radio" id="showForm1" name="showForm" value="form1" checked style="accent-color:#43cea2;">
                Cash on Delivery
            </label>
            <label class="payment-radio" id="label-esewa">
                <input type="radio" id="showForm2" name="showForm" value="form2" style="accent-color:#ffb347;">
                E-sewa
            </label>
        </div>
        <!-- Cash on Delivery Form -->
        <form id="form1" action="payment_action.php" method="post">
            <div class="form-data">
                <label for="Oname">Full Name</label>
                <input type="text" name="oname" id="Oname" required>
            </div>
            <div class="form-data">
                <label for="Ophone">Phone Number</label>
                <input type="text" name="ophone" id="Ophone" required>
            </div>
            <div class="form-data">
                <label for="Oemail">E-mail</label>
                <input type="email" name="oemail" id="Oemail" required>
            </div>
            <div class="form-data">
                <label for="Oaddress">Location</label>
                <input type="text" name="oaddress" id="Oaddress" required>
            </div>
            <div class="form-button">
                <input type="submit" value="Submit" name="Submit">
            </div>
        </form>
        <!-- E-sewa Form -->
        <form id="form2" class="hidden" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>" required>
            <input type="hidden" name="tax_amount" value="<?php echo $tax_amount; ?>" required>
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>" required>
            <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>" required>
            <input type="hidden" name="product_code" value="<?php echo $product_code; ?>" required>
            <input type="hidden" name="product_service_charge" value="0" required>
            <input type="hidden" name="product_delivery_charge" value="0" required>
            <input type="hidden" name="success_url" value="http://localhost/Mis/orderlist.php?pid=<?php echo $product_id; ?>&userid=<?php echo $user_id; ?>"
                required>
            <input type="hidden" name="failure_url" value="http://localhost/FinalProject-ERROR%20MANAGE/" required>
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
            <input type="hidden" name="signature" value="<?php echo $signature; ?>" required>
            <div class="form-button">
                <input value="Pay with E-sewa" type="submit" name="Submit">
            </div>
        </form>
    </div>
    <script>
        // Toggle forms and highlight selected payment option
        const showForm1Radio = document.getElementById('showForm1');
        const showForm2Radio = document.getElementById('showForm2');
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');
        const labelCod = document.getElementById('label-cod');
        const labelEsewa = document.getElementById('label-esewa');

        function updateForms() {
            if (showForm1Radio.checked) {
                form1.classList.remove('hidden');
                form2.classList.add('hidden');
                labelCod.classList.add('selected');
                labelEsewa.classList.remove('selected');
            } else {
                form1.classList.add('hidden');
                form2.classList.remove('hidden');
                labelCod.classList.remove('selected');
                labelEsewa.classList.add('selected');
            }
        }
        showForm1Radio.addEventListener('change', updateForms);
        showForm2Radio.addEventListener('change', updateForms);
        // Initialize on page load
        updateForms();
    </script>
</body>

</html>