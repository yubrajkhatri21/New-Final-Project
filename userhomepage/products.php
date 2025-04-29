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
            background: #f7f7f7;
            color: #333;
        }

        .innernav-bg {
            background: linear-gradient(90deg, #007BFF, #FF5722);
            padding: 15px 20px;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .inner-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .logo h3 {
            font-size: 24px;
            color: white;
            margin: 0;
        }

        .search input {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #FFD700;
        }

        .auth-buttons a {
            background-color: #FF5722;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .auth-buttons a:hover {
            background-color: #E64A19;
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
        }

        .hamburger-menu i {
            font-size: 24px;
            color: white;
        }

        @media (max-width: 768px) {
            .inner-container {
                flex-direction: column;
                align-items: center;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background: #007BFF;
                padding: 10px;
                border-radius: 10px;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger-menu {
                display: block;
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
                <a href="#contact">Contact</a>
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