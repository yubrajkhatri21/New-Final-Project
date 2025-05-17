<!DOCTYPE html>
<?php
include('php/connector.php');
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('location:login.php');
}
$productid = $_GET['productid'];
?>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Send Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  width: 100%;
  background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}
.container {
  width: 95%;
  max-width: 900px;
  background: #fff;
  border-radius: 18px;
  padding: 32px 40px 32px 40px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
  margin: 32px 0;
  position: relative;
  overflow: hidden;
}
.container::before {
  content: '';
  position: absolute;
  top: -80px;
  right: -80px;
  width: 180px;
  height: 180px;
  background: linear-gradient(135deg, #ffb347 0%, #ffcc33 100%);
  opacity: 0.18;
  border-radius: 50%;
  z-index: 0;
}
.container .content {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  position: relative;
  z-index: 1;
}
.container .content .left-side {
  width: 30%;
  min-width: 200px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  margin-top: 10px;
  position: relative;
  background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
  border-radius: 12px;
  padding: 24px 10px;
  color: #fff;
  box-shadow: 0 4px 18px rgba(67,206,162,0.08);
}
.content .left-side .details {
  margin: 18px 0;
  text-align: center;
}
.content .left-side .details i {
  font-size: 32px;
  color: #ffd600;
  margin-bottom: 10px;
  background: #fff2;
  border-radius: 50%;
  padding: 12px;
}
.content .left-side .details .topic {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 2px;
  color: #fff;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two {
  font-size: 15px;
  color: #e0e0e0;
}
.container .content .right-side {
  width: 65%;
  margin-left: 40px;
  background: #f7f8fa;
  border-radius: 12px;
  padding: 28px 24px;
  box-shadow: 0 2px 8px rgba(24,90,157,0.06);
}
.content .right-side .topic-text {
  font-size: 25px;
  font-weight: 700;
  color: #185a9d;
  margin-bottom: 10px;
}
.content .right-side p {
  color: #555;
  margin-bottom: 18px;
}
.right-side .input-box {
  height: 48px;
  width: 100%;
  margin: 12px 0;
}
.right-side .input-box input,
.right-side .input-box textarea {
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #e3f6f5;
  border-radius: 8px;
  padding: 0 15px;
  resize: none;
  transition: box-shadow 0.2s;
  box-shadow: 0 1px 4px rgba(67,206,162,0.07);
}
.right-side .input-box input:focus,
.right-side .input-box textarea:focus {
  box-shadow: 0 2px 8px #43cea2aa;
}
.right-side .message-box {
  min-height: 110px;
  height: auto;
}
.right-side .input-box textarea {
  padding-top: 8px;
  min-height: 90px;
  max-height: 200px;
}
.right-side .button {
  display: inline-block;
  margin-top: 16px;
}
.right-side .button input[type="submit"] {
  color: #fff;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 10px 28px;
  border-radius: 8px;
  background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
  cursor: pointer;
  font-weight: 600;
  box-shadow: 0 2px 8px #185a9d33;
  transition: background 0.3s, transform 0.2s;
}
.right-side .button input[type="submit"]:hover {
  background: linear-gradient(90deg, #ffb347 0%, #ffcc33 100%);
  color: #185a9d;
  transform: scale(1.05);
}
@media (max-width: 950px) {
  .container {
    padding: 24px 10px 24px 10px;
  }
  .container .content .right-side {
    margin-left: 20px;
    padding: 20px 10px;
  }
}
@media (max-width: 820px) {
  .container {
    margin: 24px 0;
    height: 100%;
  }
  .container .content {
    flex-direction: column-reverse;
    align-items: stretch;
  }
  .container .content .left-side {
    width: 100%;
    flex-direction: row;
    margin-top: 24px;
    justify-content: center;
    flex-wrap: wrap;
    padding: 18px 0;
    border-radius: 10px;
  }
  .container .content .right-side {
    width: 100%;
    margin-left: 0;
    margin-bottom: 18px;
    padding: 18px 8px;
  }
}
    </style>
</head>
<body>
<?php
$dqry = "SELECT * FROM userdetails u JOIN productdetails p ON u.user_id=p.user_id WHERE Product_id=$productid";
$result = mysqli_query($con, $dqry);
if ($data = mysqli_fetch_assoc($result)) {
?>
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Nepal</div>
          <div class="text-two"><?php echo $data['address']; ?></div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-two"><?php echo $data['phone'] ?></div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one"><?php echo $data['email'] ?></div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>If you have any questions or want to contact the seller, send a message below!</p>
        <form action="php/sendmessageback.php?productid=<?php echo $productid ?>" method="POST">
          <div class="input-box">
            <input readonly type="text" name="name" value="<?php echo $data['name']; ?>" placeholder="Enter your name">
          </div>
          <div class="input-box">
            <input name="email" readonly type="text" value="<?php echo $data['email']; ?>" placeholder="Enter your email">
          </div>
          <div class="input-box message-box">
            <textarea name="message" placeholder="Enter Message Here.." required></textarea>
          </div>
          <div class="button">
            <input type="submit" name="submit" value="Send Now">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
</body>
</html>