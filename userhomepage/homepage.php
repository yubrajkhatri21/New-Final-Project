<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second-Hand Marketplace</title>
    <link rel="stylesheet" href="../css/homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'myfinalproject';

    $con = mysqli_connect($server, $username, $password, $database);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    ?>

    <div class="supermain-container">
        <!-- Navigation Bar -->
        <div class="innernav-bg">
            <div class="inner-container">
                <!-- Logo Section -->
                <div class="logo">
                    <img src="logo.png" alt="Logo" class="logo-img">
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

                <!-- Auth Buttons
                <div class="auth-buttons">
                <!-- Navigation Links -->
                <!-- <div class="nav-links">
                    <a href="homepage.php">Home</a>
                    <a href="#products">Products</a>
                    <a href="#contact">Contact</a>
                </div>  -->

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

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        var delayTimer;

                        $("#live_search").keyup(function() {
                            clearTimeout(delayTimer);
                            var input = $(this).val();
                            if (input != "") {
                                delayTimer = setTimeout(function() {
                                    searchItems(input);
                                }, 500);
                            } else {
                                $("#searchresult").slideUp();
                            }
                        });

                        function searchItems(input) {
                            $.ajax({
                                url: "../php/livesearch.php",
                                method: "POST",
                                data: {
                                    input: input
                                },
                                success: function(data) {
                                    $("#searchresult").html(data);

                                    $("#searchresult .product_image").css({
                                        "width": "200px",
                                        "height": "150px"
                                    });

                                    $("#searchresult").slideDown();

                                    $("#searchresult tbody tr").hover(function() {
                                        $(this).addClass("highlighted-row");
                                    }, function() {
                                        $(this).removeClass("highlighted-row");
                                    }).click(function() {

                                    });
                                },
                                error: function() {
                                    $("#searchresult").html("Error fetching data from the server.");
                                }
                            });
                        }
                    });

                    function toggleMenu() {
                        const navLinks = document.querySelector('.nav-links');
                        navLinks.classList.toggle('active');
                    }

                    function applyFilters() {
                        var category = document.getElementById("category_filter").value;
                        var minPrice = document.getElementById("min_price").value;
                        var maxPrice = document.getElementById("max_price").value;

                        $.ajax({
                            url: "../php/filter_products.php", // Ensure the correct path to the PHP file
                            method: "POST",
                            data: {
                                category: category,
                                minPrice: minPrice,
                                maxPrice: maxPrice
                            },
                            success: function(data) {
                                $(".product-grid").html(data); // Update the product grid with the filtered results
                            },
                            error: function() {
                                console.log("Error fetching filtered products.");
                            }
                        });
                    }
                </script>
                <style>
                    .highlighted-row {
                        background-color: lightcyan;
                    }

                    .innernav-bg {
                        background: linear-gradient(90deg, #007BFF, #FF5722);
                        padding: 10px 20px;
                        color: white;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

                    .logo {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    }

                    .logo-img {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                    }

                    .search {
                        flex: 1;
                        display: flex;
                        justify-content: center;
                        margin: 0 20px;
                    }

                    .search input {
                        width: 100%;
                        max-width: 400px;
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

                    .login-btn {
                        background-color: #FF5722;
                        padding: 10px 20px;
                        border-radius: 20px;
                        text-decoration: none;
                        color: white;
                        font-weight: bold;
                        transition: background-color 0.3s ease;
                    }

                    .login-btn:hover {
                        background-color: #E64A19;
                    }

                    .hamburger-menu {
                        display: none;
                        font-size: 24px;
                        cursor: pointer;
                    }

                    @media (max-width: 768px) {
                        .nav-links {
                            display: none;
                            flex-direction: column;
                            background: #007BFF;
                            position: absolute;
                            top: 60px;
                            right: 20px;
                            padding: 10px;
                            border-radius: 10px;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        }

                        .nav-links.active {
                            display: flex;
                        }

                        .hamburger-menu {
                            display: block;
                        }
                    }

                    .inner-container h3 {
                        font-size: 24px;
                        font-weight: bold;
                        color: white;
                    }

                    .authbutton a {
                        background-color: #FF5722;
                        color: white;
                        padding: 10px 20px;
                        border-radius: 5px;
                        text-decoration: none;
                        font-weight: bold;
                        transition: background-color 0.3s ease;
                    }

                    .authbutton a:hover {
                        background-color: #E64A19;
                    }

                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .mainslider-container, .product-item, .footer {
                        animation: fadeIn 1s ease-in-out;
                    }

                    body {
                        background: url('../photo/background-pattern.png') no-repeat center center fixed;
                        background-size: cover;
                        font-family: 'Roboto', sans-serif;
                        color: #333;
                    }

                    button, .btn1, .btn2, .btn1extra, .btn2extra {
                        background-color: #007BFF;
                        color: white;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        font-weight: bold;
                        cursor: pointer;
                        transition: background-color 0.3s ease, transform 0.3s ease;
                    }

                    button:hover, .btn1:hover, .btn2:hover, .btn1extra:hover, .btn2extra:hover {
                        background-color: #0056b3;
                        transform: scale(1.1);
                    }

                    .product-item {
                        background: white;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        overflow: hidden;
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                        text-align: center;
                        padding: 20px;
                        width: 300px;
                        height: auto;
                        margin: 10px;
                    }

                    .productlist-img {
                        border-radius: 10px;
                        max-width: 100%; /* Ensure the image does not exceed the container's width */
                        height: auto; /* Maintain aspect ratio */
                        object-fit: cover; /* Ensure the image fills the container without distortion */
                    }

                    .product-grid {
                        display: flex;
                        flex-wrap: wrap; /* Allow products to wrap to the next row */
                        gap: 20px; /* Add spacing between products */
                        justify-content: center; /* Center the products in the grid */
                    }

                    @media (max-width: 768px) {
                        .product-item {
                            width: 100%; /* Make the product container take full width on smaller screens */
                        }
                    }
                </style>




                <div class="innercontainer-inner">
                    <div class="image">
                        <img src="">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <div class="authbutton" style="display: flex; gap: 10px; align-items: center;">
                        <!-- <a class="btn1" onclick="showPopup();">Sign up</a>
                        <a href="../login.php" class="btn2">Login</a> -->
                        <script>
                            function showPopup() {
                                var popup = document.getElementById("popupContainer");
                                popup.style.display = "block";
                            }
                        </script>
                    </div>
                </div>
            </div>

        </div>
        <div class="authmainbtn-extra">
            <div class="authbuttonextra">
                <button class="btn1extra" onclick="showPopup();">Sign in</button>
            </div>
        </div>



        <div class="mainslider-container">
    <!-- Info Container -->
    <div class="info-container">
        <h2>Welcome to our second-hand product marketplace</h2>
        <p>"Our second-hand marketplace offers an easy way to buy and sell quality used items, from electronics to furniture. Join our community today and save money while reducing waste."</p>
        <div class="infobutton">
            <a href="../login.php" class="infobtn1">Buy Product</a>
            <a href="../login.php" class="infobtn2">+ Listing Product</a>
        </div>
    </div>

    <!-- Slider Container -->
    <div class="slide-container">
        <div class="slider">
            <div class="slide slide1"><img src="img1.png" alt="Slide 1"></div>
            <div class="slide slide2"><img src="img2.png" alt="Slide 2"></div>
            <div class="slide slide3"><img src="img3.png" alt="Slide 3"></div>
        </div>
    </div>
</div>
        <div class="recentlyadd">
            <h3>Recently Added Products</h3>
        </div>
        <div class="product-grid">
            <?php
            $stmt = $con->prepare("SELECT * FROM productdetails WHERE display_home = 1 ORDER BY Product_id DESC LIMIT 3");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
            ?>
                    <div class="product-item">
                        <div>
                            <img src="../<?php echo $data['product_image']; ?>" alt="Product Image" class="productlist-img">
                        </div>
                        <div>
                            <h3 class="product-title"><?php echo $data['product_name']; ?></h3>
                            <p class="product-price">Rs <?php echo $data['product_price']; ?></p>
                            <a href="../login.php">Buy now</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
        <div>
            <img style=" width:25%; z-index:10; position:absolute; right:0 ; bottom:0;" src="../photo/girl-img.png" alt="">
        </div>








        <div class="bigcontainerpopup" id="popupContainer">
            <div class="container-signup">
                <div class="box">
                    <a href="homepage.php"><i class="ri-close-line closeicon"></i></a>
                    <h1>Sign Up</h1>
                    <form method="POST" action="../php/qsignup.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div>
                            <i class="ri-user-3-fill"></i>
                            <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                            <span id="nameError" class="error"></span>
                        </div>
                        <div>
                            <i class="ri-mail-open-fill"></i>
                            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                            <span id="emailError" class="error"></span>
                        </div>
                        <div>
                            <i class="ri-git-repository-private-fill"></i>
                            <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                            <span id="passwordError" class="error"></span>
                        </div>
                        <div>
                            <i class="ri-map-pin-fill"></i>
                            <input type="address" id="address" name="address" placeholder="Enter Your Address" required>
                            <span id="addressError" class="error"></span>
                        </div>
                        <div>

                            <input type="text" id="address" name="phone" placeholder="Enter Your phone no" required>
                            <span id="addressError" class="error"></span>
                        </div>
                        <div>
                            <i class="ri-image-fill"></i>
                            <input type="file" id="uimage" name="uimage" required>
                            <span id="imageError" class="error"></span>
                        </div>
                        <div>
                            <label>Gender</label>
                            <input type="radio" id="male" name="gender" value="male" required><label for="male">male</label>
                            <input type="radio" id="female" name="gender" value="female" required><label for="female">female</label>
                            <input type="radio" id="others" name="gender" value="others" required><label for="others">others</label>
                            <span id="genderError" class="error"></span>
                        </div>
                        <input type="submit" name="submit" value="signup">
                    </form>
                    <span>
                        Already have an account?
                        <a href="login.php">Login</a>
                    </span>

                </div>
            </div>

        </div>











    </div>



    <div style="background-color:white;position:absolute; width:100%;top:0; text-align:center; margin-top:3%; " id="searchresult"></div>



    <div class="title2block">
    <div>
        <h2>What are you looking for?</h2>
    </div>
    <div>
        <img src="searching.png" alt="searchimg">
        <img src="imgblock2.png" alt="searchimg">
    </div>
    <div class="search-filter">
    <div class="filter-group">
        <label for="category_filter">Category:</label>
        <select id="category_filter">
            <option value="">All Categories</option>
            <option value="Electronics">electronics</option>
            <option value="books">books</option>
            <option value="vehicle">vehicle</option>
           
        </select>
    </div>
        <div class="filter-group">
            <label for="min_price">Min Price:</label>
            <input type="number" id="min_price" placeholder="Min Price">
        </div>
        <div class="filter-group">
            <label for="max_price">Max Price:</label>
            <input type="number" id="max_price" placeholder="Max Price">
        </div>
        <button class="apply-button" onclick="applyFilters()">Apply Filters</button>
    </div>
</div>

        <style>



            
            .search-filter {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                align-items: center;
                background-color: #f7f7f7;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .filter-group {
                display: flex;
                align-items: center;
            }

            .filter-group label {
                font-weight: bold;
                margin-right: 10px;
            }

            .filter-group select,
            .filter-group input {
                padding: 8px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
                width: 150px;
            }

            .filter-group select {
                flex-grow: 1;
            }


            .apply-button {
                margin-top: 10px;
            }


            optgroup {
                font-weight: bold;
            }


            optgroup option,
            option {
                padding: 10px;
            }


            #category_filter option:hover {
                background-color: #f2f2f2;
            }

            .mainslider-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 40px;
                background: linear-gradient(135deg, #007BFF, #4CAF50);
                color: white;
                border-radius: 10px;
                margin: 20px;
            }

            .infobutton a {
                display: inline-block;
                padding: 10px 20px;
                margin: 10px;
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

            .product-item {
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                text-align: center;
                padding: 20px;
                width: 300px;
                height: auto;
                margin: 10px;
            }

            .product-item:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            }

            .product-title {
                font-size: 18px;
                font-weight: bold;
                color: #007BFF;
            }

            .product-price {
                font-size: 16px;
                color: #4CAF50;
                margin: 10px 0;
            }

            .productlist-img {
                border-radius: 10px;
                max-width: 100%;
                height: auto;
            }

            .search-filter {
                background: #F7F7F7;
                border: 2px solid #007BFF;
                border-radius: 10px;
                padding: 20px;
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
            }

            .filter-group label {
                font-weight: bold;
                color: #007BFF;
            }

            .filter-group input, .filter-group select {
                border: 2px solid #007BFF;
                border-radius: 5px;
                padding: 10px;
                font-size: 14px;
                width: 150px;
            }

            .apply-button {
                background-color: #FF5722;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .apply-button:hover {
                background-color: #E64A19;
            }
        </style>












        <div class="product-grid">
            <?php
            $sql = "SELECT * FROM productdetails WHERE display_home=1";
            $r = mysqli_query($con, $sql);
            while ($data = mysqli_fetch_assoc($r)) {
            ?>
                <div class="product-item">
                    <div>
                        <img src="../<?= $data['product_image'] ?>" alt="Product Image" class="productlist-img">
                    </div>
                    <div>
                        <h3 class="product-title"><?php echo $data['product_name'] ?></h3>
                        <p class="product-price">Rs <?php echo $data['product_price'] ?></p>
                        <a href="../login.php">Buy now</a>
                    </div>
                </div>
            <?php } ?>
        </div>



        <script>
    function applyFilters() {
        var category = document.getElementById("category_filter").value;
        var minPrice = document.getElementById("min_price").value;
        var maxPrice = document.getElementById("max_price").value;

        
        $.ajax({
            url: "php/filter_products.php", 
            method: "POST",
            data: {
                category: category,
                minPrice: minPrice,
                maxPrice: maxPrice
            },
            success: function(data) {
                
                $(".product-grid").html(data);
            },
            error: function() {
                console.log("Error fetching filtered products.");
            }
        });
    }
</script>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Second Hand buying and selling goods</h4>
                    
                </div>
                
                <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                    <li><a href="https://hamrobazaar.com/category/automobiles/EB9C8147-07C0-4951-A962-381CDB400E37">vehicles</a></li>
                            <li><a href="https://www.daraz.com.np/mens-clothing/?spm=a2a0e.11779170.cate_3.1.287d2d2bO58xz4">clothing</a></li>
                            <li><a href="https://gizmostorenepal.com/">electronics</a></li>
                            <li><a href="https://gizmostorenepal.com/">mobiles</a></li>
                            <li><a href="https://hukut.com/">accessories</a></li>
                            <li><a href="https://hukut.com/">others</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                    <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                            <a href="https://www.x.com/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            </BR>
            <div class="row">
                All rights reserved || Designed By: Yubraj Ghimire Khatri & Mohammed Umar Akhtar
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <!-- slide-container javascript  -->

    <script>
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.prevBtn');
        const nextBtn = document.querySelector('.nextBtn');

        let currentSlide = 0;
        let slideInterval = setInterval(nextSlide, 3000);

        function nextSlide() {
            slides[currentSlide].style.opacity = 0;
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].style.opacity = 1;
        }

        function prevSlide() {
            slides[currentSlide].style.opacity = 0;
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            slides[currentSlide].style.opacity = 1;
        }

        nextBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            nextSlide();
            slideInterval = setInterval(nextSlide, 3000);
        });

        prevBtn.addEventListener('click', () => {
            clearInterval(slideInterval);
            prevSlide();
            slideInterval = setInterval(nextSlide, 3000);
        });

        // product slide animation javascript
    </script>

    <script>
        const productSlides = document.querySelectorAll('.product-slide');
        let currentProductSlideIndex = 0;

        function nextProductSlide() {
            productSlides[currentProductSlideIndex].classList.remove('active');
            currentProductSlideIndex = (currentProductSlideIndex + 1) % productSlides.length;
            productSlides[currentProductSlideIndex].classList.add('active');
        }


        nextProductSlide();

        setInterval(nextProductSlide, 3000);
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
                top: 80px;
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
                top: 80px;
                right: 20px;
            }
        </style>
    </head>

    <body>
        <?php if (isset($_SESSION['success'])) { ?>
            <script type="text/javascript">
                showMessage('<?php echo $_SESSION['success']; ?>', 'success-message');
                setTimeout(function() {
                    window.location.href = '../login.php';
                }, 2000);
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

    <style>
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

        .authbutton {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center; /* Center the buttons horizontally */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .authbutton a {
            background-color: #FF5722;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .authbutton a:hover {
            background-color: #E64A19;
        }

        @media (max-width: 768px) {
            .authbutton {
                flex-direction: column; /* Stack buttons vertically on smaller screens */
                gap: 15px;
            }
        }
    </style>

</body>

</html>