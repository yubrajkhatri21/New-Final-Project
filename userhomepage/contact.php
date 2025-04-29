<!-- filepath: c:\xampp\htdocs\myfinalproject\userhomepage\contact.php -->
<?php
include('../php/connector.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <div class="innernav-bg">
        <div class="inner-container">
            <div class="logo">
                <h3>Second-Hand Marketplace</h3>
            </div>
            <div class="nav-links">
                <a href="homepage.php">Home</a>
                <a href="products.php">Products</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-container">
        <h1>Contact Us</h1>
        <p>If you have any questions or need assistance, feel free to reach out to us using the information below.</p>

        <div class="contact-info">
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Address</h3>
                <p>123 Second-Hand Street, Kathmandu, Nepal</p>
            </div>
            <div class="info-item">
                <i class="fas fa-phone-alt"></i>
                <h3>Phone</h3>
                <p>+977-123456789</p>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>support@secondhandmarketplace.com</p>
            </div>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="../php/contact_form_handler.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" placeholder="Enter your message" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-col">
                <h4>Second-Hand Marketplace</h4>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <p>All rights reserved || Designed By: Yubraj Ghimire Khatri & Mohammed Umar Akhtar</p>
    </footer>
</body>

</html>