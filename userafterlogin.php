<?php
include('php/connector.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Second-Hand Marketplace</title>
    <link rel="stylesheet" href="css/homepageafterlogin.css">
    <link rel="stylesheet" href="css/userafterlogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@700&family=Lato:wght@300;400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        /* General Reset */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', 'Roboto', sans-serif;
            background: #f7f8fa;
        }
        .page-content {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }
        .footer {
            flex-shrink: 0;
        }

        /* Main Container */
        .supermain-container {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            max-width: 1200px;
            margin: 0 auto;
            padding: 18px 10px 0 10px;
            gap: 24px;
            min-height: 0;
        }

        /* Navigation Bar */
        .innernav-bg {
            background: linear-gradient(90deg, #007BFF, #FF5722);
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.07);
            border-radius: 0 0 16px 16px;
        }
        .inner-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 12px 0;
            gap: 18px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-img {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }
        .search {
            flex: 1 1 250px;
            margin: 0 18px;
        }
        .search input {
            width: 100%;
            max-width: 320px;
            padding: 9px 16px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        .nav-links {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;         /* Allow links to wrap on small screens */
            justify-content: flex-end;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 20px;
            transition: background 0.3s, color 0.3s;
        }
        .nav-links a:hover, .logout-btn:hover {
            background: #fff2;
            color: #FFD700;
        }
        .logout-btn {
            background: #ff5722;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
            border: none;
            margin-left: 8px;
            display: inline-block;
        }
        .logout-btn:hover {
            background: #FFD600;
            color: #ff5722 !important;
        }
        .hamburger-menu {
            display: none;
            font-size: 28px;
            cursor: pointer;
            margin-left: 10px;
        }

        /* Welcome Section */
        .welcomeuser {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .welcomeuser h2 {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
            margin: 0;
        }
        .welcomeuser span {
            font-size: 18px;
            color: #333;
        }

        /* Main Slider */
        .mainslider-container {
            display: flex;
            gap: 32px;
            align-items: center;
            justify-content: space-between;
            padding: 32px 18px;
            background: linear-gradient(135deg, #007BFF, #4CAF50);
            color: white;
            border-radius: 14px;
            flex-wrap: nowrap;
        }
        .info-container {
            flex: 1 1 320px;
            min-width: 220px;
            max-width: 500px;
        }
        .info-container h2 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .info-container p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .infobutton a {
            display: inline-block;
            padding: 10px 22px;
            background: linear-gradient(90deg,#FF5722,#FFD600);
            color: #fff;
            border-radius: 24px;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
            margin-bottom: 8px;
            transition: background 0.3s, transform 0.3s;
            border: none;
        }
        .infobutton a:hover {
            background: linear-gradient(90deg,#FFD600,#FF5722);
            color: #fff;
            transform: scale(1.08);
        }
        .slide-container {
            flex: 1 1 320px;
            min-width: 220px;
            max-width: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .slider {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .slide {
            display: none;
            width: 100%;
        }
        .slide img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }
        .slide.active {
            display: block;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Recently Added Products */
        .recentlyadd h3 {
            color: #007BFF;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            justify-content: center;
            margin-bottom: 32px;
            padding: 24px 8px 0 8px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
            align-items: stretch;
        }
        .product-item {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 340px;
        }
        .productlist-img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px;
            flex-shrink: 0;
        }
        .product-title {
            font-size: 18px;
            color: #333;
            margin: 10px 0 4px 0;
            flex-grow: 0;
        }
        .product-price {
            color: #FF5722;
            font-weight: bold;
            margin-bottom: 10px;
            flex-grow: 0;
        }
        .product-item a {
            display: inline-block;
            padding: 8px 18px;
            background: linear-gradient(90deg,#007BFF,#4CAF50);
            color: #fff;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s, transform 0.3s;
            margin-top: auto; /* Push button to bottom */
        }

        /* Footer */
        .footer {
            background: linear-gradient(90deg, #4CAF50, #007BFF);
            color: white;
            padding: 28px 0 10px 0;
            text-align: center;
            border-radius: 16px 16px 0 0;
            margin-top: 30px;
        }
        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer .row {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .footer-col h4 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer ul li {
            margin: 5px 0;
        }
        .footer ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer ul li a:hover {
            color: #FFD600;
        }
        .social-links a {
            margin: 0 10px;
            color: white;
            font-size: 20px;
            transition: transform 0.3s, color 0.3s;
        }
        .social-links a:hover {
            transform: scale(1.2);
            color: #FFD600;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .supermain-container, .inner-container {
                max-width: 98vw;
                padding: 0 6px;
            }
            .mainslider-container {
                flex-direction: column;
                gap: 18px;
                padding: 18px 0;
            }
            .slide-container, .info-container {
                max-width: 100%;
            }
            .footer .row {
                gap: 18px;
            }
        }
        @media (max-width: 700px) {
            .inner-container {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            .mainslider-container {
                flex-direction: column;
                gap: 12px;
                padding: 10px 0;
            }
            .product-grid {
                gap: 12px;
                padding: 18px 4vw 0 4vw;
            }
            .product-item {
                width: 98vw;
                max-width: 340px;
            }
            .slide img {
                height: 140px;
            }
            .search {
                margin: 0 0 10px 0;
            }
            .hamburger-menu {
                display: block;
            }
            .footer .row {
                flex-direction: column;
                gap: 8px;
            }
        }
        @media (max-width: 700px) {
            .supermain-container {
                padding: 10px 2vw 0 2vw;
            }
            .product-grid {
                gap: 12px;
                padding: 18px 2vw 0 2vw;
            }
            .product-item {
                width: 100%;
                max-width: 98vw;
                min-width: 0;
            }
            .footer .row {
                flex-direction: column;
                gap: 8px;
            }
            .mainslider-container {
                flex-direction: column;
                gap: 12px;
                padding: 10px 0;
            }
            .slide img {
                height: 140px;
            }
        }
        @media (max-width: 700px) {
            .nav-links {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="page-content">
        <div class="supermain-container">
            <!-- Navigation Bar -->
            <div class="innernav-bg">
                <div class="inner-container">
                    <div class="logo">
                        <img src="./userhomepage/logo.png" alt="Logo" class="logo-img">
                        <h3>Second-Hand Marketplace</h3>
                    </div>
                    <div class="search">
                        <input type="search" placeholder="Search products..." id="live_search">
                    </div>
                    <div class="nav-links">
                        <a href="userafterlogin.php">Home</a>
                        <a href="./userhomepage/products.php">Products</a>
                        <a href="./userhomepage/contact.php">Contact</a>
                        <a href="logout.php" class="logout-btn">Logout</a>
                    </div>
                    <div class="hamburger-menu" onclick="toggleMenu()">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="welcomeuser">
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h2>
                <span>Happy shopping and selling!</span>
            </div>

            <!-- Main Slider -->
            <div class="mainslider-container">
                <div class="info-container">
                    <h2>Discover Great Deals</h2>
                    <p>Buy and sell quality second-hand items. Save money and reduce waste!</p>
                    <div class="infobutton">
                        <a href="products.php" class="infobtn1">Browse Products</a>
                        <a href="addproduct.php" class="infobtn2">+ List Product</a>
                    </div>
                </div>
                <div class="slide-container">
                    <div class="slider">
                        <div class="slide"><img src="img1.png" alt="Slide 1"></div>
                        <div class="slide"><img src="img2.png" alt="Slide 2"></div>
                        <div class="slide"><img src="img3.png" alt="Slide 3"></div>
                    </div>
                </div>
            </div>

            <!-- Recently Added Products -->
            <div class="recentlyadd">
                <h3>Recently Added Products</h3>
            </div>
            <div class="product-grid">
                <?php
                $sql = "SELECT * FROM productdetails WHERE display_home=1 ORDER BY Product_id DESC LIMIT 8";
                $r = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_assoc($r)) {
                ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($data['product_image']); ?>" alt="Product Image" class="productlist-img">
                        <h3 class="product-title"><?php echo htmlspecialchars($data['product_name']); ?></h3>
                        <p class="product-price">Rs <?php echo htmlspecialchars($data['product_price']); ?></p>
                        <a href="productcard_afterlogin.php?productid=<?php echo $data['Product_id']; ?>">View Details</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Second-Hand Marketplace</h4>
                </div>
                <div class="footer-col">
                    <h4>Shop</h4>
                    <ul>
                        <li><a href="#">Vehicles</a></li>
                        <li><a href="#">Clothing</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Mobiles</a></li>
                        <li><a href="#">Accessories</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <p>All rights reserved || Designed By: Yubraj Ghimire Khatri & Mohammed Umar Akhtar</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
        // Responsive slider
        let current = 0;
        const slides = document.querySelectorAll('.slide');
        function showSlide(idx) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === idx);
            });
        }
        showSlide(current);
        setInterval(() => {
            current = (current + 1) % slides.length;
            showSlide(current);
        }, 3000);
    </script>
</body>
</html>