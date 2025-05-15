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
                <a href="contact.php" class="active-link">Contact</a>
            </div>
        </div>
    </div>

    <!-- Fancy section divider -->
    <svg class="divider" viewBox="0 0 1440 120"><path fill="#A770EF" fill-opacity="1" d="M0,32L30,48C60,64,120,96,180,133.3C240,171,300,213,360,197.3C420,181,480,107,540,101.3C600,96,660,160,720,181.3C780,203,840,181,900,160C960,139,1020,117,1080,117.3C1140,117,1200,139,1260,128C1320,117,1380,75,1410,53.3L1440,32L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>

    <div class="contact-container">
        <h1>Contact Us <i class="fas fa-heart pulse"></i></h1>
        <p>If you have any questions or need assistance, feel free to reach out to us using the information below.</p>

        <div class="contact-info">
            <div class="info-item card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Address</h3>
                <p>123 Second-Hand Street, Kathmandu, Nepal</p>
            </div>
            <div class="info-item card">
                <i class="fas fa-phone-alt"></i>
                <h3>Phone</h3>
                <p>+977-123456789</p>
                <a class="call-btn" href="tel:+977123456789">Call Now</a>
            </div>
            <div class="info-item card">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>support@secondhandmarketplace.com</p>
                <a class="mail-btn" href="mailto:support@secondhandmarketplace.com">Email Us</a>
            </div>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message <i class="fas fa-paper-plane"></i></h2>
            <!-- Fancy alert (hidden by default, can use with JS or server response) -->
            <div class="alert alert-success" style="display:none;">Thank you for contacting us! We will get back to you soon.</div>
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
                <button type="submit" class="submit-btn rainbow-btn">Send Message</button>
            </form>
        </div>

        <!-- Responsive Google Maps Embed -->
        <div class="map-section">
            <h2>Find Us Here!</h2>
            <div class="mapouter">
                <iframe src="https://maps.google.com/maps?q=Kathmandu&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
            </div>
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
        <p style="color:#fff;background:linear-gradient(90deg,#A770EF,#FDB99B);padding:8px;border-radius:8px;">
            All rights reserved &#169; Designed By: <b>Yubraj Ghimire Khatri & Mohammed Umar Akhtar</b>
        </p>
    </footer>
</body>

</html>