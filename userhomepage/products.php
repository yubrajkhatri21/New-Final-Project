<!-- filepath: c:\xampp\htdocs\myfinalproject\userhomepage\products.php -->
<?php
include('../php/connector.php');

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="../css/products.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
            min-height: 100vh;
        }

        .innernav-bg {
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            padding: 15px 20px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 18px #43cea244;
        }

        .inner-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .logo h3 {
            font-size: 26px;
            color: white;
            margin: 0;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .search input {
            width: 100%;
            max-width: 300px;
            padding: 10px 18px;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 15px;
            box-shadow: 0 2px 8px #43cea244;
            background: #fff;
            transition: box-shadow 0.2s;
        }

        .search input:focus {
            box-shadow: 0 4px 18px #ffb34744;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.08rem;
            transition: color 0.3s, border-bottom 0.3s;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
        }

        .nav-links a:hover {
            color: #185a9d;
            border-bottom: 2px solid #fff;
        }

        .auth-buttons a {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            padding: 10px 22px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: bold;
            margin-left: 8px;
            font-size: 1rem;
            box-shadow: 0 2px 8px #ffb34744;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            display: inline-block;
        }

        .auth-buttons a.btn1 {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
        }

        .auth-buttons a:hover {
            background: linear-gradient(90deg, #ffb347 0%, #43cea2 100%);
            color: #185a9d;
            transform: scale(1.07);
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
        }

        .hamburger-menu i {
            font-size: 26px;
            color: white;
        }

        .product-page-container {
            max-width: 1200px;
            margin: 40px auto 0 auto;
            padding: 0 16px 40px 16px;
        }

        .page-title {
            text-align: center;
            font-size: 2.2rem;
            color: #185a9d;
            margin-bottom: 32px;
            background: linear-gradient(90deg, #43cea2 0%, #ffb347 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 56px 44px;
            margin-top: 32px;
        }

        .product-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            box-shadow: 0 4px 18px #185a9d22;
            padding: 22px 18px 18px 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }

        .product-item:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px #ffb34755, 0 2px 8px #43cea244;
        }

        .product-image img {
            width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 2px 8px #43cea244;
            margin-bottom: 18px;
            background: #f7f8fa;
        }

        .product-details {
            text-align: center;
            width: 100%;
        }

        .product-title {
            font-size: 1.2rem;
            color: #185a9d;
            margin: 0 0 8px 0;
            font-weight: 600;
        }

        .product-description {
            color: #555;
            font-size: 1rem;
            margin-bottom: 10px;
            min-height: 40px;
        }

        .product-price {
            color: #ff5722;
            font-size: 1.15rem;
            font-weight: bold;
            margin-bottom: 16px;
        }

        .buy-now-btn {
            background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
            color: #fff;
            padding: 10px 28px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 2px 8px #185a9d22;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            display: inline-block;
        }

        .buy-now-btn:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
            color: #185a9d;
            transform: scale(1.08);
        }

        @media (max-width: 1000px) {
            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 20px;
            }

            .product-image img {
                width: 140px;
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            .inner-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background: #43cea2;
                padding: 10px;
                border-radius: 10px;
                width: 100%;
                margin-top: 10px;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger-menu {
                display: block;
            }

            .auth-buttons {
                margin-top: 10px;
            }

            .product-page-container {
                padding: 0 4vw 30px 4vw;
            }
        }

        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .product-item {
                padding: 14px 6px 12px 6px;
            }

            .product-image img {
                width: 100px;
                height: 70px;
            }

            .page-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="innernav-bg">
        <div class="inner-container">
            <!-- Logo Section -->
            <div class="logo">
                <h3>Second-Hand Marketplace</h3>
            </div>

            <!-- Search Bar -->
            <div class="search">
                <input type="search" placeholder="Search here..." id="live_search">
            </div>

            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="homepage.php">Home</a>
                <a href="products.php">Products</a>
                <a href="contact.php">Contact</a>
            </div>

            <!-- Auth Buttons -->
            <div class="auth-buttons">
                <a class="btn1" onclick="showPopup();">Sign up</a>
                <a href="../login.php" class="btn2">Login</a>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="hamburger-menu" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>

    <!-- Product Page Content -->
    <div class="product-page-container">
        <h1 class="page-title">Our Products</h1>
        <div class="product-grid">
            <?php
            $sql = "SELECT * FROM productdetails WHERE display_home=1 ORDER BY Product_id DESC";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="product-item">
                        <div class="product-image">
                            <img src="../<?php echo $data['product_image']; ?>" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title"><?php echo $data['product_name']; ?></h3>
                            <p class="product-description"><?php echo $data['product_bio']; ?></p>
                            <p class="product-price">Rs <?php echo $data['product_price']; ?></p>
                            <a href="../login.php" class="buy-now-btn">Buy Now</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>

</html>