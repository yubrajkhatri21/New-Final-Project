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
        body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Main Container */
        .supermain-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }

        /* Navigation Bar */
        .innernav-bg {
            background: linear-gradient(90deg, #007BFF, #FF5722);
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .inner-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            width: 100%;
        }

        .search input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            width: 100%;
            max-width: 300px;
        }

        /* Welcome Section */
        .welcomeuser {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .welcomeuser h2 {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }

        .welcomeuser span {
            font-size: 20px;
            color: #333;
        }

        /* Main Slider */
        .mainslider-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: linear-gradient(135deg, #007BFF, #4CAF50);
            color: white;
            border-radius: 10px;
        }

        .info-container {
            flex: 1;
            max-width: 500px;
        }

        .info-container h2 {
            font-size: 24px;
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
            padding: 10px 20px;
            background-color: #FF5722;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .infobutton a:hover {
            background-color: #E64A19;
            transform: scale(1.1);
        }

        .slide-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slider {
            display: flex;
            gap: 10px;
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
        }

        .slide img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Recently Added Products */
        .main-container-pr {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-slide {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 20px;
        }

        .product-slide:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .product-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-content h2 {
            font-size: 18px;
            font-weight: bold;
            color: #007BFF;
            margin: 10px 0;
        }

        .product-content p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .product-content a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FF5722;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .product-content a:hover {
            background-color: #E64A19;
            transform: scale(1.1);
        }

        /* Footer */
        .footer {
            background: linear-gradient(90deg, #4CAF50, #007BFF);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer h4 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin: 5px 0;
        }

        .footer ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer ul li a:hover {
            color: #FF5722;
        }

        .social-links a {
            margin: 0 10px;
            color: white;
            font-size: 20px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-links a:hover {
            transform: scale(1.2);
            color: #FF5722;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .innernav-bg {
                flex-direction: column;
                align-items: flex-start;
            }

            .mainslider-container {
                flex-direction: column;
                align-items: center;
            }

            .info-container {
                text-align: center;
            }

            .main-container-pr {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="supermain-container">
        <!-- Navigation Bar -->
        <div class="innernav-bg">
            <div class="inner-container">
                <div class="logo">
                    <img src="logo.png" alt="Logo" class="logo-img">
                    <h3>Second-Hand Marketplace</h3>
                </div>
                <div class="search">
                    <input type="search" placeholder="Search products..." id="live_search">
                </div>
                <div class="nav-links">
                    <a href="userafterlogin.php">Home</a>
                    <a href="../userhomepage/products.php">Products</a>
                    <a href="contact.php">Contact</a>
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
            $sql = "SELECT * FROM productdetails WHERE display_home=1 ORDER BY Product_id DESC LIMIT 6";
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

    <!-- Footer -->
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
        // Simple slider JS
        let current = 0;
        const slides = document.querySelectorAll('.slide');
        setInterval(() => {
            slides[current].style.display = 'none';
            current = (current + 1) % slides.length;
            slides[current].style.display = 'block';
        }, 3000);
        slides.forEach((slide, idx) => slide.style.display = idx === 0 ? 'block' : 'none');
    </script>
</body>
</html>